<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\Order\StoreRequest;
use App\Http\Requests\Order\BuyRequest;
use App\Enums\StatusCodeEnum;
use App\Services\OrderService;

class OrderController extends Controller
{
    /**
     * @var OrderService
     */
    private $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    /**
     * 下單
     *
     * @param  \App\Http\Requests\Order\ShowRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function buy(BuyRequest $request)
    {
        $validated = $request->validated();

        $result = $this->orderService->buy($validated);

        return response()->success(
            $result,
            __('messages.success'),
            StatusCodeEnum::SUCCESS
        );
    }
}
