<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct(
        protected AuthService $authService
    ) {}

    public function register(RegisterRequest $request)
    {
        $user = $this->authService->register(
            data: $request->validated()
        );

        return response()->json([
            'message' => 'User successfully registered',
            'user' => $user,
        ], 201);
    }

    public function login(LoginRequest $request)
    {
        $data = $this->authService->login(
            data: $request->validated()
        );

        return response()->json([
            'message' => 'Successfully logged in',
            'data' => $data,
        ]);
    }

    public function logout(Request $request)
    {
        $this->authService->logout(
            user: $request->user()
        );

        return response()->json([
            'message' => 'Successfully logged out',
        ]);
    }
}
