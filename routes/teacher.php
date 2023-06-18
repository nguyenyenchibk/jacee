<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Teacher\AuthenticatedSessionController;
use App\Http\Controllers\Teacher\TeacherController;
use App\Http\Controllers\Teacher\CourseController;
use App\Http\Controllers\Teacher\LessonController;
use App\Http\Controllers\Teacher\TestController;
use App\Http\Controllers\Teacher\QuestionController;

Route::prefix('teacher')->middleware('theme:teacher')->name('teacher.')->group(function(){
    Route::middleware(['guest:teacher'])->group(function(){
        Route::view('/login','auth.login')->name('login');
        Route::post('/login', [AuthenticatedSessionController::class, 'store']);
    });
    Route::middleware(['auth:teacher'])->middleware('theme:dashboard')->group(function(){
        Route::get('/dashboard',[TeacherController::class,'index']);
        Route::controller(CourseController::class)->prefix('courses')->name('course.')->group(function () {
            Route::get('/', 'teacherGetCourse')->name('index');
            Route::get('/{course}/show', 'show')->name('show');
        });
        Route::controller(LessonController::class)->prefix('courses')->name('lesson.')->group(function () {
            Route::get('{course}/lessons/create', 'create')->name('create');
            Route::post('{course}/lessons', 'store')->name('store');
            Route::get('lessons/{lesson}/show', 'show')->name('show');
        });
        Route::controller(TestController::class)->prefix('lessons')->name('test.')->group(function () {
            Route::get('{lesson}/tests/create', 'create')->name('create');
            Route::post('{lesson}/tests', 'store')->name('store');
            Route::get('tests/{test}/show', 'show')->name('show');
        });
        Route::controller(QuestionController::class)->prefix('tests')->name('question.')->group(function () {
            // Route::get('{test}/questions/create', 'create')->name('create');
            Route::post('{test}/questions', 'store')->name('store');
            Route::get('questions/{question}/show', 'show')->name('show');
        });
        Route::get('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
    });
});


