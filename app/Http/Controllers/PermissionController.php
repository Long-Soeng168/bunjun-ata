<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::all();
        return view('role-permission.permission.index', [
            'permissions' => $permissions,
        ]);
    }

    public function create()
    {
        return view('role-permission.permission.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:permissions,name',
        ]);

        Permission::create([
            'name' => $request->name
        ]);

        return redirect('permissions')->with('status', 'Permission Add Successfully');
    }

    public function edit(Permission $permission)
    {
        // return $permission;
        return view('role-permission.permission.edit', [
            'permission' => $permission,
        ]);
    }
    public function update(Request $request, Permission $permission)
    {
        $request->validate([
            'name' => 'required|string|unique:permissions,name,' . $permission->id,
        ]);

        $permission->update([
            'name' => $request->name,
        ]);
        return redirect('permissions')->with('status', 'Update Permission Successfully');
    }
    public function destroy($id)
    {
        $permission = Permission::find($id);
        $permission->delete();

        return redirect('permissions')->with('status', 'Delete Permission Successfully');
    }

}