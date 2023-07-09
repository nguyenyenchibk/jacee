<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\File;
use App\Models\Lesson;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Services\Interfaces\FileServiceInterface;

class FileController extends Controller
{
    protected $fileService;

    public function __construct(FileServiceInterface $fileService)
    {
        $this->fileService = $fileService;
    }

    public function store(Course $course, Lesson $lesson, Request $request)
    {
        $this->fileService->create($lesson, $request);
        return redirect()->route('teacher.lesson.show', compact('course', 'lesson'));
    }

    public function uploadVideo(Course $course, Lesson $lesson, Request $request)
    {
        $this->fileService->uploadVideo($lesson, $request);
        return redirect()->route('teacher.lesson.show', compact('course', 'lesson'));
    }
}
