<?php

namespace App\Services\Interfaces;

use App\Services\Interfaces\ServiceInterface;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\Student;

interface StudentServiceInterface extends ServiceInterface
{
    public function index();
    public function create(FormRequest $request);
    public function update(FormRequest $request, Student $teacher);
    public function delete(Student $teacher);
    public function getActiveAccounts();
}
