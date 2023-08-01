<?php

namespace App\Providers;

use App\Repositories\{SupportEloquentORM};
use App\Repositories\{SupportRepositoryInterface};
use Illuminate\Support\ServiceProvider;
// use Laravel\Telescope\TelescopeServiceProvider;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            SupportRepositoryInterface::class,
            SupportEloquentORM::class
        );

        //  if ($this->app->environment('local')) {
        //      $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
        //      $this->app->register(TelescopeServiceProvider::class);
        //  }
    }

    /**
     * Bootstrap any application services.
     */
    // public function boot(): void
    // {
    //     //
    // }
}
