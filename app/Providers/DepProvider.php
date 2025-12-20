<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interface\DepartmentInterface;
use App\Repositories\DepartmentRepo;


class DepProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(DepartmentInterface::class,DepartmentRepo::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
