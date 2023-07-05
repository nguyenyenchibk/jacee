<?php

namespace App\Services\Interfaces;

use App\Services\Interfaces\ServiceInterface;
use Illuminate\Http\Request;
use App\Models\Lesson;

interface DiscussionServiceInterface extends ServiceInterface
{
    public function index(Lesson $lesson);
    public function teacherCreate(Lesson $lesson, Request $request);
    public function studentCreate(Lesson $lesson, Request $request);
}
