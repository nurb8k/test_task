<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        $token = $user->createToken('token')->plainTextToken;

        return $this->successResponse([
            'token' => $token,
        ], 'User registered successfully', 201);
    }

    public function login(LoginRequest $request)
    {
         if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();
            $token = $user->createToken('token-name')->plainTextToken;

            return $this->successResponse([
                'token' => $token,
            ], 'User logged in successfully', 200);

        } else
           return $this->errorResponse('Invalid credentials', 401);

    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return $this->successResponse([], 'User logged out successfully', 200);
    }

}
