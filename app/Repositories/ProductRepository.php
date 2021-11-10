<?php

namespace App\Repositories;

use App\Models\Product;
use App\Traits\BaseRepositoryTrait;
use Illuminate\Database\Eloquent\Model;

class ProductRepository
{
    use BaseRepositoryTrait;

    /**
     * @var Model
     */
    protected $model;

    public function __construct(Product $model)
    {
        $this->model = $model;
    }

    /**
     * 消費總額計算
     *
     * @param array $params
     * @return int
     */
    public function moneyTotal(array $params)
    {
        $total = 0;

        foreach ($params as $data) {
            $product = $this->model
                ->select()
                ->where('id', $data['pid'])
                ->first();

            $total = $total + ($product['price'] * $data['quantity']);
        }

        return $total;
    }

    /**
     * 商品庫存數量扣除
     *
     * @param array $params
     * @return array|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object
     */
    public function productSub(array $params)
    {
        foreach ($params as $data) {
            $product = $this->model
                ->select()
                ->where('id', $data['pid'])
                ->first();

            $product->stock = $product['stock'] - $data['quantity'];

            $product->save();
        }

        return;
    }
}
