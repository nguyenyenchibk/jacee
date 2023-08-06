<?php

namespace App\Services\Interfaces;

use App\Services\Interfaces\ServiceInterface;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\Course;
use Illuminate\Http\Request;

interface CourseServiceInterface extends ServiceInterface
{
    public function index(Request $request);
    public function create(FormRequest $request);
    public function update(FormRequest $request, Course $course);
    public function delete(Course $course);
    public function teacherGetCourse(Request $request);
    public function getLessonOfCourse(Course $course);
    public function addStudents(FormRequest $request, Course $course);
    public function getCourseOfStudent(Request $request);
    public function getParticipants(Course $course);
}
