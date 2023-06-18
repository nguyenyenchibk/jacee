<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Services\Interfaces\CourseServiceInterface;
use Illuminate\Http\Request;
use App\Models\Course;

class CourseController extends Controller
{
    protected $courseService;

    public function __construct(CourseServiceInterface $courseService)
    {
        $this->courseService = $courseService;
    }

    public function teacherGetCourse()
    {
        $courses = $this->courseService->teacherGetCourse();
        return view('teacher.course.index', compact('courses'));
    }

    public function show(Course $course)
    {
        $lessons = $course->lessons()->get();
        return view('teacher.course.show', compact('course', 'lessons'));
    }
}
