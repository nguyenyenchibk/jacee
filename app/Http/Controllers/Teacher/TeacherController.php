<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Student;
use App\Models\StudentTest;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TeacherController extends Controller
{
    //
    public function index(Request $request)
    {
        $total_student = Student::leftJoin('course_student', 'students.id', '=', 'course_student.student_id')
            ->leftJoin('courses', 'course_student.course_id', '=', 'courses.id')
            ->where('courses.teacher_id', '=', auth()->guard('teacher')->user()->id)
            ->where('students.status', '=', 1)
            ->count();
        $total_course = Course::where('teacher_id', '=', auth()->guard('teacher')->user()->id)->where('status', '=', 1)->count();
        $courses = Course::where('teacher_id', '=', auth()->guard('teacher')->user()->id)->where('status', '=', 1)->get();
        $now = Carbon::now();
        $labels = ['0-9', '10-19', '20-29', '30-39', '40-49', '50-59', '60-69', '70-79', '80-89', '90-99', '100'];
        $averages = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
        if ($request['course_id'] && $request['time']) {
            $date = Carbon::parse($request['time'])->format('Y-m-d');
            $dates = explode('-', $date);
            $year = $dates[0];
            $month = $dates[1];
            $students = StudentTest::leftJoin('tests', 'student_test.test_id', '=', 'tests.id')
                ->leftJoin('lessons', 'tests.lesson_id', '=', 'lessons.id')
                ->where('lessons.course_id', '=', $request['course_id'])
                ->whereMonth('student_test.created_at', $month)
                ->whereYear('student_test.created_at', $year)
                ->pluck('average');
            foreach ($students as $key => $value) {
                if ($value >= 0 && $value < 10) {
                    $averages[0]++;
                } elseif ($value >= 10 && $value < 20) {
                    $averages[1]++;
                } elseif ($value >= 20 && $value < 30) {
                    $averages[2]++;
                } elseif ($value >= 30 && $value < 40) {
                    $averages[3]++;
                } elseif ($value >= 40 && $value < 50) {
                    $averages[4]++;
                } elseif ($value >= 50 && $value < 60) {
                    $averages[5]++;
                } elseif ($value >= 60 && $value < 70) {
                    $averages[6]++;
                } elseif ($value >= 70 && $value < 80) {
                    $averages[7]++;
                } elseif ($value >= 80 && $value < 90) {
                    $averages[8]++;
                } elseif ($value >= 90 && $value < 100) {
                    $averages[9]++;
                } elseif ($value == 100) {
                    $averages[10]++;
                }
            }
        }
        $notifications = auth()->guard('teacher')->user()->unreadNotifications;
        return view('teacher.dashboard', compact('total_student', 'total_course', 'courses', 'now', 'notifications'))
            ->with('averages', json_encode($averages, JSON_NUMERIC_CHECK))->with('labels', json_encode($labels));
    }

    public function markasread($id)
    {
        if ($id) {
            auth()->guard('teacher')->user()->unreadNotifications->where('id', $id)->markAsRead();
        }
        return back();
    }
}
