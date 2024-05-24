<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator as FacadesValidator;
use PHPOpenSourceSaver\JWTAuth\Exceptions\JWTException as ExceptionsJWTException;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth as FacadesJWTAuth;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Hash;


class AuthController extends BaseController
{



    public function login(Request $request): JsonResponse
    {

        $credentials = $request->only('email_phone', 'password');

        $validator = FacadesValidator::make($request->all(), [
            'email_phone' => 'required|string',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $loginType = filter_var($request->email_phone, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';

        $credentials = [$loginType => $request->email_phone, 'password' => $request->password];

        try {
            if (! $token = FacadesJWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }
        } catch (ExceptionsJWTException $e) {
            return response()->json(['error' => 'Could not create token'], 500);
        }
        $user = Auth::user();
        return $this->sendResponse([
            'token' => $token,
            'user_id' => $user->id,
            'email' => $user->email,
        ], 'Login successful');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:8|different:current_password',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json(['error' => 'The current password is incorrect'], 401);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return $this->sendResponse([], 'Password changed successfully', 200);
    }
}
