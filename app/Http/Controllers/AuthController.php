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
     * 使用者登入
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
     * 註冊使用者
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
     * 使用者登出
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
     * 重置使用者 Token
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
     * 查看使用者資訊
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
     * 創建 Token
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
