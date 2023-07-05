<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Student\AuthenticatedSessionController;
use App\Http\Controllers\Student\StudentController;
use App\Http\Controllers\Student\CourseController;
use App\Http\Controllers\Student\LessonController;
use App\Http\Controllers\Student\TestController;
use App\Http\Controllers\Student\DiscussionController;
use App\Http\Controllers\Student\CommentController;

Route::prefix('student')->middleware('theme:student')->name('student.')->group(function(){
    Route::middleware(['guest:student'])->group(function(){
        Route::view('/login','auth.login')->name('login');
        Route::post('/login', [AuthenticatedSessionController::class, 'store']);
    });
    Route::middleware(['auth:student'])->middleware('theme:dashboard')->group(function(){
        Route::get('/dashboard',[StudentController::class,'index']);
        Route::controller(CourseController::class)->prefix('courses')->name('course.')->group(function () {
            Route::get('/', 'getCourseOfStudent')->name('index');
            Route::get('{course}/show', 'show')->name('show');
        });
        Route::controller(LessonController::class)->prefix('courses')->name('lesson.')->group(function () {
            Route::get('{course}/lessons/{lesson}/show', 'show')->name('show');
        });
        Route::controller(TestController::class)->prefix('lessons')->name('test.')->group(function () {
            Route::get('tests/{test}/show', 'show')->name('show');
            Route::post('tests/{test}', 'store')->name('store');
            Route::get('tests/{test}/result', 'result')->name('result');
        });
        Route::controller(DiscussionController::class)->prefix('lessons')->name('discussion.')->group(function () {
            Route::post('{course}/{lesson}/discussion', 'store')->name('store');
        });
        Route::controller(CommentController::class)->prefix('lessons')->name('comment.')->group(function () {
            Route::post('{course}/{lesson}/{discussion}/comment', 'store')->name('store');
        });
        Route::get('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
    });
});


