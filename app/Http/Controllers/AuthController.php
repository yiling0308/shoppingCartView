<?php
namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\EditRequest;
use App\Http\Requests\ChangePwdRequest;
use App\Http\Requests\EditInformationRequest;
use App\Services\AuthService;
use Session;

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
        $this->authService = $authService;
    }

    /**
     * 使用者登入畫面
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return view('login');
    }

    /**
     * 使用者註冊畫面
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function registerPage()
    {
        return view('register');
    }

    /**
     * 使用者登入
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request)
    {
        if (!auth()->attempt($request->validated())) {
            return back()->withErrors([
                'errors' => 'User not found',
            ]);
        }

        Session::put('username', auth()->user()->username);

        return redirect('/');
    }

    /**
     * 註冊使用者
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(RegisterRequest $request)
    {
        $validator = $request->validated();

        try {
            $user = $this->authService->addUser($validator);
        } catch (\Exception $e) {
            return back()->withErrors([
                'errors' => $e,
            ]);
        }

        $user = auth()->attempt(["username" => $validator['username'], "password" => $validator['password']]);

        if (!$user) {
            return back()->withErrors([
                'errors' => 'User not found',
            ]);
        }

        Session::put('username', auth()->user()->username);

        return redirect('/');
    }

    /**
     * 使用者登出
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        Session::forget('username');

        return redirect('/');
    }

    /**
     * 查看使用者資訊
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function userProfile()
    {
        $username = Session::get('username');

        if (!$username) {
            return view('login');
        }

        $user = $this->authService->getUser($username);

        return view('userprofile')->with("users", $user);
    }

    /**
     * 修改使用者姓名與大頭貼
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function editName(EditRequest $request)
    {
        $validator = $request->validated();
        $username = Session::get('username');
        $image = $request->file('image');

        if ($validator['name']) {
            $this->authService->editName($validator, $username);
        }

        if ($image) {
            $this->authService->changeImage($image, $username);
        }

        return redirect('/profile');
    }

    /**
     * 修改使用者密碼
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function changePwd(ChangePwdRequest $request)
    {
        $username = Session::get('username');

        $validator = $request->validated();

        if (!auth()->attempt(["username" => $username, "password" => $validator['old_pwd']])) {
            return back()->withErrors([
                'errors' => 'Incorrect old password',
            ]);
        }

        $this->authService->changePwd($validator, $username);

        return redirect('/profile');
    }

    /**
     * 修改使用者詳細資訊
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function editInformation(EditInformationRequest $request)
    {
        $validator = $request->validated();
        $username = Session::get('username');

        $this->authService->editInformation($validator, $username);

        return redirect('/profile');
    }
}
