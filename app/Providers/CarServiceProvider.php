<?php

namespace App\Providers;

use App\Models\Car;
use App\Observers\CarObserver;
use Illuminate\Support\ServiceProvider;

class CarServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Car::observe(CarObserver::class);

    }
}
