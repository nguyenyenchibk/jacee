<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use App\Services\Interfaces\TeacherServiceInterface;
use App\Http\Requests\Admin\Teacher\TeacherRequest;
use App\Http\Requests\Admin\Teacher\UpdateTeacherRequest;
use App\Imports\TeachersImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    protected $teacherService;
    /**
     * Display a listing of the resource.
     */
    public function __construct(TeacherServiceInterface $teacherService)
    {
        $this->teacherService = $teacherService;
    }

    public function index()
    {
        $teachers = $this->teacherService->index();
        return view('admin.teacher.index', compact('teachers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.teacher.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TeacherRequest $request)
    {
        $this->teacherService->create($request);
        return redirect()->route('admin.teacher.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Teacher $teacher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Teacher $teacher)
    {
        return view('admin.teacher.edit', compact('teacher'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTeacherRequest $request, Teacher $teacher)
    {
        $teacher = $this->teacherService->update($request, $teacher);
        return redirect()->route('admin.teacher.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Teacher $teacher)
    {
        $teacher = $this->teacherService->delete($teacher);
        return redirect()->route('admin.teacher.index');
    }

    public function import(Request $request)
    {
        Excel::import(new TeachersImport, $request->file);
        return redirect()->route('admin.teacher.index');
    }
}
