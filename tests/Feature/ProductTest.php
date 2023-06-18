<?php

declare(strict_types=1);

namespace Tests\Feature;

use Tests\TestCase;

class ProductTest extends TestCase
{
    /**
     * @return array
     */
    public static function successfulProducts(): array
    {
        return [
            [3, 'product123', 'code', 99.99],
            [4, 'product1234', 'code3', 102.33],
            [5, 'product1235', 'code4', '10'],
            [6, 'product1236', 'code5', 0],
            [7, 'product1237', 'code6', '0.10'],
        ];
    }

    /**
     * @return array
     */
    public static function failingProducts(): array
    {
        return [
            ['product123', 'code123', 99.99, 422],
            [null, '', 'string', 422],
        ];
    }

    public function testGetAllProducts(): void
    {
        $response = $this->getJson('/api/products');
        $response->assertHeader('Content-Type', 'application/json')
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'name',
                        'code',
                        'price',
                    ]
                ]
            ])->assertExactJson([
                'data' => [
                    [
                        'id'    => 1,
                        'name'  => 'product123',
                        'code'  => 'code123',
                        'price' => 99.99,
                    ],
                    [
                        'id'    => 2,
                        'name'  => 'product1234',
                        'code'  => 'code1234',
                        'price' => 999.99,
                    ]
                ]
            ]);
    }

    public function testGetProduct(): void
    {
        $response = $this->getJson('/api/products/1');
        $response->assertHeader('Content-Type', 'application/json')
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'code',
                    'price',
                ]
            ])->assertExactJson([
                'data' => [
                    'id'    => 1,
                    'name'  => 'product123',
                    'code'  => 'code123',
                    'price' => 99.99,
                ]
            ]);
    }

    /**
     * @dataProvider successfulProducts
     *
     * @param mixed $id
     * @param mixed $name
     * @param mixed $code
     * @param mixed $price
     */
    public function testCreateProductSuccessfully(mixed $id, mixed $name, mixed $code, mixed $price): void
    {
        $response = $this->postJson('/api/products', compact('name', 'code', 'price'));
        $response->assertHeader('Content-Type', 'application/json')
            ->assertStatus(201)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'code',
                    'price',
                ]
            ])->assertJsonFragment([
                'data' => [
                    'id'    => $id,
                    'name'  => $name,
                    'code'  => $code,
                    'price' => (float) $price,
                ]
            ]);
    }

    /**
     * @dataProvider failingProducts
     *
     * @param mixed $name
     * @param mixed $code
     * @param mixed $price
     * @param int   $expectedStatusCode
     */
    public function testCreateProductWithWrongValues(mixed $name, mixed $code, mixed $price, int $expectedStatusCode): void
    {
        $response = $this->postJson('/api/products', compact('name', 'code', 'price'));
        $response->assertHeader('Content-Type', 'application/json')
            ->assertStatus($expectedStatusCode)
            ->assertJsonStructure([
                'message',
                'errors'
            ]);
    }

    /**
     * @dataProvider successfulProducts
     *
     * @param mixed $id
     * @param mixed $name
     * @param mixed $code
     * @param mixed $price
     */
    public function testUpdateProductSuccessfully(mixed $id, mixed $name, mixed $code, mixed $price): void
    {
        $response = $this->patchJson('/api/products/1', compact('name', 'code', 'price'));
        $response->assertStatus(200)->assertJsonStructure([
            'message',
        ]);
    }

    /**
     * @dataProvider failingProducts
     *
     * @param mixed $name
     * @param mixed $code
     * @param mixed $price
     * @param int   $expectedStatusCode
     */
    public function testUpdateProductWithWrongValues(mixed $name, mixed $code, mixed $price, int $expectedStatusCode): void
    {
        $response = $this->patchJson('/api/products/2', compact('name', 'code', 'price'));
        $response->assertHeader('Content-Type', 'application/json')
            ->assertStatus($expectedStatusCode)
            ->assertJsonStructure([
                'message',
                'errors'
            ]);
    }

    /**
     * @dataProvider successfulProducts
     *
     * @param mixed $id
     * @param mixed $name
     * @param mixed $code
     * @param mixed $price
     */
    public function testUpdateNonExistingProduct(mixed $id, mixed $name, mixed $code, mixed $price): void
    {
        $response = $this->patchJson('/api/products/1000', compact('name', 'code', 'price'));
        $response->assertHeader('Content-Type', 'application/json')
            ->assertStatus(404)
            ->assertJsonStructure([
                'message',
            ]);
    }

    public function testDeleteProduct(): void
    {
        $response = $this->deleteJson('/api/products/1');
        $response->assertHeader('Content-Type', 'application/json')
            ->assertStatus(200)
            ->assertJsonStructure([
                'message',
            ]);
    }

    public function testDeleteNonExistingProduct(): void
    {
        $response = $this->deleteJson('/api/products/1000');
        $response->assertHeader('Content-Type', 'application/json')
            ->assertStatus(404)
            ->assertJsonStructure([
                'message',
            ]);
    }
}
