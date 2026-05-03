<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductType;
use App\Models\Requisition;
use App\Models\RequisitionItem;
use App\Models\StockIn;
use App\Models\Supplier;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    // Common Categories for filters
    private function getCategories()
    {
        return Category::all();
    }
    private function getProductTypes()
    {
        return ProductType::all();
    }

    public function categoryWise(Request $request)
    {
        $query = Product::with('category');

        if ($request->filled('search')) {
            $query->where('name', 'like', "%{$request->search}%");
        }

        $data = $query->get()->groupBy('category.name');

        return view('admin.reports.hub', [
            'type' => 'category_wise',
            'data' => $data,
            'categories' => $this->getCategories(),
            'productTypes' => $this->getProductTypes()
        ]);
    }

    public function assetIssuedDetail(Request $request)
    {
        $type = 'asset_issued_detail';

        $query = RequisitionItem::with(['requisition.user', 'product.category'])
            ->whereHas('requisition', function ($q) {
                $q->where('status', 4); // Only show completed/received items
            });

        // Filter by Employee Name or Product Name
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->whereHas('requisition.user', fn($u) => $u->where('name', 'like', "%$search%"))
                    ->orWhereHas('product', fn($p) => $p->where('name', 'like', "%$search%"));
            });
        }

        // Filter by Date Range (Issued Date)
        if ($request->filled('from') && $request->filled('to')) {
            $query->whereHas('requisition', function ($q) use ($request) {
                $q->whereBetween('acknowledged_at', [$request->from, $request->to]);
            });
        }

        $data = $query->latest()->get();
        $categories = Category::all();
        $productTypes = ProductType::all();

        return view('admin.reports.hub', compact('data', 'type', 'categories', 'productTypes'));
    }

    public function productWise(Request $request)
    {
        // 1. Eager load everything to keep it fast
        $query = Product::with(['category.categoryType']);

        // 2. Search by Product Name
        if ($request->filled('search')) {
            $query->where('name', 'like', "%{$request->search}%");
        }

        // 3. Filter by Product Type (The "Unknown Column" Fix)
        if ($request->filled('product_type')) {
            $query->whereHas('category.categoryType', function ($q) use ($request) {
                // This looks into the 'product_types' table
                $q->where('name', $request->product_type);
            });
        }

        // 4. Filter by Stock Status
        if ($request->filled('stock_status')) {
            if ($request->stock_status === 'low') {
                $query->where('quantity', '>', 0)->where('quantity', '<', 5);
            } elseif ($request->stock_status === 'out') {
                $query->where('quantity', '<=', 0);
            }
        }

        // 5. Get the results (not grouped, since it's "product_wise")
        $data = $query->orderBy('name')->get();

        return view('admin.reports.hub', [
            'type' => 'product_wise',
            'data' => $data,
            'categories' => $this->getCategories(),
            'productTypes' => $this->getProductTypes()
        ]);
    }

    public function supplierWise(Request $request)
    {
        $query = RequisitionItem::with(['requisition.user', 'product'])
            ->whereHas('requisition', fn($q) => $q->where('status', 4)); // Only Acknowledged

        if ($request->filled('search')) {
            $query->whereHas('product', fn($q) => $q->where('name', 'like', "%{$request->search}%"));
        }

        $data = $query->latest()->paginate(20);

        return view('admin.reports.hub', [
            'type' => 'supplier_wise',
            'data' => $data,
            'categories' => $this->getCategories()
        ]);
    }

    public function assetCurrentStatus(Request $request)
    {
        $type = 'asset_current_status';

        $query = Product::with(['category', 'requisitionItems' => function ($q) {
            $q->whereHas('requisition', fn($r) => $r->where('status', 4));
        }]);

        if ($request->filled('search')) {
            $query->where('name', 'like', "%{$request->search}%");
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        $data = $query->get();
        $categories = Category::all();

        return view('admin.reports.hub', compact('data', 'type', 'categories'));
    }

    public function consumableSummary(Request $request)
    {
        $query = RequisitionItem::with(['requisition.user', 'product'])
            ->whereHas('requisition', fn($q) => $q->where('status', 4)); // Only Acknowledged

        if ($request->filled('search')) {
            $query->whereHas('product', fn($q) => $q->where('name', 'like', "%{$request->search}%"));
        }

        $data = $query->latest()->paginate(20);

        return view('admin.reports.hub', [
            'type' => 'consumable_summary',
            'data' => $data,
            'categories' => $this->getCategories()
        ]);
    }

    public function consumableStock(Request $request)
    {
        $query = RequisitionItem::with(['requisition.user', 'product'])
            ->whereHas('requisition', fn($q) => $q->where('status', 4)); // Only Acknowledged

        if ($request->filled('search')) {
            $query->whereHas('product', fn($q) => $q->where('name', 'like', "%{$request->search}%"));
        }

        $data = $query->latest()->paginate(20);

        return view('admin.reports.hub', [
            'type' => 'consumable_stock',
            'data' => $data,
            'categories' => $this->getCategories()
        ]);
    }
}
