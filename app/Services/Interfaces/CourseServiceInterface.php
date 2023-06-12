<?php

namespace App\Services\Interfaces;

use App\Services\Interfaces\ServiceInterface;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\Course;

interface CourseServiceInterface extends ServiceInterface
{
    public function index();
    public function create(FormRequest $request);
    public function update(FormRequest $request, Course $course);
    public function delete(Course $course);
}