<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Http\Controllers\API\BaseController as BaseController;

class EmployeeController extends BaseController
{

    public function index(Request $request) {
        $perPage = $request->get('per_page', 10);
        $employees = Employee::with(['user', 'position', 'workplace'])->paginate($perPage);
        $formattedEmployees = collect($employees->items())->map(function ($employee) {
            return [
                'id' => $employee->id,
                'name' => $employee->name,
                'position' => $employee->position->name,
                'workplace' => $employee->workplace->name,
            ];
        });

        return $this->sendResponse([
            'employees' => $formattedEmployees,
            'per_page' => $employees->perPage(),
            'current_page' => $employees->currentPage(),
        ], 'List of employees');
    }



    public function show($id) {
    $employee = Employee::with(['user', 'position', 'workplace'])->find($id);

    if (!$employee) {
        return $this->sendResponse(null, 'Employee not found', 404);
    }

    $response = [
        'id' => $employee->id,
        'name' => $employee->user->name,
        'email' => $employee->user->email,
        'name_position' => $employee->position->name,
        'name_workplace' => $employee->workplace->name,
    ];

    return $this->sendResponse($response, 'Employee retrieved successfully');
    }


    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            // Validasi untuk user
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'phone' => 'required|string|max:15|unique:users',

            // Validasi untuk employee
            'position_id' => 'required|exists:positions,id',
            'workplace_id' => 'required|exists:workplaces,id',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'role'=> 'required|exist:roles,name'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Memproses file avatar jika ada
        $avatarPath = null;
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $avatarPath = $file->store('avatars', 'public');
        }

        // Membuat user baru
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);


        $employeeData = $validator->validated();
        $employeeData['user_id'] = $user->id;
        if ($avatarPath) {
            $employeeData['avatar'] = $avatarPath;
        }

        $employee = Employee::create($employeeData);

        $roleName = $request->input('role');
        $role = Role::findOrCreate($roleName);


        $user->assignRole($role);

        return response()->json(['employee' => $employee, 'user' => $user], 201);
    }

    public function update(Request $request, $id)
    {
        $employee = Employee::find($id);

        if (!$employee) {
            return response()->json(['message' => 'Employee not found'], 404);
        }
        // Menampilkan data dari field 'name' dalam form
    // $name = $request->input('name');
    // dd($name);

    // // Menampilkan data dari payload JSON dengan key 'email'
    // $email = $request->input('email');
    // dd($email);

        $validator = Validator::make($request->all(), [
            'name' => 'string|max:255',
            'position_id' => 'exists:positions,id',
            'workplace_id' => 'exists:workplaces,id',
            'email' => [
                'email',
                Rule::unique('users')->ignore($employee->user->id),
            ],
            'phone' => [
                'string',
                Rule::unique('users')->ignore($employee->user->id),
            ],
        ]);

        $validator->sometimes('email', 'unique:users', function ($input) use ($employee) {
            return $employee->user->email !== $input->email;
        });

        $validator->sometimes('phone', 'unique:users', function ($input) use ($employee) {
            return $employee->user->phone !== $input->phone;
        });

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $employee->update($validator->validated());

        // Update user's email and phone
        $employee->user->update([
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
        ]);

        $result =
            [
                'id' => $employee->id,
                'name' => $employee->name,
                'user_id' => $employee->user_id,
                'position_id' => (int) $employee->position_id,
                'workplace_id' => (int) $employee->workplace_id,
            ];

        return response()->json([
            'employee' => $result
        ], 200);
    }

    public function destroy($id)
    {
        $employee = Employee::find($id);

        if (!$employee) {
            return response()->json(['message' => 'Employee not found'], 404);
        }

        $employee->delete();

        return response()->json(['message' => 'Employee deleted successfully'], 200);
    }

    public function uploadAvatar(Request $request, $id)
    {
        $employee = Employee::find($id);

        if (!$employee) {
            return response()->json(['message' => 'Employee not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $path = $file->store('avatars', 'public');

            $employee->avatar = $path;
            $employee->save();
        }

        return response()->json(['employee' => $employee], 200);
    }
}
