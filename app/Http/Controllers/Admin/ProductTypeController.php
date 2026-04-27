<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductType;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class ProductTypeController extends Controller
{
    public static function middleware(): array
    {
        return [
            // 1. General access for all methods
            new Middleware('can:product-type_access'),

            // 2. Restricted methods
            new Middleware('can:product-type_delete', only: ['destroy']),
            new Middleware('can:product-type_create', only: ['create', 'store']),
            new Middleware('can:product-type_edit', only: ['edit', 'update']),
        ];
    }
    public function index()
    {
        $types = ProductType::all();
        return view('admin.product-types.index', compact('types'));
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|unique:product_types,name']);

        ProductType::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->back()->with('success', 'Category Type created.');
    }
    public function update(Request $request, ProductType $productType)
    {
        $validated = $request->validate([
            'name' => 'required|unique:product_types,name,' . $productType->id,
            'description' => 'nullable|string',
        ]);

        $productType->update([
            'name' => $request->name,
            'description' => $request->description,
            'status' => $request->has('status') ? 1 : 0, // Handles unchecked state
        ]);

        return redirect()->route('admin.product-types.index')->with('success', 'Category Type updated.');
    }

    public function edit(ProductType $productType)
    {
        return view('admin.product-types.edit', compact('productType'));
    }
}
