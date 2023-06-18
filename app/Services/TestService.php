<?php

namespace App\Services;

use App\Services\Service;
use App\Services\Interfaces\TestServiceInterface;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\Lesson;

class TestService extends Service implements TestServiceInterface
{
    public function create(Lesson $lesson, FormRequest $request)
    {
        $input = $request->validate();
        $test = $lesson->tests()->create($input);
        return $test;
    }
}
