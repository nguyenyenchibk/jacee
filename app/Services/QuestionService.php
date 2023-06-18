<?php

namespace App\Services;

use App\Services\Service;
use App\Services\Interfaces\QuestionServiceInterface;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\Test;

class QuestionService extends Service implements QuestionServiceInterface
{
    public function index(Test $test)
    {
        $questions = Test::where('test_id', $test->id)->get();
        return $questions;
    }

    public function create(Test $test, FormRequest $request)
    {
        $input = $request->validate();
        $question = $test->questions()->create($input);
        $question->answers()->createMany($input['answers'])->push();
        return $question;
    }
}
