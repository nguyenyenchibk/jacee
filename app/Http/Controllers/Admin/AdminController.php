<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Teacher;
use App\Models\Student;
use App\Models\Category;
use App\Models\Course;
class AdminController extends Controller
{
    // admin dashboard
    public function index()
    {
        $teachers = Teacher::get();
        $students = Student::get();
        $categories = Category::get();
        $courses = Course::get();
        return view('admin.dashboard', compact('teachers', 'students', 'categories', 'courses'));
    }
}
