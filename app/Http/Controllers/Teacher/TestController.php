<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Test;
use App\Models\Lesson;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Requests\Teacher\Test\TestRequest;
use App\Services\Interfaces\TestServiceInterface;
use App\Services\Interfaces\QuestionServiceInterface;
class TestController extends Controller
{
    protected $testService;
    protected $questionService;

    public function __construct(TestServiceInterface $testService, QuestionServiceInterface $questionService)
    {
        $this->testService = $testService;
        $this->questionService = $questionService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Course $course, Lesson $lesson)
    {
        return view('teacher.test.create', compact('course', 'lesson'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Course $course, Lesson $lesson, TestRequest $request)
    {
        $this->testService->create($lesson, $request);
        return redirect()->route('teacher.lesson.show', compact('course', 'lesson'))->with('success', 'Upload a new test to course successfully.');;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function show(Test $test)
    {
        $questions = $this->questionService->index($test);
        // $files = $this->questionService->indexQuesFile($test);
        return view('teacher.test.show', compact('test', 'questions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function edit(Test $test)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Test $test)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function destroy(Test $test)
    {
        //
    }
}
