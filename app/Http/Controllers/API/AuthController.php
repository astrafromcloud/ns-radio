<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
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
    //    public function logout()
    //    {
    //        auth()->guard('sanctum')->user()->tokens()->delete();
    //        return response()->json(['message' => 'Logged out successfully'], ResponseAlias::HTTP_OK);
    //    }

    public function logout()
    {
        try {
            $user = auth('sanctum')->user();

            if (!$user) {
                return response()->json([
                    'message' => 'No authenticated user found'
                ], ResponseAlias::HTTP_UNAUTHORIZED);
            }

            // Revoke all tokens for the user
            $user->tokens()->delete();

            return response()->json([
                'message' => 'Logged out successfully'
            ], ResponseAlias::HTTP_OK);
        } catch (\Exception $e) {
            // Log the exception for debugging
            Log::error('Logout Error: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);

            return response()->json([
                'message' => 'An error occurred during logout. Please try again later.'
            ], ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);
        }
    }



    public function register(RegisterRequest $request)
    {
        try {
            $user = $this->createUser($request->validated());

            $token = $user->createToken('Auth')->plainTextToken;

            return response()->json([
                'success' => true,
                'message' => 'User registered successfully.',
                'user' => $user,
                'token' => $token,
            ], ResponseAlias::HTTP_CREATED);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Happened error: ' . $e,
                // 'user' => $user,
                // 'token' => $token,
            ], ResponseAlias::HTTP_BAD_GATEWAY);
        }
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
