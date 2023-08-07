<?php

namespace App\Services;

use App\Services\Service;
use App\Services\Interfaces\DiscussionServiceInterface;
use Illuminate\Http\Request;
use App\Models\Lesson;
use App\Models\Discussion;
use App\Models\Teacher;
use App\Models\Student;

class DiscussionService extends Service implements DiscussionServiceInterface
{
    public function index(Lesson $lesson)
    {
        $discussions = Discussion::where('lesson_id', $lesson->id)->get();
        foreach($discussions as $discussion)
        {
            $authors = explode('_', $discussion->created_by);
            if(strcmp($authors[0], "te") == 0)
            {
                $author = Teacher::where('id', $authors[1])->get('name')->toArray();
                $discussion->author = $author[0]['name'];
                $discussion->creater = $authors[0];
                $discussion->teacher_id = $authors[1];
            }
            if(strcmp($authors[0], "stu") == 0)
            {
                $author = Student::where('id', $authors[1])->get('name')->toArray();
                $discussion->author = $author[0]['name'];
                $discussion->creater = $authors[0];
                $discussion->student_id = $authors[1];
            }
        }
        return $discussions;
    }

    public function teacherCreate(Lesson $lesson, Request $request)
    {
        $input = $request->validate([
            'content' =>'required|string'
        ]);
        $discussion = Discussion::create([
            'created_by' => 'te_'.auth()->guard('teacher')->user()->id,
            'lesson_id' => $lesson->id,
            'content' => $input['content'],
        ]);
        return $discussion;
    }

    public function studentCreate(Lesson $lesson, Request $request)
    {
        $input = $request->validate([
            'content' =>'required|string'
        ]);
        $discussion = Discussion::create([
            'created_by' => 'stu_'.auth()->guard('student')->user()->id,
            'lesson_id' => $lesson->id,
            'content' => $input['content'],
        ]);
        return $discussion;
    }
}
