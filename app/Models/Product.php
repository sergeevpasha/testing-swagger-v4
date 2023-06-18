<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model implements ModelInterface
{
    use HasFactory;

    /**
     * Turns on/off default laravel timestamps
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * An array of attributes that are not allowed for a mass assignment
     *
     * @var array<string>
     */
    protected $guarded = [];

    protected $casts = [
        'price' => \App\Casts\Price::class,
    ];
}
