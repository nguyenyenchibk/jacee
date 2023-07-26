<?php

namespace App\Services;

use App\Services\Service;
use App\Services\Interfaces\CourseServiceInterface;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\Course;
use App\Notifications\AddTeacherToCourseNotification;
use App\Notifications\AddStudentToCourseNotification;
use App\Models\Teacher;
use App\Models\Student;
use App\Models\CourseStudent;
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
        $teacher = Teacher::where('id', $course->teacher_id)->first();
        $teacher->notify(new AddTeacherToCourseNotification($teacher));
        return $course;
    }

    public function update(FormRequest $request, Course $course)
    {
        $input = $request->validate();
        $teacher = Teacher::where('id', $course->teacher_id)->first();
        $course = $course->update($input);
        $teacher->notify(new AddTeacherToCourseNotification($teacher));
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
        $notices = Student::leftJoin('course_student', 'students.id', '=', 'course_student.student_id')
                            ->where('course_student.course_id', $course->id)
                            ->select('student_id as id', 'course_id' )
                            ->get();
        foreach ($notices as $notice)
        {
            $notice->notify(new AddStudentToCourseNotification($notice));
        }
        return $student;
    }

    public function getCourseOfStudent()
    {
        $courses = auth()->guard('student')->user()->courses()->get();
        return $courses;
    }

    public function getParticipants(Course $course)
    {
        $paticipants = CourseStudent::leftJoin('students', 'students.id', '=', 'course_student.student_id')
                                ->where('course_student.course_id', $course->id)
                                ->orderBy('course_student.id', 'desc')
                                ->get();
        return $paticipants;
    }
}
