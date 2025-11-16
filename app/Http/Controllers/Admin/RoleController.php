<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Admin\RoleService;
use App\Services\Admin\PermissionService;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    protected $roleService;
    protected $permissionService;

    public function __construct(RoleService $roleService, PermissionService $permissionService)
    {
        $this->roleService = $roleService;
        $this->permissionService = $permissionService;
    }

    public function index()
    {
        $roles = $this->roleService->getAllRoles();
        $permissions = $this->permissionService->getAllPermissions();
        return view('admin.roles.index', compact('roles', 'permissions'));
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string|unique:roles,name']);
        $this->roleService->createRole($request->only('name'));
        return back()->with('success', 'Role created successfully!');
    }

    public function edit(Role $role)
    {
        $permissions = $this->permissionService->getAllPermissions();
        return view('admin.roles.edit', compact('role', 'permissions'));
    }

    public function update(Request $request, Role $role)
    {
        $this->roleService->updateRole($role, $request->only('name'));
        $this->roleService->assignPermissions($role, $request->permissions ?? []);
        return redirect()->route('admin.roles.index')->with('success', 'Role updated successfully!');
    }

    public function destroy(Role $role)
    {
        $role->delete();
        return back()->with('success', 'Role deleted successfully!');
    }
}
