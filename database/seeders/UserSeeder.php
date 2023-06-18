<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Database\Seeders\Traits\ConsoleBarTrait;

class UserSeeder extends Seeder
{
    use ConsoleBarTrait;

    /**
     * Total rows to seed
     *
     * @var int
     */
    protected int $total = 10;

    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run(): void
    {
        $this->seedAndOutput(User::class);
    }
}
