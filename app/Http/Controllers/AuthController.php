<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\AuthService;
use App\Enums\StatusCodeEnum;

class AuthController extends Controller
{
    /**
     * @var AuthService
     */
    private $authService;

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct(AuthService $authService)
    {
        $this->middleware('auth:api', ['except' => ['login', 'register', 'index']]);
        $this->authService = $authService;
    }

    /**
     * 使用者登入
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request)
    {
        $params = auth()->attempt($request->validated());

        $token = $this->authService->createNewToken($params);

        if (!$token) {
            return response()->fail(
                __('messages.login_fail'),
                StatusCodeEnum::LOGIN_FAIL
            );
        }

        return response()->success(
            $token,
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

        $user = $this->authService->addUser($validator);

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
        $token = $this->authService->createNewToken(auth()->refresh());

        return response()->success(
            $token,
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
}
