<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Services\Interfaces\CourseServiceInterface;
use App\Models\Course;
use App\Http\Requests\Teacher\Course\AddStudentRequest;

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
        $lessons = $this->courseService->getLessonOfCourse($course);
        return view('teacher.course.show', compact('course', 'lessons'));
    }

    public function addStudents(Course $course)
    {
        return view('teacher.course.show', compact('course'));
    }

    public function storeStudents(Course $course, AddStudentRequest $request)
    {
        $this->courseService->addStudents($request, $course);
        return redirect()->route('teacher.course.show', compact('course'));
    }
}
