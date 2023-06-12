<?php

namespace App\Services;

use App\Services\Service;
use App\Models\Teacher;
use App\Services\Interfaces\TeacherServiceInterface;
use Illuminate\Foundation\Http\FormRequest;

class TeacherService extends Service implements TeacherServiceInterface
{
    public function index()
    {
        $teachers = Teacher::all();
        return $teachers;
    }

    public function create(FormRequest $request)
    {
        $input = $request->validate();
        $teacher = auth()->guard('admin')->user()->teachers()->create($input);
        return $teacher;
    }

    public function update(FormRequest $request, Teacher $teacher)
    {
        $input = $request->validate();
        $teacher = $teacher->update($input);
        return $teacher;
    }

    public function delete(Teacher $teacher)
    {
        $teacher->delete($teacher);
        return true;
    }

    public function getActiveAcc()
    {
        $teachers = Teacher::where('status', 1)->get();
        return $teachers;
    }
}
