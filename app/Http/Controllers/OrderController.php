<?php

namespace App\Http\Controllers;

use App\Http\Requests\Order\BuyRequest;
use App\Http\Requests\Order\findOrderRequest;
use App\Http\Requests\Order\AddToCartRequest;
use App\Http\Requests\Order\DelFromCartRequest;
use App\Enums\StatusCodeEnum;
use App\Services\OrderService;
use Illuminate\Support\Facades\Log;
use Session;

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
     * 加到購物車
     *
     * @return \Illuminate\Http\Response
     */
    public function addToCart(AddToCartRequest $request)
    {
        $validated = $request->validated();

        $total = 0;
        $cart = Session::get('cart');
        $cart[$validated['pid']] = [
            'pid' => $validated['pid'],
            'name' => $validated['name'],
            'quantity' => $validated['quantity'],
            'price' => $validated['price'] * $validated['quantity']
        ];

        foreach ($cart as $res) {
            $total = $total + $res['price'];
        };

        Session::put('cart', $cart);
        Session::put('total', $total);

        return redirect()->back();
    }

    /**
     * 從購物車中刪除
     *
     * @return \Illuminate\Http\Response
     */
    public function delFromCart(DelFromCartRequest $request)
    {
        $validated = $request->validated();

        $total = 0;
        $cart = Session::get('cart');

        unset($cart[$validated['pid']]);

        foreach ($cart as $res) {
            $total = $total + $res['price'];
        };

        Session::put('cart', $cart);
        Session::put('total', $total);

        return redirect()->back();
    }

    /**
     * 下單
     *
     * @return \Illuminate\Http\Response
     */
    public function order(BuyRequest $request)
    {
        $validated = $request->validated();

        try {
            $this->orderService->buy($validated);
        } catch (\Exception $e) {
            Log::error('Order failed, Error: ' . json_encode([
                'errorMessage' => $e->getMessage(),
                'errorCode' => $e->getCode()
            ]));

            return back()->withErrors([
                'errors' => 'Order faild',
            ]);
        }

        return redirect('/');
    }

    /**
     * 查詢使者者所有訂單
     *
     * @return \Illuminate\Http\Response
     */
    public function findUserOrder()
    {
        $uid = auth()->id();
        $result = $this->orderService->findUserOrder($uid);

        return response()->success(
            $result,
            __('messages.success'),
            StatusCodeEnum::SUCCESS
        );
    }

    /**
     * 查詢訂單明細
     *
     * @param  \App\Http\Requests\Order\findOrderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function findOrder(findOrderRequest $request)
    {
        $validated = $request->validated();

        $result = $this->orderService->findOrder($validated);

        return response()->success(
            $result,
            __('messages.success'),
            StatusCodeEnum::SUCCESS
        );
    }
}
