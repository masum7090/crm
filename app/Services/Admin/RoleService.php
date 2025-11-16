<?php

namespace App\Services\Admin;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleService
{
    public function getAllRoles()
    {
        return Role::with('permissions')->get();
    }

    public function createRole(array $data)
    {
        return Role::create(['name' => $data['name'], 'guard_name'=>'admin']);
    }

    public function updateRole(Role $role, array $data)
    {
        $role->update(['name' => $data['name']]);
        return $role;
    }

    public function assignPermissions(Role $role, array $permissions)
    {
        $role->syncPermissions($permissions);
    }
}
