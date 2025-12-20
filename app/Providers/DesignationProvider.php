<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interface\DesignationInterface; 
use App\Repositories\DesignationRepo ; 


class DesignationProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(DesignationInterface::class,DesignationRepo::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
