<?php

namespace App\Services;

use App\Services\Service;
use App\Services\Interfaces\LessonServiceInterface;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\Lesson;
use App\Models\Course;

class LessonService extends Service implements LessonServiceInterface
{
    public function index(Course $course)
    {
        $lessons = Lesson::where('course_id', $course->id)->get();
        return $lessons;
    }

    public function create(Course $course, FormRequest $request)
    {
        $input = $request->validate();
        $lesson = $course->lessons()->create($input);
        return $lesson;
    }
}
