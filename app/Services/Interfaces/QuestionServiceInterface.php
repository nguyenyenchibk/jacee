<?php

namespace App\Services\Interfaces;

use App\Services\Interfaces\ServiceInterface;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\Test;

interface QuestionServiceInterface extends ServiceInterface
{
    public function index(Test $test);
    public function create(Test $test, FormRequest $request);
}