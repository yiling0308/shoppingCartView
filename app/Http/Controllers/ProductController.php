<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\StoreRequest;
use App\Enums\StatusCodeEnum;
use App\Services\ProductService;

class ProductController extends Controller
{
    /**
     * @var ProductService
     */
    private $productService;

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * 查看所有商品
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = $this->productService->productAll();

        $username = session('username');;

        return view('index', compact('products'));
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

        $newProduct = $this->productService->newProduct($validated);

        return response()->success(
            $newProduct,
            __('messages.create_success'),
            StatusCodeEnum::CREATE_SUCCESS
        );
    }

    /**
     * 查看指定商品資訊
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = $this->productService->findProduct($id);

        return view('detail', compact('product'));
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

        $newProduct = $this->productService->updateProduct($validated);

        return response()->success(
            $newProduct,
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

        $this->productService->deleteProduct($validated);

        return response()->success(
            __('messages.delete_success'),
            StatusCodeEnum::DELETE_SUCCESS
        );
    }
}
