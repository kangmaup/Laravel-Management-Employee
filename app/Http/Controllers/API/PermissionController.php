<?php

namespace App\Http\Controllers\Api;


use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Spatie\Permission\Models\Permission;

class PermissionController extends BaseController
{
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10);
        $permissions = Permission::paginate($perPage);

        return $this->sendResponse(['permissions' => $permissions], 'List of permissions');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:permissions',
        ]);

        $permission = Permission::create(['name' => $request->name]);

        return $this->sendResponse(['permission' => $permission], 'Permission created successfully', 201);
    }
}
