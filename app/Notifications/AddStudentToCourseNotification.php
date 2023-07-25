<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use App\Models\Course;
class AddStudentToCourseNotification extends Notification
{
    use Queueable;
    public $student;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($student)
    {
        $this->student = $student;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        $course = Course::leftjoin('course_student','courses.id', '=', 'course_student.course_id')
                        ->where('course_student.student_id', $this->student->student_id)->first();
        return [
            'student_id' => $this->student->id,
            'course_name' => $course->name,
            'attribute' => 'Add student to course'
        ];
    }
}
