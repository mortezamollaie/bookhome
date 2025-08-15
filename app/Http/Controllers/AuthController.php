<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\SignUpRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Responses\ApiResponse;

class AuthController extends Controller
{
    /**
     * Handle signup request
     */
    public function signup(SignUpRequest $request)
    {
        try {
            // Create the user
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            $userData = [
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'created_at' => $user->created_at
                ]
            ];

            return ApiResponse::created('User created successfully', $userData);

        } catch (\Exception $e) {
            return ApiResponse::serverError('User creation failed', $e->getMessage());
        }
    }

    public function login(LoginRequest $request)
    {
        try {
            $credentials = $request->only('email', 'password');

            if (Auth::attempt($credentials)) {
                $user = Auth::user();
                $token = $user->createToken('bookhome')->plainTextToken;

                return ApiResponse::success('Login successful', [
                    'user_name' => $user->name,
                    'user_email' => $user->email,
                    'token' => $token
                ]);
            }

            return ApiResponse::unauthorized('Invalid credentials');
        } catch (\Exception $e) {
            return ApiResponse::serverError('Login failed', $e->getMessage());
        }
    }
}
