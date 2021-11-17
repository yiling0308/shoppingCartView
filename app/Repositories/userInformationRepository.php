<?php

namespace App\Repositories;

use App\Models\UserInformation;
use App\Traits\BaseRepositoryTrait;
use Illuminate\Database\Eloquent\Model;

class UserInformationRepository
{
    use BaseRepositoryTrait;

    /**
     * @var Model
     */
    protected $model;

    public function __construct(UserInformation $model)
    {
        $this->model = $model;
    }

    /**
     * 創建使用者詳細資訊
     *
     * @param array $params
     * @return int
     */
    public function insertInformation($params)
    {
        $user = new UserInformation($params);
        $user->save();

        return $user;
    }

    /**
     * 更新使用者詳細資訊
     *
     * @param array $params
     * @param int $uid
     * @return int
     */
    public function updateInformation($params, $uid)
    {
        $user = $this->model
            ->select()
            ->where('uid', $uid)
            ->first();

        if ($params['sex']) {
            $user->sex = $params['sex'];
        }

        if ($params['birthday']) {
            $user->birthday = $params['birthday'];
        }

        if ($params['phone']) {
            $user->phone = $params['phone'];
        }

        if ($params['county']) {
            $user->county = $params['county'];
        }

        if ($params['district']) {
            $user->district = $params['district'];
        }

        if ($params['address']) {
            $user->address = $params['address'];
        }

        return $user->save();
    }
}
