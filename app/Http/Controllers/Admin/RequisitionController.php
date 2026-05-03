<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Requisition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RequisitionController extends Controller
{
    public function index(Request $request)
    {
        $query = Requisition::query();
        $user = auth()->user();

        // 1. Check for the EXPLICIT 'mine' filter first (for both Admins and Users)
        if ($request->get('filter') === 'mine') {
            $query->where('user_id', $user->id);
        }
        // 2. If NOT 'mine', check if the user has permission to see everything
        elseif ($user->hasAnyRole(['Store Keeper', 'Approval Authority (IT)', 'Approval Authority (Non-IT)', 'System Admin', 'admin'])) {
            // Do nothing, show all records (the full query)
        }
        // 3. If they aren't an admin and didn't ask for 'mine', default to only their records (security)
        else {
            $query->where('user_id', $user->id);
        }

        $requisitions = $query->latest()->paginate(15);

        return view('admin.requisitions.index', compact('requisitions'));
    }

    public function create()
    {
        $products = Product::with('category')->where('stock_quantity', '>', 0)->get();
        return view('admin.requisitions.create', compact('products'));
    }

    // Step 2: Store Keeper Reviews
    public function review(Requisition $requisition)
    {
        $requisition->update([
            'status' => 1,
            'reviewed_by' => auth()->id(),
            'reviewed_at' => now()
        ]);
        return back()->with('success', 'Requisition reviewed and sent for approval.');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        DB::transaction(function () use ($validated) {
            // Create Header
            $requisition = Requisition::create([
                'requisition_no' => 'REQ-' . strtoupper(now()->format('ymd')) . '-' . rand(1000, 9999),
                'user_id' => auth()->id(),
                'title' => $validated['title'],
                'description' => $validated['description'],
                'status' => 0, // Pending
            ]);

            // Create Items
            foreach ($validated['items'] as $item) {
                $requisition->items()->create($item);
            }
        });

        return redirect()->route('admin.requisitions.index')->with('success', 'Requisition submitted successfully.');
    }

    public function show(Requisition $requisition)
    {
        // Load the items, the products they belong to, and the audit trail users
        $requisition->load(['items.product', 'user', 'reviewer', 'approver']);

        return view('admin.requisitions.show', compact('requisition'));
    }

    // Step 3: Authority Approves & Deducts Stock
    public function approve(Requisition $requisition)
    {
        DB::transaction(function () use ($requisition) {
            foreach ($requisition->items as $item) {
                // Deduct from Product Master Stock
                $item->product->decrement('stock_quantity', $item->quantity);
            }

            $requisition->update([
                'status' => 2,
                'approved_by' => auth()->id(),
                'approved_at' => now()
            ]);
        });
        return back()->with('success', 'Requisition approved and stock updated.');
    }

    // Step 4: User Acknowledges
    public function acknowledge(Requisition $requisition)
    {
        $requisition->update([
            'status' => 4,
            'acknowledged_at' => now()
        ]);
        return back()->with('success', 'Thank you for acknowledging the receipt.');
    }
}
