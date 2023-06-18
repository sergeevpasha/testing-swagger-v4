<?php

declare(strict_types=1);

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;

class Price implements CastsAttributes
{
    /**
     * Transform the attribute from the underlying model values.
     *
     * @param \Illuminate\Database\Eloquent\Model $model
     * @param string                              $key
     * @param mixed                               $value
     * @param array<string, mixed>                $attributes
     *
     * @return float|null
     */
    public function get(Model $model, string $key, mixed $value, array $attributes): ?float
    {
        $result = intval($value) / 100;
        return floatval($result);
    }

    /**
     * Transform the attribute to its underlying model values.
     *
     * @param \Illuminate\Database\Eloquent\Model $model
     * @param string                              $key
     * @param float|int|null                      $value
     * @param array<string, mixed>                $attributes
     *
     * @return int|null
     */
    public function set(Model $model, string $key, mixed $value, array $attributes): ?int
    {
        return intval((float) $value * 100);
    }
}
