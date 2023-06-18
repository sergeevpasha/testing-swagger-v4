<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Database\Seeders\Traits\ConsoleBarTrait;

class ProductSeeder extends Seeder
{
    use ConsoleBarTrait;

    /**
     * Total rows to seed
     *
     * @var int
     */
    protected int $total = 100;

    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run(): void
    {
        $this->seedAndOutput(Product::class);
    }
}
