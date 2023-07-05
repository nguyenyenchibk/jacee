<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Interfaces\DiscussionServiceInterface;
use App\Models\Lesson;
use App\Models\Course;

class DiscussionController extends Controller
{
    protected $discussionService;

    public function __construct(DiscussionServiceInterface $discussionService)
    {
        $this->discussionService = $discussionService;
    }

    public function store(Course $course, Lesson $lesson, Request $request)
    {
        $this->discussionService->teacherCreate($lesson, $request);
        return redirect()->route('teacher.lesson.show', compact('course', 'lesson'));
    }
}
