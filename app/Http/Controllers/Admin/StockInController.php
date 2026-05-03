<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\StockIn;
use App\Models\Supplier;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\DB;

class StockInController extends Controller
{
    public static function middleware(): array
    {
        return [
            // 1. General access for all methods
            new Middleware('can:stock-in_access'),

            // 2. Restricted methods
            new Middleware('can:stock-in_delete', only: ['destroy']),
            new Middleware('can:stock-in_create', only: ['create', 'store']),
            new Middleware('can:stock-in_edit', only: ['edit', 'update']),
        ];
    }
    public function index()
    {
        $user = auth()->user();
        $query = StockIn::with(['supplier', 'items.product.category']);

        if ($user->hasRole('Approval Authority (IT)')) {
            // Only show Challans where products are in 'IT Products'
            $query->whereHas('items.product.category', function ($q) {
                $q->where('name', 'IT Products');
            });
        } elseif ($user->hasRole('Approval Authority (Non-IT)')) {
            // Show everything EXCEPT 'IT Products'
            $query->whereHas('items.product.category', function ($q) {
                $q->where('name', '!=', 'IT Products');
            });
        }
        $stockIns = $query->latest()->paginate(15);
        return view('admin.stock_ins.index', compact('stockIns'));
    }
    public function create()
    {
        $suppliers = Supplier::pluck('name', 'id');
        // Eager load category and categoryType
        $products = Product::with('category.categoryType')->get();

        return view('admin.stock_ins.create', compact('suppliers', 'products'));
    }

    public function show(StockIn $stockIn)
    {
        // We only need product and category names now
        $stockIn->load(['supplier', 'items.product.category']);

        return view('admin.stock_ins.show', compact('stockIn'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'challan_no' => 'required|unique:stock_ins,challan_no',
            'received_at' => 'required|date',
            'note' => 'nullable|string',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        DB::transaction(function () use ($request, $validated) {
            // 1. Create the Header
            $stockIn = StockIn::create([
                'supplier_id' => $validated['supplier_id'],
                'challan_no' => $validated['challan_no'],
                'note' => $validated['note'],
                'received_at' => $validated['received_at'],
                'challan_image' => $request->hasFile('challan_image')
                    ? $request->file('challan_image')->store('challans', 'public')
                    : null,
            ]);

            // 2. Create the Details and Update Product Stock
            foreach ($validated['items'] as $item) {
                $stockIn->items()->create($item);

                // Important: Update the total stock count on the product table
                $product = Product::find($item['product_id']);
                $product->increment('stock_quantity', $item['quantity']);
            }
        });

        return redirect()->route('admin.stock-ins.index')->with('success', 'Stock posted successfully.');
    }


    // public function approve(StockIn $stockIn)
    // {
    //     if ($stockIn->status !== 0) {
    //         return back()->with('error', 'This challan has already been processed.');
    //     }

    //     DB::transaction(function () use ($stockIn) {
    //         $stockIn->update([
    //             'status' => 1,
    //             'approved_by' => auth()->id(),
    //             'approved_at' => now(),
    //         ]);

    //         // 2. NOW increment the actual stock
    //         foreach ($stockIn->items as $item) {
    //             $product = $item->product;
    //             $product->increment('stock_quantity', $item['quantity']);
    //         }
    //     });

    //     return back()->with('success', 'Stock approved and added to inventory.');
    // }

    public function approve(StockIn $stockIn)
    {
        // LOAD THE DATA FIRST
        $stockIn->load(['items.product.category']);

        if ($stockIn->status !== 0) {
            return back()->with('error', 'This challan has already been processed.');
        }

        $isItProduct = $stockIn->isItProduct();
        $user = auth()->user();

        // 3. Permission Gate: Check if user has the specific role for this product type
        $hasItAuthority = $user->hasRole('Approval Authority (IT)');
        $hasNonItAuthority = $user->hasRole('Approval Authority (Non-IT)');

        if (($isItProduct && !$hasItAuthority) || (!$isItProduct && !$hasNonItAuthority)) {
            return back()->with('error', 'You do not have the authority to approve ' . ($isItProduct ? 'IT' : 'Non-IT') . ' products.');
        }

        // 4. Execution
        DB::transaction(function () use ($stockIn) {
            // Update Challan Status
            $stockIn->update([
                'status' => 1,
                'approved_by' => auth()->id(),
                'approved_at' => now(),
            ]);

            // Increment actual stock for each item
            foreach ($stockIn->items as $item) {
                $item->product->increment('stock_quantity', $item->quantity);
            }
        });

        return back()->with('success', 'Stock approved and inventory updated successfully.');
    }
}
