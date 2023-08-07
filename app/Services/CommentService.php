<?php

namespace App\Services;

use App\Services\Service;
use App\Services\Interfaces\CommentServiceInterface;
use Illuminate\Http\Request;
use App\Models\Discussion;
use App\Models\Comment;
use App\Models\Student;
use App\Models\Teacher;

class CommentService extends Service implements CommentServiceInterface
{
    public function index()
    {
        $can_delete = 0;
        $comments = Comment::get();
        foreach($comments as $comment)
        {
            $authors = explode('_', $comment->created_by);
            if(strcmp($authors[0], "te") == 0 && auth()->guard('teacher')->user()->id == $authors[1])
            {
                $can_delete = 1;
            }
            if(strcmp($authors[0], "stu") == 0)
            {
                $author = Student::where('id', $authors[1])->get('name')->toArray();
                $comment->author = $author[0]['name'];
                if (auth()->guard('student')->user()->id == $authors[1]) {
                    $can_delete = 1;
                }
            }
        }
        return $can_delete;
    }

    public function teacherCreate(Discussion $discussion, Request $request)
    {
        $input = $request->validate([
            'content' =>'required|string'
        ]);
        $comment = Comment::create([
            'created_by' => 'te_'.auth()->guard('teacher')->user()->id,
            'discussion_id' => $discussion->id,
            'content' => $input['content'],
        ]);
        return $comment;
    }

    public function studentCreate(Discussion $discussion, Request $request)
    {
        $input = $request->validate([
            'content' =>'required|string'
        ]);
        $comment = Comment::create([
            'created_by' => 'stu_'.auth()->guard('student')->user()->id,
            'discussion_id' => $discussion->id,
            'content' => $input['content'],
        ]);
        return $comment;
    }
}
