<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Interfaces\LessonServiceInterface;
use App\Services\Interfaces\DiscussionServiceInterface;
use App\Models\Lesson;
use App\Models\Course;

class LessonController extends Controller
{
    protected $lessonService;
    protected $discussionService;

    public function __construct(LessonServiceInterface $lessonService, DiscussionServiceInterface $discussionService)
    {
        $this->lessonService = $lessonService;
        $this->discussionService = $discussionService;
    }

    public function show(Course $course, Lesson $lesson)
    {
        $tests = $this->lessonService->getTestOfLesson($lesson);
        $discussions = $this->discussionService->index($lesson);
        return view('student.lesson.show', compact('course', 'lesson', 'tests', 'discussions'));
    }
}
