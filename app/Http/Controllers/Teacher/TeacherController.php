<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;

class TeacherController extends Controller
{
    //
    public function index()
    {
        return view('teacher.dashboard');
    }
}
