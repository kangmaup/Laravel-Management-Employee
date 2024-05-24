<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PermissionController;
use App\Http\Controllers\Api\PositionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\WorkplaceController;
use App\Http\Controllers\EmployeeController;

// Route::controller(RegisterController::class)->group(function(){
//     Route::post('register', 'register');
//     Route::post('login', 'login');
// });

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [RegisterController::class, 'logout'])->middleware(['auth:api', 'permission:auth.logout']);
    Route::post('/refresh', [RegisterController::class, 'refresh'])->middleware(['auth:api', 'permission:auth.refresh']);
    Route::post('/me', [RegisterController::class, 'me'])->middleware(['auth:api', 'permission:auth.me']);
    Route::post('/me/change-password', [AuthController::class, 'changePassword'])->middleware(['auth:api', 'permission:auth.change-password']);
});

Route::group([
    'middleware' => "auth:api",
    'prefix' => 'employees'
], function ($router) {
    Route::get('', [EmployeeController::class, 'index'])->middleware('permission:employee.viewAny');
    Route::get('/{id}', [EmployeeController::class, 'show'])->middleware('permission:employee.view');
    Route::post('', [EmployeeController::class, 'store'])->middleware('permission:employee.create');
    Route::put('/{id}', [EmployeeController::class, 'update'])->middleware('permission:employee.update');
    Route::delete('/{id}', [EmployeeController::class, 'destroy'])->middleware('permission:employee.delete');
    Route::post('/{id}/avatar', [EmployeeController::class, 'uploadAvatar'])->middleware('permission:employee.upload-avatar');
});

Route::group([
    'middleware' => "auth:api",
    'prefix' => 'position'
], function ($router) {
    Route::get('', [PositionController::class, 'index'])->middleware('permission:position.viewAny');
    Route::get('/{id}', [PositionController::class, 'show'])->middleware('permission:position.view');
    Route::post('', [PositionController::class, 'store'])->middleware('permission:position.create');
    Route::put('/{id}', [PositionController::class, 'update'])->middleware('permission:position.update');
    Route::delete('/{id}', [PositionController::class, 'destroy'])->middleware('permission:position.delete');
});

Route::group([
    'middleware' => "auth:api",
    'prefix' => 'workplace'
], function ($router) {
    Route::get('', [WorkplaceController::class, 'index'])->middleware('permission:workplace.viewAny');
    Route::get('/{id}', [WorkplaceController::class, 'show'])->middleware('permission:workplace.view');
    Route::post('', [WorkplaceController::class, 'store'])->middleware('permission:workplace.create');
    Route::put('/{id}', [WorkplaceController::class, 'update'])->middleware('permission:workplace.update');
    Route::delete('/{id}', [WorkplaceController::class, 'destroy'])->middleware('permission:workplace.delete');
});

Route::group([
    'middleware' => 'auth:api',
    'prefix' => 'roles',
], function ($router) {
    Route::get('', [RoleController::class, 'index'])->middleware('permission:role.view');
    Route::post('', [RoleController::class, 'store'])->middleware('permission:role.create');
    Route::post('{id}/assign-permissions', [RoleController::class, 'assignPermissions'])->middleware('permission:role.create');
});

Route::group([
    'middleware' => 'auth:api',
    'prefix' => 'permissions',
], function ($router) {
    Route::get('', [PermissionController::class, 'index'])->middleware('permission:permission.view');
    Route::post('', [PermissionController::class, 'store'])->middleware('permission:permission.create');
});


Route::fallback(function () {
    return response()->json(['message' => 'Unauthorized.'], 401);
});





