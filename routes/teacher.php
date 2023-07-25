<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Teacher\AuthenticatedSessionController;
use App\Http\Controllers\Teacher\TeacherController;
use App\Http\Controllers\Teacher\CourseController;
use App\Http\Controllers\Teacher\LessonController;
use App\Http\Controllers\Teacher\TestController;
use App\Http\Controllers\Teacher\QuestionController;
use App\Http\Controllers\Teacher\FileController;
use App\Http\Controllers\Teacher\DiscussionController;
use App\Http\Controllers\Teacher\CommentController;
use App\Http\Controllers\Teacher\ChartController;
use App\Http\Controllers\Teacher\ForgotPasswordController;

Route::prefix('teacher')->middleware('theme:teacher')->name('teacher.')->group(function(){
    Route::middleware(['guest:teacher'])->group(function(){
        Route::view('/login','auth.login')->name('login');
        Route::post('/login', [AuthenticatedSessionController::class, 'store']);
        Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
        Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
        Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
        Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');
    });
    Route::middleware(['auth:teacher'])->middleware('theme:dashboard')->group(function(){
        Route::get('/dashboard',[TeacherController::class,'index'])->name('dashboard');
        Route::post('/markasread/{notification}',[TeacherController::class, 'markasread'])->name('markasread');
        Route::controller(CourseController::class)->prefix('courses')->name('course.')->group(function () {
            Route::get('/', 'teacherGetCourse')->name('index');
            Route::get('{course}/show', 'show')->name('show');
            Route::get('{course}/participants', 'participants')->name('participants');
            Route::post('{course}/storeStudents', 'storeStudents')->name('storeStudents');
        });
        Route::controller(LessonController::class)->prefix('courses')->name('lesson.')->group(function () {
            Route::get('{course}/lessons/create', 'create')->name('create');
            Route::post('{course}/lessons', 'store')->name('store');
            Route::get('{course}/lessons/{lesson}/show', 'show')->name('show');
        });
        Route::controller(TestController::class)->prefix('lessons')->name('test.')->group(function () {
            Route::get('{course}/{lesson}/tests/create', 'create')->name('create');
            Route::post('{course}/{lesson}/tests', 'store')->name('store');
            Route::get('tests/{test}/show', 'show')->name('show');
        });
        Route::controller(FileController::class)->prefix('lessons')->name('file.')->group(function () {
            Route::post('{course}/{lesson}/file', 'store')->name('store');
            Route::post('{course}/{lesson}/uploadVideo', 'uploadVideo')->name('uploadVideo');
        });
        Route::controller(DiscussionController::class)->prefix('lessons')->name('discussion.')->group(function () {
            Route::post('{course}/{lesson}/discussion', 'store')->name('store');
        });
        Route::controller(CommentController::class)->prefix('lessons')->name('comment.')->group(function () {
            Route::post('{course}/{lesson}/{discussion}/comment', 'store')->name('store');
        });
        Route::controller(QuestionController::class)->prefix('tests')->name('question.')->group(function () {
            Route::post('{test}/questions', 'store')->name('store');
            Route::get('questions/{question}/show', 'show')->name('show');
        });
        Route::get('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
    });
});


