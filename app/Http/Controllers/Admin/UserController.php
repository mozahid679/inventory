<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{


    public function index()
    {
        $users = User::with('roles')->paginate(10);
        return view('admin.users.index', compact('users'));
    }
    public function create()
    {
        $roles = Role::all();
        return view('admin.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'phone_no' => ['nullable', 'string', 'max:20'],
            'designation' => ['nullable', 'string', 'max:100'],
            'address' => ['nullable', 'string', 'max:255'],
            'photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2024'],
            'roles' => ['required', 'array'],
        ]);

        // Handle photo path first
        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('photos', 'public');
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone_no' => $request->phone_no,
            'designation' => $request->designation,
            'address' => $request->address,
            'photo' => $photoPath,
        ]);

        // Spatie logic - syncRoles works perfectly here
        $user->syncRoles($request->roles);

        return redirect()
            ->route('admin.users.index')
            ->with('success', "User {$user->name} created successfully with assigned roles.");
    }
    public function edit(User $user)
    {
        $roles = Role::all();
        $userRoles = $user->roles->pluck('id')->toArray();

        return view('admin.users.edit', compact('user', 'roles', 'userRoles'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone_no' => 'nullable|string|max:20',
            'designation' => 'nullable|string|max:100',
            'address' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'roles' => 'required|array'
        ]);
        $user->update($request->only('name', 'email', 'phone_no', 'designation', 'address'));


        if ($request->hasFile('photo')) {

            $photoPath = $request->file('photo')->store('photos', 'public');
            $user->photo = $photoPath;
            $user->save();
        }


        // 3. Sync Roles
        $user->syncRoles($request->roles);

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }
}
