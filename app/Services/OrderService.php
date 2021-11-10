<?php

namespace App\Services;

use App\Repositories\OrderRepository;
use App\Repositories\ProductRepository;
use App\Repositories\OrderDetailRepository;
use Carbon\Carbon;

class OrderService extends BaseService
{
    /**
     * @var OrderRepository
     */
    private $orderRepository;

    /**
     * @var OrderDetailRepository
     */
    private $orderDetailRepository;

    /**
     * @var ProductRepository
     */
    private $productRepository;

    public function __construct(
        OrderRepository $orderRepository,
        OrderDetailRepository $orderDetailRepository,
        ProductRepository $productRepository
    )
    {
        $this->orderRepository = $orderRepository;
        $this->orderDetailRepository = $orderDetailRepository;
        $this->productRepository = $productRepository;
    }

    /**
     * 下單
     *
     * @param array $params
     * @return array|null
     */
    public function buy(array $params)
    {
        $uid = auth()->id();
        $now = Carbon::now()->timezone('Asia/Taipei')->format('YmdHis');
        $date = Carbon::now()->timezone('Asia/Taipei')->format('Y-m-d');

        // 查詢今日訂單數量
        $orderCount = $this->orderRepository->checkOrderNum($date);

        $orderNum = sprintf("%02d", $orderCount + 1);
        $params['oid'] = $now . $orderNum;

        // 商品庫存數量扣除
        $this->productRepository->productSub($params['list']);

        // 消費總額計算
        $total = $this->productRepository->moneyTotal($params['list']);

        // 建立訂單
        $this->orderRepository->createOrder($params['oid'], $uid, $total);

        // 建立訂單明細
        $this->orderDetailRepository->insertOrderDetail($params['list'], $params['oid']);

        return [
            'oid' => $params['oid']
        ];
    }
}
