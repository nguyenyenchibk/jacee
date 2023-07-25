<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use App\Models\Course;

class AddTeacherToCourseNotification extends Notification
{
    use Queueable;
    public $teacher;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($teacher)
    {
        $this->teacher = $teacher;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        $course = Course::where('teacher_id', $this->teacher->id)->latest('created_at')->first();
        return [
            'teacher_id' => $this->teacher->id,
            'course_name' => $course->name,
            'attribute' => 'Add teacher to course'
        ];
    }
}
