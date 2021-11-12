<?php

namespace App\Services;

use App\Repositories\OrderRepository;
use App\Repositories\ProductRepository;
use App\Repositories\OrderDetailRepository;
use Illuminate\Support\Facades\Log;
use App\Enums\StatusCodeEnum;
use Carbon\Carbon;
use DB;

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

        // 消費總額計算
        $total = $this->productRepository->moneyTotal($params['list']);

        DB::beginTransaction();

        try {
            // 商品庫存數量扣除
            if (!$this->productRepository->productSub($params['list'])) {
                DB::rollback();

                throw new \Exception('Product stock deduction failed', StatusCodeEnum::FAIL);
            }

            // 建立訂單
            if (!$this->orderRepository->createOrder($params['oid'], $uid, $total)) {
                DB::rollback();

                throw new \Exception('Create order failed', StatusCodeEnum::FAIL);
            }

            // 建立訂單明細
            if(!$this->orderDetailRepository->insertOrderDetail($params['list'], $params['oid'])) {
                DB::rollback();

                throw new \Exception('Create order detail failed', StatusCodeEnum::FAIL);
            }

            DB::commit();

            return [
                'oid' => $params['oid'],
                'total' => $total
            ];
        } catch (\Exception $e) {
            DB::rollback();

            $message = $e->getMessage() ?? 'Fail';
            $code = $e->getCode() ?? StatusCodeEnum::FAIL;

            throw new \Exception($message, $code);
        }
    }
}
