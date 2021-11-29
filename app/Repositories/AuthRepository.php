<?php

namespace App\Repositories;

use App\Models\User;
use App\Traits\BaseRepositoryTrait;
use Illuminate\Database\Eloquent\Model;

class AuthRepository
{
    use BaseRepositoryTrait;

    /**
     * @var Model
     */
    protected $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    /**
     * 創建使用者
     *
     * @param array $params
     * @return array|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object
     */
    public function addUser(array $params)
    {
        $params['password'] = bcrypt($params['password']);

        $user = new User($params);
        $user->save();

        return [
            'id' => $user->id,
            'account' => $user->username
        ];
    }

    /**
     * 取得使用者詳細資訊
     *
     * @param string $username
     * @return array|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object
     */
    public function getAllInfo($username)
    {
        $user = $this->model
            ->select('*')
            ->leftJoin('users_information', 'users.id', '=', 'users_information.uid')
            ->where('username', $username)
            ->first();

        return $user;
    }
}
