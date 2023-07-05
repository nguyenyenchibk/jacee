<?php

namespace App\Services\Interfaces;

use App\Services\Interfaces\ServiceInterface;
use Illuminate\Http\Request;
use App\Models\Discussion;

interface CommentServiceInterface extends ServiceInterface
{
    public function index(Discussion $discussion);
    public function teacherCreate(Discussion $discussion, Request $request);
    public function studentCreate(Discussion $discussion, Request $request);
}
