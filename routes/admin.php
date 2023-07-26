<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthenticatedSessionController;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\AdminController;

Route::prefix('admin')->middleware('theme:admin')->name('admin.')->group(function(){
    Route::middleware(['guest:admin'])->group(function(){
        Route::view('/login','auth.login')->name('login');
        Route::post('/login', [AuthenticatedSessionController::class, 'store']);
    });
    Route::middleware(['auth:admin'])->middleware('theme:dashboard')->group(function(){
        Route::get('/dashboard',[AdminController::class,'index']);
        Route::controller(TeacherController::class)->prefix('teachers')->name('teacher.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('{teacher}/edit', 'edit')->name('edit');
            Route::put('{teacher}', 'update')->name('update');
            Route::delete('{teacher}', 'destroy')->name('delete');
            Route::post('/import', 'import')->name('import');
        });

        Route::controller(StudentController::class)->prefix('students')->name('student.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('{student}/edit', 'edit')->name('edit');
            Route::put('{student}', 'update')->name('update');
            Route::delete('{student}', 'destroy')->name('delete');
            Route::post('/import', 'import')->name('import');
        });

        Route::controller(CategoryController::class)->prefix('categories')->name('category.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('{category}/edit', 'edit')->name('edit');
            Route::put('{category}', 'update')->name('update');
            Route::delete('{category}', 'destroy')->name('delete');
        });

        Route::controller(CourseController::class)->prefix('courses')->name('course.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('{course}/edit', 'edit')->name('edit');
            Route::put('{course}', 'update')->name('update');
            Route::delete('{course}', 'destroy')->name('delete');
        });

        Route::get('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
    });
});


