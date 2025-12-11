<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interface\EmpInterface;
use App\Repositories\EmpRepo;

class EmpProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(EmpInterface::class,EmpRepo::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
