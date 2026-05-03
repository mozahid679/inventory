<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Category;
use App\Models\StockInItem;
use App\Models\User;
use Spatie\Permission\Models\Role;

class DashboardController extends Controller
{
    public function index()
    {
        // Fetch dynamic stats for your Asset Inventory
        $totalAssets = Product::count();
        $totalUsers = User::count();
        $totalRoles = Role::count();
        $totalSuppliers = Supplier::count();
        $totalCategories = Category::count();

        // $recentAssets = StockInItem::with('product', 'supplier')->latest()->take(5)->get();
        $recentAssets = StockInItem::with(['product', 'stockIn.supplier'])
            ->latest()
            ->take(10)
            ->get();

        return view('dashboard', compact(
            'totalAssets',
            'totalSuppliers',
            'totalUsers',
            'totalRoles',
            'totalCategories',
            'recentAssets'
        ));
    }
}
