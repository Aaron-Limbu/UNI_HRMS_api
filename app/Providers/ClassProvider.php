<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interface\ClassInterface; 
use App\Repositories\ClassRepo;
class ClassProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(ClassInterface::class,ClassRepo::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
