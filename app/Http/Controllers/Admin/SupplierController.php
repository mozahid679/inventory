<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SupplierController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::all();
        return view('admin.suppliers.index', compact('suppliers'));
    }
    public function edit(Supplier $supplier)
    {
        return view('admin.suppliers.edit', compact('supplier'));
    }

    public function show(Supplier $supplier)
    {
        // Eager load the supplier's products or stock history for the detail page
        $supplier->load('products');

        return view('admin.suppliers.show', compact('supplier'));
    }
    public function create()
    {
        return view('admin.suppliers.create');
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'phone'   => 'required|string|max:20',
            'address' => 'required|string',
        ]);

        // This checks if ALL these 4 fields match an existing record
        $supplier = Supplier::firstOrCreate(
            [
                'name'    => $validated['name'],
                'email'   => $validated['email'],
                'phone'   => $validated['phone'],
                'address' => $validated['address'],
            ]
        );

        if ($supplier->wasRecentlyCreated) {
            $message = 'New supplier created successfully.';
        } else {
            $message = 'Supplier already exists, using existing record.';
        }

        return redirect()->route('admin.suppliers.index')->with('status', $message);
    }

    public function update(Request $request, Supplier $supplier)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email',
        ]);

        $supplier->update([
            'name'           => $request->name,
            'email'          => $request->email,
            'phone'          => $request->phone,
            'address'        => $request->address,
            'status'         => $request->has('status') ? 1 : 0,
        ]);

        return redirect()->route('admin.suppliers.index')->with('success', 'Supplier updated successfully.');
    }

    public function destroy(Supplier $supplier)
    {
        $supplier->delete();
        return redirect()->route('admin.suppliers.index')->with('success', 'Supplier deleted successfully.');
    }
}
