<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ProductType;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::with('productType')->get();
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        $types = ProductType::all();
        $parentCategories = Category::whereNull('parent_id')->get();
        return view('admin.categories.create', compact('types', 'parentCategories'));
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required', 'product_type_id' => 'required']);

        Category::create([
            'name' => $request->name,
            'product_type_id' => $request->product_type_id,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Category created.');
    }

    public function edit(Category $category)
    {
        $types = ProductType::all();
        $parentCategories = Category::whereNull('parent_id')->get();
        return view('admin.categories.edit', compact('category', 'types', 'parentCategories'));
    }
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'product_type_id' => 'required|exists:product_types,id',
        ]);

        $category->update([
            'name' => $request->name,
            'product_type_id' => $request->product_type_id,
            'description' => $request->description,
            'status' => $request->has('status') ? 1 : 0,
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully.');
    }
}
