<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Interfaces\LessonServiceInterface;
use App\Services\Interfaces\DiscussionServiceInterface;
use App\Services\Interfaces\FileServiceInterface;
use App\Models\Lesson;
use App\Models\Course;

class LessonController extends Controller
{
    protected $lessonService;
    protected $discussionService;
    protected $fileService;

    public function __construct(LessonServiceInterface $lessonService, DiscussionServiceInterface $discussionService, FileServiceInterface $fileService)
    {
        $this->lessonService = $lessonService;
        $this->discussionService = $discussionService;
        $this->fileService = $fileService;
    }

    public function show(Course $course, Lesson $lesson)
    {
        $files = $this->fileService->index($lesson);
        $videos = $this->fileService->indexVideo($lesson);
        $tests = $this->lessonService->getTestOfLesson($lesson);
        $discussions = $this->discussionService->index($lesson);
        return view('student.lesson.show', compact('course', 'lesson', 'tests', 'discussions', 'files', 'videos'));
    }
}
