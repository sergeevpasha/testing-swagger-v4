<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\CreateProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Services\Api\v1\ProductService;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    /**
     * @var \App\Services\Api\v1\ProductService
     */
    private ProductService $service;

    /**
     * Translation name
     *
     * @var string
     */
    private string $translation = 'product';

    /**
     * @param \App\Services\Api\v1\ProductService $service
     */
    public function __construct(ProductService $service)
    {
        $this->service = $service;
    }


    /**
     * Get all Products
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @api
     *
     */
    #[\OpenApi\Attributes\Get(
        path: '/api/products',
        summary: 'Get Products',
        tags: ['Products'],
        responses: [
            new \OpenApi\Attributes\Response(response: 200, description: 'Fetched products', content: new \OpenApi\Attributes\MediaType(
                mediaType: 'application/json',
                schema: new \OpenApi\Attributes\Schema(
                    properties: [
                        new \OpenApi\Attributes\Property(
                            property: 'data',
                            type: 'array',
                            items: new \OpenApi\Attributes\Items(
                                properties: [
                                    new \OpenApi\Attributes\Property(property: 'id', description: 'Product ID', type: 'number', example: 1),
                                    new \OpenApi\Attributes\Property(property: 'name', description: 'Product Name', type: 'string', example: 'Product X'),
                                    new \OpenApi\Attributes\Property(property: 'code', description: 'Product Code', type: 'string', example: 'PRD-001'),
                                    new \OpenApi\Attributes\Property(property: 'price', description: 'Product Price', type: 'number', example: 109.90),
                                ]
                            )),
                    ],
                    type: 'object',
                ),
            )),
        ]
    )]
    public function index(): JsonResponse
    {
        return $this->service->getAll()->response();
    }


    /**
     * Store Product
     *
     * @param \App\Http\Requests\Product\CreateProductRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     * @api
     *
     */
    #[\OpenApi\Attributes\Post(
        path: '/api/products',
        summary: 'Create Product',
        requestBody: new \OpenApi\Attributes\RequestBody(
            content: new \OpenApi\Attributes\MediaType(
                mediaType: 'application/json',
                schema: new \OpenApi\Attributes\Schema(
                    required: ['name', 'code', 'price'],
                    properties: [
                        new \OpenApi\Attributes\Property(property: 'name', description: 'Product Name', type: 'string', example: 'Product X'),
                        new \OpenApi\Attributes\Property(property: 'code', description: 'Product Code', type: 'string', example: 'PRD-001'),
                        new \OpenApi\Attributes\Property(property: 'price', description: 'Product Price', type: 'number', example: 109.90),
                    ],
                    type: 'object',
                ),
            )
        ),
        tags: ['Products'],
        responses: [
            new \OpenApi\Attributes\Response(response: 201, description: 'Product created', content: new \OpenApi\Attributes\MediaType(
                mediaType: 'application/json',
                schema: new \OpenApi\Attributes\Schema(
                    properties: [
                        new \OpenApi\Attributes\Property(property: 'message', type: 'string', example: 'Product was successfully created.'),
                        new \OpenApi\Attributes\Property(
                            property: 'data',
                            properties: [
                                new \OpenApi\Attributes\Property(property: 'id', description: 'Product ID', type: 'number', example: 1),
                                new \OpenApi\Attributes\Property(property: 'name', description: 'Product Name', type: 'string', example: 'Product X'),
                                new \OpenApi\Attributes\Property(property: 'code', description: 'Product Code', type: 'string', example: 'PRD-001'),
                                new \OpenApi\Attributes\Property(property: 'price', description: 'Product Price', type: 'number', example: 109.90),
                            ],
                            type: 'object'),
                    ],
                    type: 'object',
                ),
            ))
        ]
    )]
    public function store(CreateProductRequest $request): JsonResponse
    {
        $product = $this->service->create($request->validated());
        return response()->json([
            'message' => __("notification.store.$this->translation"),
            'data'    => $product
        ], 201);
    }

    /**
     * Display Product
     *
     * @param int $id
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @api
     *
     */
    #[\OpenApi\Attributes\Get(
        path: '/api/products/{id}',
        summary: 'Get Product',
        tags: ['Products'],
        parameters: [
            new \OpenApi\Attributes\Parameter(parameter: 'id', name: 'id', description: 'Product Id', in: 'path', required: true, allowEmptyValue: false, schema: new \OpenApi\Attributes\Schema(type: 'integer'), example: 1, allowReserved: true),
        ],
        responses: [
            new \OpenApi\Attributes\Response(response: 200, description: 'No Content', content: new \OpenApi\Attributes\MediaType(
                mediaType: 'application/json',
                schema: new \OpenApi\Attributes\Schema(
                    properties: [
                        new \OpenApi\Attributes\Property(
                            property: 'data',
                            properties: [
                                new \OpenApi\Attributes\Property(property: 'id', description: 'Product ID', type: 'number', example: 1),
                                new \OpenApi\Attributes\Property(property: 'name', description: 'Product Name', type: 'string', example: 'Product X'),
                                new \OpenApi\Attributes\Property(property: 'code', description: 'Product Code', type: 'string', example: 'PRD-001'),
                                new \OpenApi\Attributes\Property(property: 'price', description: 'Product Price', type: 'number', example: 109.90),
                            ],
                            type: 'object'),
                    ],
                    type: 'object',
                ),
            )),
            new \OpenApi\Attributes\Response(response: 404, description: 'Not Found', content: new \OpenApi\Attributes\JsonContent()),
        ]
    )]
    public function show(int $id): JsonResponse
    {
        return $this->service->getById($id)->response();
    }

    /**
     * Update Product
     *
     * @param \App\Http\Requests\Product\UpdateProductRequest $request
     * @param int                                             $id
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @api
     */
    #[\OpenApi\Attributes\Patch(
        path: '/api/products/{id}',
        summary: 'Update Product',
        requestBody: new \OpenApi\Attributes\RequestBody(
            content: new \OpenApi\Attributes\MediaType(
                mediaType: 'application/json',
                schema: new \OpenApi\Attributes\Schema(
                    required: ['name', 'code', 'price'],
                    properties: [
                        new \OpenApi\Attributes\Property(property: 'name', description: 'Product Name', type: 'string', example: 'Product X'),
                        new \OpenApi\Attributes\Property(property: 'code', description: 'Product Code', type: 'string', example: 'PRD-001'),
                        new \OpenApi\Attributes\Property(property: 'price', description: 'Product Price', type: 'number', example: 109.90),
                    ],
                    type: 'object',
                ),
            )
        ),
        tags: ['Products'],
        parameters: [
            new \OpenApi\Attributes\Parameter(parameter: 'id', name: 'id', description: 'Product Id', in: 'path', required: true, allowEmptyValue: false, schema: new \OpenApi\Attributes\Schema(type: 'integer'), example: 1, allowReserved: true),
        ],
        responses: [
            new \OpenApi\Attributes\Response(response: 200, description: 'Successfully updated', content: new \OpenApi\Attributes\JsonContent(
                properties: [
                    new \OpenApi\Attributes\Property(property: 'message', type: 'string', example: 'Product was successfully updated.'),
                ],
            )),
            new \OpenApi\Attributes\Response(response: 404, description: 'Not Found', content: new \OpenApi\Attributes\JsonContent(
                properties: [
                    new \OpenApi\Attributes\Property(property: 'message', type: 'string', example: 'Not Found.'),
                ],
            )),
        ]
    )]
    public function update(UpdateProductRequest $request, int $id): JsonResponse
    {
        $this->service->update($request->validated(), $id);
        return response()->json(['message' => __("notification.update.$this->translation")]);
    }

    /**
     * Delete Product
     *
     * @param int $id
     *
     * @return \Illuminate\Http\JsonResponse
     * @api
     *
     */
    #[\OpenApi\Attributes\Delete(
        path: '/api/products/{id}',
        summary: 'Delete Product',
        tags: ['Products'],
        parameters: [
            new \OpenApi\Attributes\Parameter(parameter: 'id', name: 'id', description: 'Product Id', in: 'path', required: true, allowEmptyValue: false, schema: new \OpenApi\Attributes\Schema(type: 'integer'), example: 1, allowReserved: true),
        ],
        responses: [
            new \OpenApi\Attributes\Response(response: 200, description: 'Successfully deleted', content: new \OpenApi\Attributes\JsonContent(
                properties: [
                    new \OpenApi\Attributes\Property(property: 'message', type: 'string', example: 'Product was successfully deleted.'),
                ],
            )),
            new \OpenApi\Attributes\Response(response: 404, description: 'Not Found', content: new \OpenApi\Attributes\JsonContent(
                properties: [
                    new \OpenApi\Attributes\Property(property: 'message', type: 'string', example: 'Not Found.'),
                ],
            )),
        ]
    )]
    public function destroy(int $id): JsonResponse
    {
        $this->service->destroy($id);
        return response()->json(['message' => __("notification.destroy.$this->translation")]);
    }
}
