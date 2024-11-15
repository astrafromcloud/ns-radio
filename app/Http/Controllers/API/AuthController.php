<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Exception;
use GuzzleHttp\Client as GuzzleClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    protected GuzzleClient $http;

    public function __construct()
    {
        $this->http = new GuzzleClient([
            'http_errors' => true
        ]);
    }

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
            //            'registered_with' => $data['registered_with'],
        ]);
    }

    public function authenticate(Request $request)
    {
        $data = $request->validate([
            'authorization_type' => 'required|in:google,vk',
            'token' => 'required|string',
        ]);

        $provider = $data['authorization_type'];

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
            $userData = $this->getGoogleUserByToken($token);
            if (!$userData['email_verified']) throw new Exception("Email is not verified!");

            $user = User::firstOrCreate(
                ['email' => $userData['email']],
                [
                    'name' => $userData['given_name'],
                    'last_name' => $userData['family_name'],
                    'phone' => null,
                    'email_verified_at' => now(),
                    'password' => bcrypt(Str::random(20))
                ]
            );

            Auth::login($user);

            return response()->json(['user' => $user, 'token' => $user->createToken('NS-Radio')->plainTextToken]);
        } catch (\Exception $e) {
            Log::error("HERE", [$e]);
            return response()->json(['error' => 'Google authentication failed'], 400);
        }
    }

    private function getGoogleUserByToken($token)
    {
        $response = $this->http->get(
            'https://www.googleapis.com/oauth2/v3/userinfo',
            [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                ],
            ]
        );

        return json_decode($response->getBody()->getContents(), true);
    }

    private function handleVkAuth($token)
    {
        try {
            // Get VK user info via the VK API
            $vkUser = $this->getVKUserByToken($token);
            dd($vkUser);

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

            dd($e);
            return response()->json(['error' => 'VK authentication failed'], 400);
        }
    }

    protected function getVKUserByToken($token)
    {
        $formToken = [];

        if (is_array($token)) {
            $formToken['email'] = $token['email'] ?? null;

            $token = $token['access_token'];
        }

        $params = http_build_query([
            'access_token' => $token,
            'fields'       => implode(',', ['id', 'email', 'first_name', 'last_name', 'screen_name', 'photo_200', 'verified', 'phone_number']),
            'lang'         => config("app.locale"),
            'v'            => "5.131",
        ]);

        $response = $this->http->get('https://api.vk.com/method/users.get?' . $params);

        $contents = (string) $response->getBody();

        $response = json_decode($contents, true);

        if (!is_array($response) || !isset($response['response'][0])) {
            throw new RuntimeException(sprintf(
                'Invalid JSON response from VK: %s',
                $contents
            ));
        }

        return array_merge($formToken, $response['response'][0]);
    }
}
