<?php

namespace App\Services\Interfaces;

use App\Services\Interfaces\ServiceInterface;
use Illuminate\Http\Request;
use App\Models\Lesson;

interface FileServiceInterface extends ServiceInterface
{
    public function index(Lesson $lesson);
    public function create(Lesson $lesson, Request $request);
    public function delete($file);
    public function indexVideo(Lesson $lesson);
    public function uploadVideo(Lesson $lesson, Request $request);
}
