<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Test;
use App\Models\StudentTest;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $notifications = auth()->guard('student')->user()->unreadNotifications;
        $courses = Course::leftJoin('course_student', 'courses.id' , '=' , 'course_student.course_id')
                            ->where('course_student.student_id', '=', auth()->guard('student')->user()->id)
                            ->where('status', '=', 1)
                            ->select('course_id as id', 'code', 'name')
                            ->get();
        $labels = [];
        $averages = [];
        if($request['course_id'])
        {
            $tests = Test::leftJoin('student_test', 'tests.id', '=', 'student_test.test_id')
                        ->where('student_test.student_id', auth()->guard('student')->user()->id)
                        ->leftJoin('lessons', 'lessons.id', '=', 'tests.lesson_id')
                        ->where('lessons.course_id', $request['course_id'])
                        ->where('student_test.deleted_at', NULL)
                        ->orderBy('student_test.created_at', 'asc')
                        ->pluck('tests.name', 'tests.id');
            foreach($tests as $key=>$value)
            {
                $labels[] = $value;
                $averages[] = StudentTest::where('student_id', auth()->guard('student')->user()->id)
                                        ->where('test_id', $key)->pluck('average')->first();
            }
        }
        return view('student.dashboard', compact('notifications', 'courses'))
                ->with('averages', json_encode($averages, JSON_NUMERIC_CHECK))->with('labels', json_encode($labels));
    }

    public function markasread($id)
    {
        if($id)
        {
            auth()->guard('student')->user()->unreadNotifications->where('id', $id)->markAsRead();
        }
        return back();
    }
}
