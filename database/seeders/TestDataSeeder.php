<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TestDataSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run(): void
    {
        User::create(
            [
                'email'      => 'test@test.com',
                'password'   => Hash::make('password123'),
                'name'       => 'Test User',
                'created_at' => '2023-01-01 00:00:00',
            ]
        );

        Product::create(
            [
                'name'  => 'product123',
                'code'  => 'code123',
                'price' => 99.99,
            ]
        );

        Product::create(
            [
                'name'  => 'product1234',
                'code'  => 'code1234',
                'price' => 999.99,
            ]
        );
    }
}
