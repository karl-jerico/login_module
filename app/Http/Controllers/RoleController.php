<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\RoleFormRequest;
use App\Http\Requests\UpdateUserRequest;

class RoleController extends Controller
{
    /**
     * Display a listing of the users.
     */
    public function index()
    {
        if (!auth()->user()->hasPermissionTo('view')) {
            abort(403, 'Unauthorized action.');
        }

        $users = User::all();
        return view('roles.index', compact('users'));
    }

    /**
     * Store a newly created user in storage.
     */
    public function store(RoleFormRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();

        User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
        ])
            ->assignRole($validatedData['role']);

        return redirect()->route('roles.index')->with('success', 'User created successfully!');
    }

    /**
     * Show the form for creating a new user.
     */
    public function create(): View
    {
        if (!auth()->user()->hasPermissionTo('view')) {
            abort(403, 'Unauthorized action.');
        }

        $roles = Role::all();
        return view('roles.create', compact('roles'));
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit($id): View
    {
        if (!auth()->user()->hasPermissionTo('view')) {
            abort(403, 'Unauthorized action.');
        }

        $user = User::findOrFail($id);
        $roles = Role::all();
        return view('roles.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified user in storage.
     */
    public function update(UpdateUserRequest $request, $id): RedirectResponse
    {
        $user = User::findOrFail($id);
    
        if (auth()->user()->hasRole('admin')) {
            if ($request->input('role') === 'superadmin') {
                return redirect()->route('roles.index')->with('error', 'Admin cannot update user to superadmin role!');
            }

            if ($user->hasRole('superadmin')) {
                return redirect()->route('roles.index')->with('error', 'Admin cannot update superadmin user role!');
            }
        }
    
        $user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
        ]);
    
        $user->syncRoles([$request->input('role')]);
    
        return redirect()->route('roles.index')->with('success', 'User updated successfully!');
    }

    /**
     * Remove the specified user from storage.
     */
    public function destroy($id): RedirectResponse
    {
        $user = User::findOrFail($id);

        if (!auth()->user()->hasPermissionTo('delete')) {
            abort(403, 'Unauthorized action.');
        }

        $user->delete();

        return redirect()->route('roles.index')->with('success', 'User deleted successfully!');
    }
}
