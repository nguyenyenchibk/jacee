<?php

namespace App\Services;

use App\Services\Service;
use App\Services\Interfaces\StudentServiceInterface;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\Student;

class StudentService extends Service implements StudentServiceInterface
{
    public function index()
    {
        $students = Student::all();
        return $students;
    }

    public function create(FormRequest $request)
    {
        $input = $request->validate();
        $student = auth()->guard('admin')->user()->students()->create($input);
        return $student;
    }

    public function update(FormRequest $request, Student $student)
    {
        $input = $request->validate();
        $student = $student->update($input);
        return $student;
    }

    public function delete(Student $student)
    {
        $student->delete($student);
        return true;
    }

    public function getActiveAccounts()
    {
        $students = Student::where('status', 1)->get();
        return $students;
    }
}
