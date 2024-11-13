<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;
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
            'registered_with' => $data['registered_with'],
        ]);
    }

    public function externalAuthorization(Request $request) {
        $data = $request->validate([
            'token' => 'required|string|min:10',
        ]);

//        dd(data: $data);

        $token = $data['token'];

        $googleURL = "https://www.googleapis.com/oauth2/v3/userinfo?access_token=";

//      $vkURL = "https://api.vk.com/method/";

        $googleData = Http::get($googleURL . $token)->json();

        Log::info($googleData);
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'authorization_type' => 'required|in:google,vk',
            'token' => 'required|string',
        ]);

        // Determine the authorization provider
        $provider = $request->input('authorization_type');

        switch ($provider) {
            case 'google':
                return $this->handleGoogleAuth($request->input('token'));

            case 'vk':
                return $this->handleVkAuth($request->input('token'));

            default:
                return response()->json(['error' => 'Invalid provider'], 400);
        }
    }

    private function handleGoogleAuth($token)
    {
        try {
            // Get Google user info via Socialite
            $googleUser = Socialite::driver('google')->userFromToken($token);

            // Find or create a user
            $user = User::firstOrCreate(
                ['email' => $googleUser->getEmail()],
                [
                    'name' => $googleUser->getName(),
                    'google_id' => $googleUser->getId(),
                    'avatar' => $googleUser->getAvatar(),
                ]
            );

            // Login the user
            Auth::login($user);

            // Respond with user data or token
            return response()->json(['user' => $user, 'token' => $user->createToken('YourApp')->plainTextToken]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Google authentication failed'], 400);
        }
    }

    private function handleVkAuth($token)
    {
        try {
            // Get VK user info via the VK API
            $vkUser = Socialite::driver('vkontakte')->userFromToken($token);

            // Find or create a user
            $user = User::firstOrCreate(
                ['email' => $vkUser->getEmail()],
                [
                    'name' => $vkUser->getName(),
                    'vk_id' => $vkUser->getId(),
                    'avatar' => $vkUser->getAvatar(),
                ]
            );

            // Login the user
            Auth::login($user);

            // Respond with user data or token
            return response()->json(['user' => $user, 'token' => $user->createToken('YourApp')->plainTextToken]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'VK authentication failed'], 400);
        }
    }
}
