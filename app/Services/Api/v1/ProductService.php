<?php

declare(strict_types=1);

namespace App\Services\Api\v1;

use App\Http\Resources\Api\v1\Collections\ProductResourceCollection;
use App\Http\Resources\Api\v1\ProductResource;
use App\Repository\Contracts\ProductRepositoryContract;

class ProductService
{
    /**
     * @var \App\Repository\Contracts\ProductRepositoryContract
     */
    private ProductRepositoryContract $repository;

    /**
     * @param \App\Repository\Contracts\ProductRepositoryContract $repository
     */
    public function __construct(ProductRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Get all products
     *
     * @return \App\Http\Resources\Api\v1\Collections\ProductResourceCollection
     */
    public function getAll(): ProductResourceCollection
    {
        return new ProductResourceCollection($this->repository->getAll());
    }

    /**
     * Find Product by ID
     *
     * @param int $id
     *
     * @return \App\Http\Resources\Api\v1\ProductResource
     */
    public function getById(int $id): ProductResource
    {
        return new ProductResource($this->repository->find($id));
    }

    /**
     * Create Product
     *
     * @param array $product
     *
     * @return \App\Http\Resources\Api\v1\ProductResource
     */
    public function create(array $product): ProductResource
    {
        return new ProductResource($this->repository->create($product));
    }

    /**
     * Update Product
     *
     * @param array $product
     * @param int   $id
     *
     * @return void
     */
    public function update(array $product, int $id): void
    {
        $this->repository->update($id, $product);
    }

    /**
     * Delete Product
     *
     * @param int $id
     *
     * @return void
     */
    public function destroy(int $id): void
    {
        $this->repository->delete($id);
    }
}
