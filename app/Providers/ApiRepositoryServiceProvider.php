<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repository\Admin\Auth\AuthAdminRepository;
use App\Interface\Admin\Auth\AuthAdminInterface;
use App\Repository\Admin\Tables\TableRepository;
use App\Interface\Admin\Tables\TableInterface;

class ApiRepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(AuthAdminInterface::class, AuthAdminRepository::class);
        $this->app->bind(TableInterface::class, TableRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
