<?php

declare(strict_types=1);

namespace Database\Seeders\Traits;

trait ConsoleBarTrait
{
    /**
     * Seeds and outputs progress
     *
     * @param string $model
     *
     * @return void
     */
    protected function seedAndOutput(string $model): void
    {
        $this->command->getOutput()->progressStart($this->total);
        for ($i = 0; $i < $this->total; $i++) {
            /* @var \Illuminate\Database\Eloquent\Factories\HasFactory $model */
            $model::factory()->create();
            $this->command->getOutput()->progressAdvance();
        }
        $this->command->getOutput()->progressFinish();
    }
}
