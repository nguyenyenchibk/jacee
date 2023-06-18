<?php

namespace App\Services\Interfaces;

use App\Services\Interfaces\ServiceInterface;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\Lesson;

interface TestServiceInterface extends ServiceInterface
{
    public function create(Lesson $lesson, FormRequest $request);
}
