<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Services\Interfaces\CourseServiceInterface;
use App\Http\Requests\Admin\Course\CourseRequest;
use App\Http\Requests\Admin\Course\UpdateCourseRequest;
use App\Services\Interfaces\TeacherServiceInterface;
use App\Services\Interfaces\CategoryServiceInterface;
use Illuminate\Http\Request;
class CourseController extends Controller
{
    protected $courseService;
    protected $teacherService;
    protected $categoryService;
    /**
     * Display a listing of the resourc
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(CourseServiceInterface $courseService, TeacherServiceInterface $teacherService, CategoryServiceInterface $categoryService)
    {
        $this->courseService = $courseService;
        $this->teacherService = $teacherService;
        $this->categoryService = $categoryService;
    }

    public function index(Request $request)
    {
        $courses = $this->courseService->index($request);
        $categories = $this->categoryService->getActiveCate();
        return view('admin.course.index', compact('courses', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $teachers = $this->teacherService->getActiveAcc();
        $categories = $this->categoryService->getActiveCate();
        return view('admin.course.create', compact('teachers', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CourseRequest $request)
    {
        $this->courseService->create($request);
        return redirect()->route('admin.course.index')->with('success', 'Course Created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        $teachers = $this->teacherService->getActiveAcc();
        $categories = $this->categoryService->getActiveCate();
        return view('admin.course.edit', compact('course', 'teachers', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCourseRequest $request, Course $course)
    {
        $course = $this->courseService->update($request, $course);
        return redirect()->route('admin.course.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    // public function destroy(Course $course)
    // {
    //     $course = $this->courseService->delete($course);
    //     return redirect()->route('admin.course.index');
    // }
}
