<?php

namespace App\Services;

use App\Services\Service;
use App\Services\Interfaces\QuestionServiceInterface;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\Test;
use App\Models\Question;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class QuestionService extends Service implements QuestionServiceInterface
{
    public function index(Test $test)
    {
        $questions = Question::where('test_id', $test->id)->get();
        return $questions;
    }

    public function create(Test $test, Request $request)
    {
        $input = $request->validate();
        $question = $test->questions()->create($input);
        if($request['file'])
        {
            $request->validate([
                'file' => 'required|mimes:mp3|max:20480',
            ]);
            $fileName = $request->file->getClientOriginalName();
            $filePath = 'teachers/tests/'.$test->id.'/questions'.'/'.$question->id.'/'.$fileName;

            $path = Storage::disk('s3')->put($filePath, file_get_contents($request->file));
            $path = Storage::disk('s3')->url($path);
        }
        $question->answers()->createMany($input['answers'])->push();
        $test->update(['max_score' => $test->max_score + $input['score']]);
        return $question;
    }
}
