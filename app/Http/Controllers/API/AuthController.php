<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class AuthController extends Controller
{
    public function index()
    {
        return response()->json(User::all());
    }
    public function login(LoginRequest $request)
    {

        $data = $request->validated();

        if (Auth::attempt($request->only('phone', 'password'))) {
            $user = Auth::user();
            $token = $user->createToken('auth-token')->plainTextToken;

            return response()->json([
                'token' => $token,
                'user' => $user,
            ]);
        }

        return response()->json([
            'message' => 'Invalid credentials'
        ], 401);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->guard('sanctum')->user()->tokens()->delete();
        return response()->json(['message' => 'Logged out successfully'], ResponseAlias::HTTP_OK);
    }

    public function register(RegisterRequest $request)
    {
        $user = $this->createUser($request->validated());

        $token = $user->createToken('Auth')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'User registered successfully.',
            'user' => $user,
            'token' => $token,
        ], ResponseAlias::HTTP_CREATED);
    }


    private function createUser(array $data): User
    {
        return User::create([
            'name' => $data['name'],
            'last_name' => $data['last_name'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
}
