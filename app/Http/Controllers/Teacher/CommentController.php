<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Comment;
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
        $this->commentService->teacherCreate($discussion, $request);
        return redirect()->route('teacher.lesson.show', compact('course', 'lesson'));
    }

    public function destroy(Course $course, Lesson $lesson, Comment $comment)
    {
        $comment->delete();
        return redirect()->route('teacher.lesson.show', compact('course', 'lesson'))->with('success', 'Delete comment successfully.');
    }
}
