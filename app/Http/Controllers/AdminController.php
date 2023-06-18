<?php

namespace App\Http\Controllers;
class AdminController extends Controller
{
    // admin dashboard
    public function index()
    {
        return view('admin.dashboard');
    }
}
