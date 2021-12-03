<?php

namespace App\Repositories;

use App\Models\OrderDetail;
use App\Traits\BaseRepositoryTrait;
use Illuminate\Database\Eloquent\Model;

class OrderDetailRepository
{
    use BaseRepositoryTrait;

    /**
     * @var Model
     */
    protected $model;

    public function __construct(OrderDetail $model)
    {
        $this->model = $model;
    }

    /**
     * 建立訂單詳細資料
     *
     * @param array $params
     * @param string $oid
     * @return array|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object
     */
    public function insertOrderDetail(array $params,string $oid)
    {
        foreach ($params as $data) {
            $orderDetail = new OrderDetail;
            $orderDetail->ooid = $oid;
            $orderDetail->pid = $data['pid'];
            $orderDetail->quantity = $data['quantity'];

            $orderDetail->save();
        }

        return $orderDetail;
    }

    /**
     * 查詢訂單明細
     *
     * @param object $params
     * @return array|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object
     */
    public function findOrder(object $params)
    {
        $query = $this->model
            ->select('product.name', 'order_detail.quantity', 'product.price')
            ->where('ooid', $params->oid)
            ->join('product', 'product.id', '=', 'order_detail.pid')
            ->get()
            ->toArray();

        return $query;
    }
}
