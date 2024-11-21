<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Jobs\SendResetPasswordEmail;
use App\Mail\ResetPasswordEmail;
use App\Models\User;
use Exception;
use GuzzleHttp\Client as GuzzleClient;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use RuntimeException;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

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

    public function sendResetLinkEmail(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|string|email|exists:users,email',
        ]);

        $throttleKey = $request->email . '|' . $request->ip();
        RateLimiter::clear($throttleKey);

        $locale = app()->getLocale();

        $status = Password::sendResetLink(
            $request->only('email'),
            function ($user, $token) use ($locale) {
                $resetUrl = env('APP_URL') . "/reset-password?token={$token}&email={$user->email}";

                // Dispatch the job
                SendResetPasswordEmail::dispatch($user->email, $resetUrl)->onQueue('emails');
            }
        );

        return $status === Password::RESET_LINK_SENT
            ? response()->json(['message' => __($status)], 200)
            : response()->json(['message' => __($status)], 500);
    }

    /**
     * Reset the password.
     */
    public function resetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'token' => 'required',
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                ])->save();
            }
        );

        return $status === Password::PASSWORD_RESET
            ? response()->json(['message' => __($status)], 200)
            : response()->json(['message' => __($status)], 500);
    }

    public function validateResetToken(Request $request)
    {
        $data = $request->validate([
            'token' => 'required|string',
            'email' => 'required|email|exists:users,email',
        ]);

        $status = Password::broker()->tokenExists(
            User::where('email', $request->email)->first(),
            $request->token
        );

        return response()->json([
            'valid' => $status,
        ]);
    }
}
