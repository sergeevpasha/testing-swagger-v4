<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Artisan;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        $testEnv = app()->runningUnitTests();
        Model::unguard();
        if (!$testEnv) {
            if ($this->command->confirm('Clear DB before seeding?')) {
                $this->cleanUp();
            }
            if ($this->command->confirm('Seed Dummy data?')) {
                $this->command->info("Ok, dummy data will be seeded now...");
                $this->seedDummyData();
            }
        } else {
            $this->call(TestDataSeeder::class);
        }
        Model::reguard();
        Artisan::call('cache:clear');
    }

    /**
     * Clear database.
     *
     * @return void
     */
    private function cleanUp(): void
    {
        $this->command->call('migrate:fresh');
        $this->command->info("Database cleared.");
    }

    /**
     * Seed Dummy Data.
     *
     * @return void
     */
    private function seedDummyData(): void
    {
        $this->call(UserSeeder::class);
        $this->call(ProductSeeder::class);
    }
}
