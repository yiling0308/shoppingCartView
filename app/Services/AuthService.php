<?php

namespace App\Services;

use App\Repositories\authRepository;

class AuthService extends BaseService
{
    /**
     * @var AuthRepository
     */
    private $authRepository;

    public function __construct(AuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    /**
     * 創建 Token
     *
     * @param string $params
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function createNewToken($params)
    {
        return [
            'access_token' => $params,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => auth()->user()
        ];
    }

    /**
     * 創建使用者
     *
     * @param array $params
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function addUser($params)
    {
        $user = $this->authRepository->addUser($params);

        return $user;
    }
}
