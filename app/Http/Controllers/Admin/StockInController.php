<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\StockIn;
use App\Models\Supplier;
use Illuminate\Support\Facades\DB;

class StockInController extends Controller
{
    public function index()
    {
        // We load the supplier and count the related items for the table
        $stockIns = StockIn::with('supplier')
            ->withCount('items')
            ->latest()
            ->paginate(15);

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
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.unit_cost' => 'nullable|numeric|min:0',
        ]);

        DB::transaction(function () use ($request, $validated) {
            // 1. Create the Header
            $stockIn = StockIn::create([
                'supplier_id' => $validated['supplier_id'],
                'challan_no' => $validated['challan_no'],
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
}
