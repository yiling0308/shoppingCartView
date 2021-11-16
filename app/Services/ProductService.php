<?php

namespace App\Services;

use App\Repositories\ProductRepository;

class ProductService extends BaseService
{
    /**
     * @var ProductRepository
     */
    private $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * 查看所有商品
     *
     * @return array|null
     */
    public function productAll()
    {
        $product = $this->productRepository->getAll(['id', 'name', 'description', 'price', 'stock']);

        return $product;
    }

    /**
     * 新增商品
     *
     * @return array|null
     */
    public function newProduct($params)
    {
        $product = $this->productRepository->newProduct($params);

        return $product;
    }

    /**
     * 查詢商品
     *
     * @return array|null
     */
    public function findProduct($params)
    {
        $product = $this->productRepository->getOne(['*'], ['id' => $params]);

        return $product;
    }

    /**
     * 更新商品資訊
     *
     * @return array|null
     */
    public function updateProduct($params)
    {
        $this->productRepository->update(["stock" => $params['stock']], ['id' => $params['id']]);

        $product = $this->productRepository->getOne(['*'], ['id' => $params['id']]);

        return $product;
    }

    /**
     * 刪除商品資訊
     *
     * @return array|null
     */
    public function deleteProduct($params)
    {
        $this->productRepository->delete(['id' => $params]);

        return;
    }
}
