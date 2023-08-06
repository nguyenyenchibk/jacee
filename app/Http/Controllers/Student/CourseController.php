<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Services\Interfaces\CourseServiceInterface;
use App\Services\Interfaces\CategoryServiceInterface;

class CourseController extends Controller
{
    protected $courseService;
    protected $categoryService;

    public function __construct(CourseServiceInterface $courseService, CategoryServiceInterface $categoryService)
    {
        $this->courseService = $courseService;
        $this->categoryService = $categoryService;
    }

    public function getCourseOfStudent(Request $request)
    {
        $courses = $this->courseService->getCourseOfStudent($request);
        $categories = $this->categoryService->getActiveCate();
        return view('student.course.index', compact('courses', 'categories'));
    }

    public function show(Course $course)
    {
        $lessons = $this->courseService->getLessonOfCourse($course);
        return view('student.course.show', compact('course', 'lessons'));
    }
}
