<?php

declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'  => $this->faker->word,
            'code'  => $this->faker->unique()->swiftBicNumber,
            'price' => $this->faker->numberBetween(10, 10000),
        ];
    }
}
