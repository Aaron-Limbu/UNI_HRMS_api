<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interface\StudentInterface;
use App\Repositories\StudentRepo;

class StudentProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(StudentInterface::class,StudentRepo::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
