<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    // admin dashboard
    public function index()
    {
        return view('admin.dashboard');
    }
}
