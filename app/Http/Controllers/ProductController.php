<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\Product\StoreRequest;
use App\Http\Requests\Product\ShowRequest;
use App\Enums\StatusCodeEnum;

class ProductController extends Controller
{
    /**
     * 查看所有商品
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();

        return response()->success(
            $products,
            __('messages.success'),
            StatusCodeEnum::SUCCESS
        );
    }

    /**
     * 新增商品
     *
     * @param  \App\Http\Requests\Product\StoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $validated = $request->validated();

        $products = new Product($validated);

        $products->save();

        return response()->success(
            __('messages.create_success'),
            StatusCodeEnum::CREATE_SUCCESS
        );
    }

    /**
     * 查看指定商品資訊
     *
     * @param  \App\Http\Requests\Product\ShowRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function show(ShowRequest $request)
    {
        $validated = $request->validated();

        $products = Product::find($validated['id']);

        return response()->success(
            $products,
            __('messages.success'),
            StatusCodeEnum::SUCCESS
        );
    }

    /**
     * 更新商品資訊
     *
     * @param  \App\Http\Requests\Product\ShowRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update(ShowRequest $request)
    {
        $validated = $request->all();

        $products = Product::find($validated['id']);

        $products->update($validated);

        $products->save();

        return response()->success(
            $products,
            __('messages.update_success'),
            StatusCodeEnum::UPDATE_SUCCESS
        );
    }

    /**
     * 刪除商品資訊
     *
     * @param  \App\Http\Requests\Product\ShowRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(ShowRequest $request)
    {
        $validated = $request->validated();

        $products = Product::find($validated['id']);

        $products->delete();

        return response()->success(
            __('messages.delete_success'),
            StatusCodeEnum::DELETE_SUCCESS
        );
    }
}
