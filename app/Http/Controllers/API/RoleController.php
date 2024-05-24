<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\API\BaseController as BaseController;
use Spatie\Permission\Contracts\Permission;

class RoleController extends BaseController
{
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10);
        $roles = Role::paginate($perPage);

        return $this->sendResponse(['roles' => $roles], 'List of roles');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:roles',
            'permissions' => 'nullable|array',
            'permissions.*' => 'exists:permissions,name',
        ]);

        $role = Role::create(['name' => $request->name]);

        
        if ($request->has('permissions')) {
            $permissions = Permission::whereIn('name', $request->permissions)->get();
            $role->syncPermissions($permissions);
        }

        return $this->sendResponse(['role' => $role], 'Role created successfully', 201);
    }

    public function assignPermissions(Request $request, $roleId)
    {
        $request->validate([
            'permissions' => 'required|array',
            'permissions.*' => 'exists:permissions,name',
        ]);

        $role = Role::findOrFail($roleId);

        $permissions = Permission::whereIn('name', $request->permissions)->get();

        $role->syncPermissions($permissions);

        return $this->sendResponse(['role' => $role], 'Permissions assigned to role successfully');
    }
}
