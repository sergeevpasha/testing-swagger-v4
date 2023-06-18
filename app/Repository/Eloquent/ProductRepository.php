<?php

declare(strict_types=1);

namespace App\Repository\Eloquent;

use App\Models\ModelInterface;
use App\Models\Product;
use App\Repository\Contracts\ProductRepositoryContract;

class ProductRepository extends BaseRepository implements ProductRepositoryContract
{
    private ModelInterface $product;

    /**
     * @param \App\Models\Product $model
     */
    public function __construct(Product $model)
    {
        $this->setModel($model);
    }

    public function setModel(ModelInterface $model): void
    {
        $this->product = $model;
    }

    public function getModel(): ModelInterface
    {
        return $this->product;
    }
}
