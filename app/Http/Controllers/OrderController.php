<?php

namespace App\Http\Controllers;

use App\Http\Requests\Order\BuyRequest;
use App\Enums\StatusCodeEnum;
use App\Services\OrderService;
use Illuminate\Support\Facades\Log;

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

        try {
            $result = $this->orderService->buy($validated);
        } catch (\Exception $e) {
            $code = $e->getCode();
            Log::error('Order failed, Error: ' . json_encode([
                'errorMessage' => $e->getMessage(),
                'errorCode' => $e->getCode()
            ]));

            return response()->fail(
                $code,
                __('messages.fail'),
                StatusCodeEnum::FAIL
            );
        }

        return response()->success(
            $result,
            __('messages.success'),
            StatusCodeEnum::SUCCESS
        );
    }
}
