<?php

namespace App\Http\Controllers\Teacher;

use App\Models\Lesson;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Interfaces\LessonServiceInterface;
use App\Http\Requests\Teacher\Lesson\LessonRequest;
use App\Http\Requests\Admin\Course\UpdateCourseRequest;
use App\Services\Interfaces\FileServiceInterface;
use App\Services\Interfaces\DiscussionServiceInterface;

class LessonController extends Controller
{
    protected $lessonService;
    protected $fileService;
    protected $discussionService;

    public function __construct(LessonServiceInterface $lessonService, FileServiceInterface $fileService, DiscussionServiceInterface $discussionService)
    {
        $this->lessonService = $lessonService;
        $this->fileService = $fileService;
        $this->discussionService = $discussionService;
    }

    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Course $course)
    {
        return view('teacher.lesson.create', compact('course'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Course $course, LessonRequest $request)
    {
        $this->lessonService->create($course, $request);
        return redirect()->route('teacher.course.show', compact('course'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course, Lesson $lesson)
    {
        $tests = $this->lessonService->getTestOfLesson($lesson);
        $files = $this->fileService->index($lesson);
        $discussions = $this->discussionService->index($lesson);
        return view('teacher.lesson.show', compact('course', 'lesson', 'tests', 'files', 'discussions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function edit(Lesson $lesson)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lesson $lesson)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lesson $lesson)
    {
        //
    }
}
