<?php

declare(strict_types=1);

namespace App\Providers;

use App\Models\Product;
use App\Models\User;
use App\Repository\Contracts\ProductRepositoryContract;
use App\Repository\Contracts\UserRepositoryContract;
use App\Repository\Eloquent\ProductRepository;
use App\Repository\Eloquent\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton(
            UserRepositoryContract::class,
            fn() => new UserRepository(new User())
        );
        $this->app->singleton(
            ProductRepositoryContract::class,
            fn() => new ProductRepository(new Product())
        );
    }
}
