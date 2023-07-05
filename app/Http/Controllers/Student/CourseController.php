<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Services\Interfaces\CourseServiceInterface;

class CourseController extends Controller
{
    protected $courseService;

    public function __construct(CourseServiceInterface $courseService)
    {
        $this->courseService = $courseService;
    }

    public function getCourseOfStudent()
    {
        $courses = $this->courseService->getCourseOfStudent();
        return view('student.course.index', compact('courses'));
    }

    public function show(Course $course)
    {
        $lessons = $this->courseService->getLessonOfCourse($course);
        return view('student.course.show', compact('course', 'lessons'));
    }
}
