<?php

declare(strict_types=1);

namespace App\Http\Resources\Api\v1\Collections;

use App\Http\Resources\Api\v1\ProductResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductResourceCollection extends ResourceCollection
{
    /**
     * The resource that this resource collects.
     *
     * @var string
     */
    public $collects = ProductResource::class;
}
