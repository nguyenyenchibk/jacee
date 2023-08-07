<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Student\AuthenticatedSessionController;
use App\Http\Controllers\Student\StudentController;
use App\Http\Controllers\Student\CourseController;
use App\Http\Controllers\Student\LessonController;
use App\Http\Controllers\Student\TestController;
use App\Http\Controllers\Student\DiscussionController;
use App\Http\Controllers\Student\CommentController;
use App\Http\Controllers\Student\ForgotPasswordController;

Route::prefix('student')->middleware('theme:student')->name('student.')->group(function () {
    Route::middleware(['guest:student'])->group(function () {
        Route::view('/login', 'auth.login')->name('login');
        Route::post('/login', [AuthenticatedSessionController::class, 'store']);
        Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
        Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
        Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
        Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');
    });
    Route::middleware(['auth:student'])->middleware('theme:dashboard')->group(function () {
        Route::get('/dashboard', [StudentController::class, 'index'])->name('dashboard');
        Route::post('/markasread/{notification}',[StudentController::class, 'markasread'])->name('markasread');
        Route::controller(CourseController::class)->prefix('courses')->name('course.')->group(function () {
            Route::get('/', 'getCourseOfStudent')->name('index');
            Route::get('{course}/show', 'show')->name('show');
        });
        Route::controller(LessonController::class)->prefix('courses')->name('lesson.')->group(function () {
            Route::get('{course}/lessons/{lesson}/show', 'show')->name('show');
        });
        Route::controller(TestController::class)->prefix('courses')->name('test.')->group(function () {
            Route::get('{course}/lessons/{lesson}/tests/{test}/show', 'show')->name('show');
            Route::post('{course}/lessons/{lesson}/tests/{test}', 'store')->name('store');
            Route::get('{course}/lessons/{lesson}/tests/{test}/result', 'result')->name('result');
        });
        Route::controller(DiscussionController::class)->prefix('lessons')->name('discussion.')->group(function () {
            Route::post('{course}/{lesson}/discussion', 'store')->name('store');
            Route::delete('{course}/{lesson}/discussions/{discussion}', 'destroy')->name('delete');
        });
        Route::controller(CommentController::class)->prefix('lessons')->name('comment.')->group(function () {
            Route::post('{course}/{lesson}/{discussion}/comment', 'store')->name('store');
            Route::delete('{course}/lessons/{lesson}/comments/{comment}', 'destroy')->name('delete');
        });
        Route::get('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
    });
});
