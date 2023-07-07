<?php

namespace App\Services;

use App\Services\Service;
use App\Services\Interfaces\CourseServiceInterface;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\Course;

class CourseService extends Service implements CourseServiceInterface
{
    public function index()
    {
        $courses = Course::all();
        return $courses;
    }

    public function create(FormRequest $request)
    {
        $input = $request->validate();
        $course = auth()->guard('admin')->user()->courses()->create($input);
        return $course;
    }

    public function update(FormRequest $request, Course $course)
    {
        $input = $request->validate();
        $course = $course->update($input);
        return $course;
    }

    public function delete(Course $course)
    {
        $course->delete($course);
        return true;
    }

    public function teacherGetCourse()
    {
        $courses = Course::where('teacher_id', auth()->guard('teacher')->user()->id)->get();
        return $courses;
    }

    public function getLessonOfCourse(Course $course)
    {
        $lessons = $course->lessons()->get();
        return $lessons;
    }

    public function addStudents(FormRequest $request, Course $course)
    {
        $student = $course->students()->sync($request['student_id']);
        return $student;
    }

    public function getCourseOfStudent()
    {
        $courses = auth()->guard('student')->user()->courses()->get();
        return $courses;
    }
}
