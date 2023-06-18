<?php

namespace App\Services\Interfaces;

use App\Services\Interfaces\ServiceInterface;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\Course;

interface LessonServiceInterface extends ServiceInterface
{
    public function index(Course $course);
    public function create(Course $course, FormRequest $request);
}
