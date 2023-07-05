<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Interfaces\CommentServiceInterface;
use App\Models\Lesson;
use App\Models\Course;
use App\Models\Discussion;

class CommentController extends Controller
{
    protected $commentService;

    public function __construct(CommentServiceInterface $commentService)
    {
        $this->commentService = $commentService;
    }

    public function store(Course $course, Lesson $lesson, Discussion $discussion, Request $request)
    {
        $this->commentService->studentCreate($discussion, $request);
        return redirect()->route('student.lesson.show', compact('course', 'lesson'));
    }
}
