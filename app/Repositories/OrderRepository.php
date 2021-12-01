<?php

namespace App\Repositories;

use App\Models\Order;
use App\Traits\BaseRepositoryTrait;
use Illuminate\Database\Eloquent\Model;
use DB;

class OrderRepository
{
    use BaseRepositoryTrait;

    /**
     * @var Model
     */
    protected $model;

    public function __construct(Order $model)
    {
        $this->model = $model;
    }

    /**
     * 查詢今日訂單數量
     *
     * @param string $date
     * @return array|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object
     */
    public function checkOrderNum(string $date)
    {
        $buyDetail = $this->model
            ->select()
            ->where('created_at', 'like', $date."%")
            ->count();

        return $buyDetail;
    }

    /**
     * 建立訂單
     *
     * @param string $params
     * @param int $uid
     * @param int $total
     * @return array|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object
     */
    public function createOrder($oid, $uid, $total)
    {
        $order = new Order;
        $order->oid = $oid;
        $order->uid = $uid;
        $order->total = $total;

        return $order->save();
    }

    /**
     * 查詢使者者所有訂單
     *
     * @param int $uid
     * @return array|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object
     */
    public function findUserOrder(int $uid)
    {
        $query = $this->model
            ->select('id', 'oid', 'total', DB::raw('DATE_FORMAT(created_at, "%Y-%m-%d %H:%i:%s") as create_at'))
            ->where('uid', $uid)
            ->get()
            ->toArray();

        return $query;
    }
}
