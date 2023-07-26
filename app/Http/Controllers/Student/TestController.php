<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Interfaces\QuestionServiceInterface;
use App\Models\Test;
use App\Models\Course;
use App\Models\Answer;
use App\Models\Result;
use App\Models\Lesson;
use App\Models\StudentTest;
use App\Models\Question;
class TestController extends Controller
{
   protected $questionService;

   public function __construct(QuestionServiceInterface $questionService)
   {
       $this->questionService = $questionService;
   }

    public function show(Course $course, Lesson $lesson, Test $test)
    {
        $questions = $this->questionService->index($test);
        return view('student.test.show', compact('questions', 'test', 'lesson', 'course'));
    }

    public function store(Course $course, Lesson $lesson, Test $test, Request $request)
    {
        $score = 0 ;
        StudentTest::where('test_id', $test->id)->where('student_id', auth()->guard('student')->user()->id)->delete();
        Result::where('test_id', $test->id)->where('student_id', auth()->guard('student')->user()->id)->delete();
        $answers = Answer::find(array_values($request->input('questions')));
        foreach($answers as $answer)
        {
            if($answer->is_correct == 1)
            {
                $point = Question::where('id', $answer->question_id)->get('score');
                $score += $point->sum('score');
            }
            Result::create([
                'test_id' => $test->id,
                'student_id' => auth()->guard('student')->user()->id,
                'question' => $answer->question_id,
                'answer' => $answer->id,
                'is_correct' => $answer->is_correct,
            ]);
        }
        StudentTest::create([
            'test_id' => $test->id,
            'student_id' => auth()->guard('student')->user()->id,
            'score' => $score,
            'average' => ($score / $test->max_score) * 100
        ]);
        return redirect()->route('student.test.result', compact('test', 'course', 'lesson'));
    }

    public function result(Course $course, Lesson $lesson, Test $test)
    {
        $results = Result::where('results.test_id', $test->id)->where('results.student_id', auth()->guard('student')->user()->id)->get();
        $questions = $this->questionService->index($test);
        $student_test = StudentTest::where('test_id', $test->id)
                        ->where('student_id', auth()->guard('student')->user()->id)
                        ->where('deleted_at', NULL)
                        ->pluck('average');
        return view('student.result.show', compact('results', 'questions', 'student_test', 'test', 'lesson', 'course'));
    }
}
