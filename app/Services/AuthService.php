<?php

namespace App\Services;

use App\Repositories\authRepository;
use App\Repositories\userInformationRepository;
use File;

class AuthService extends BaseService
{
    /**
     * @var AuthRepository
     */
    private $authRepository;

    /**
     * @var UserInformationRepository
     */
    private $userInformationRepository;

    public function __construct(AuthRepository $authRepository, UserInformationRepository $userInformationRepository)
    {
        $this->authRepository = $authRepository;
        $this->userInformationRepository = $userInformationRepository;
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
        if ($params['password'] == $params['password_confirm']) {
            unset($params['password_confirm']);
            $user = $this->authRepository->addUser($params);
        }

        $uid = $this->authRepository->getOne(['id'], ['username' => $params['username']])->id;

        $params = [
            'uid' => $uid
        ];

        $this->userInformationRepository->insertInformation($params);

        return $user;
    }

    /**
     * 取得使用者資訊
     *
     * @param string $param
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUser($param)
    {
        $user = $this->authRepository->getAllInfo($param);

        return $user;
    }

    /**
     * 修改使用者姓名
     *
     * @param array $params
     * @param string $username
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function editName($params, $username)
    {
        $user = $this->authRepository->update(['name' => $params['name']], ['username' => $username]);

        return $user;
    }

    /**
     * 更換大頭貼
     *
     * @param object $image
     * @param string $username
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function changeImage($image, $username)
    {
        // delete old image file
        $allFiles = File::files('images/user');
        $matchingFiles = preg_grep('/'.$username.'\.(gif|jpe?g|bmp|png)$/', $allFiles);

        foreach ($matchingFiles as $path) {
            File::delete($path);
        }

        $destinationPath = 'images/user';
        $profileImage = $username . "." .$image->extension();
        $image->move($destinationPath, $profileImage);

        $this->authRepository->update(['image_name' => $profileImage], ['username' => $username]);
    }

    /**
     * 修改使用者密碼
     *
     * @param array $param
     * @param string $username
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function changePwd($param, $username)
    {
        $password = bcrypt($param['password']);

        $user = $this->authRepository->update(['password' => $password], ['username' => $username]);

        return $user;
    }

    /**
     * 修改或新建使用者詳細資料
     *
     * @param array $param
     * @param string $username
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function editInformation($param, $username)
    {
        $uid = $this->authRepository->getOne(['id'], ['username' => $username])->id;

        $user = $this->userInformationRepository->updateInformation($param, $uid);

        return $user;
    }
}
