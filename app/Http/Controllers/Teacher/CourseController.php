<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Services\Interfaces\CourseServiceInterface;
use App\Services\Interfaces\StudentServiceInterface;
use App\Services\Interfaces\CategoryServiceInterface;
use App\Models\Course;
use App\Http\Requests\Teacher\Course\AddStudentRequest;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    protected $courseService;
    protected $studentService;
    protected $categoryService;

    public function __construct(CourseServiceInterface $courseService, StudentServiceInterface $studentService, CategoryServiceInterface $categoryService)
    {
        $this->courseService = $courseService;
        $this->studentService = $studentService;
        $this->categoryService = $categoryService;
    }

    public function teacherGetCourse(Request $request)
    {
        $courses = $this->courseService->teacherGetCourse($request);
        $categories = $this->categoryService->getActiveCate();
        return view('teacher.course.index', compact('courses', 'categories'));
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
        return redirect()->route('teacher.course.participants', compact('course'))->with('success', 'Add Student to course successfully.');
    }

    public function participants(Course $course)
    {
        $participants = $this->courseService->getParticipants($course);
        $students = $this->studentService->getActiveAccounts();
        return view('teacher.course.participants', compact('participants', 'course', 'students'));
    }
}
