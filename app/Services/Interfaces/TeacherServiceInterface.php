<?php

namespace App\Services\Interfaces;

use App\Services\Interfaces\ServiceInterface;
use Illuminate\Foundation\Http\FormRequest;
use app\Models\Teacher;

interface TeacherServiceInterface extends ServiceInterface
{
    public function index();
    public function create(FormRequest $request);
    public function update(FormRequest $request, Teacher $teacher);
    public function delete(Teacher $teacher);
    public function getActiveAcc();
}
