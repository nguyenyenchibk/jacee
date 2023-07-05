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
use App\Services\Interfaces\LessonServiceInterface;
use App\Services\LessonService;
use App\Services\Interfaces\TestServiceInterface;
use App\Services\TestService;
use App\Services\Interfaces\QuestionServiceInterface;
use App\Services\QuestionService;
use App\Services\Interfaces\FileServiceInterface;
use App\Services\FileService;
use App\Services\Interfaces\DiscussionServiceInterface;
use App\Services\DiscussionService;
use App\Services\Interfaces\CommentServiceInterface;
use App\Services\CommentService;
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
        $this->app->bind(
            LessonServiceInterface::class,
            LessonService::class
        );
        $this->app->bind(
            TestServiceInterface::class,
            TestService::class
        );
        $this->app->bind(
            QuestionServiceInterface::class,
            QuestionService::class
        );
        $this->app->bind(
            FileServiceInterface::class,
            FileService::class
        );
        $this->app->bind(
            DiscussionServiceInterface::class,
            DiscussionService::class
        );
        $this->app->bind(
            CommentServiceInterface::class,
            CommentService::class
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
