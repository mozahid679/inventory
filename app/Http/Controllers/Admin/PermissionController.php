<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::all();
        return view('admin.permissions.index', compact('permissions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:permissions,name'
        ]);

        Permission::create([
            'name' => $request->name,
            'guard_name' => 'web'
        ]);

        return back()->with('success', 'Permission created successfully.');
    }

    public function update(Request $request, Permission $permission)
    {
        $request->validate([
            'name' => 'required|unique:permissions,name,' . $permission->id,
        ]);

        $permission->update([
            'name' => $request->name
        ]);

        return redirect()->route('admin.permissions.index')
            ->with('success', 'Permission updated successfully');
    }

    // If you want to keep the "edit" route but just make it jump back to index:
    public function edit(Permission $permission)
    {
        return redirect()->route('admin.permissions.index', ['edit' => $permission->id]);
    }


    public function destroy(Permission $permission)
    {
        $permission->delete();
        return back()->with('success', 'Permission deleted.');
    }
}
