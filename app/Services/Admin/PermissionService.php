<?php

namespace App\Services\Admin;

use Spatie\Permission\Models\Permission;

class PermissionService
{
    public function getAllPermissions()
    {
        return Permission::all();
    }

    public function createPermission(array $data)
    {
        return Permission::create(['name' => $data['name']]);
    }
}
