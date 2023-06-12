<?php

namespace App\Providers;

use App\Services\Interfaces\TeacherServiceInterface;
use App\Services\TeacherService;
use App\Services\Interfaces\StudentServiceInterface;
use App\Services\StudentService;
use App\Services\Interfaces\CategoryServiceInterface;
use App\Services\CategoryService;
use App\Services\Interfaces\CourseServiceInterface;
use App\Services\CourseService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            TeacherServiceInterface::class,
            TeacherService::class
        );
        $this->app->bind(
            StudentServiceInterface::class,
            StudentService::class
        );
        $this->app->bind(
            CategoryServiceInterface::class,
            CategoryService::class
        );
        $this->app->bind(
            CourseServiceInterface::class,
            CourseService::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
