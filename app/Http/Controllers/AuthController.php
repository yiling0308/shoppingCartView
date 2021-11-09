<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Enums\StatusCodeEnum;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request)
    {
        $token = auth()->attempt($request->validated());

        if (!$token) {
            return response()->fail(
                __('messages.login_fail'),
                StatusCodeEnum::LOGIN_FAIL
            );
        }

        return response()->success(
            $this->createNewToken($token),
            __('messages.login_success'),
            StatusCodeEnum::LOGIN_SUCCESS
        );
    }

    /**
     * Register a User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(RegisterRequest $request)
    {
        $validator = $request->validated();

        $user = User::create(array_merge(
            $validator,
            ['password' => bcrypt($request->password),]
        ));

        return response()->success(
            $user,
            __('messages.create_success'),
            StatusCodeEnum::CREATE_SUCCESS
        );
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->success(
            __('messages.logout_success'),
            StatusCodeEnum::LOGOUT_SUCCESS
        );
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return response()->success(
            $this->createNewToken(auth()->refresh()),
            __('messages.update_success'),
            StatusCodeEnum::UPDATE_SUCCESS
        );
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function userProfile()
    {
        return response()->success(
            auth()->user(),
            __('messages.success'),
            StatusCodeEnum::SUCCESS
        );
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function createNewToken($token)
    {
        return [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => auth()->user()
        ];
    }
}
