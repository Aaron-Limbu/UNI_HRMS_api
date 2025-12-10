<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interface\UserInterface; 
use App\Repositories\UserRepo; 

class UserProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(UserInterface::class,UserRepo::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
