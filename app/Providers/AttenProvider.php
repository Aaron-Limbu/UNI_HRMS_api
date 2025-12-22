<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interface\AttenInterface;
use App\Repositories\AttenRepo;

class AttenProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(AttenInterface::class,AttenRepo::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
