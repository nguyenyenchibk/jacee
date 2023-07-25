<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;

class StudentController extends Controller
{
    public function index()
    {
        $notifications = auth()->guard('student')->user()->unreadNotifications;
        return view('student.dashboard', compact('notifications'));
    }
}
