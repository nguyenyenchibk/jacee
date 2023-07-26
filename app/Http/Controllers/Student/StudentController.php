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

    public function markasread($id)
    {
        if($id)
        {
            auth()->guard('student')->user()->unreadNotifications->where('id', $id)->markAsRead();
        }
        return back();
    }
}
