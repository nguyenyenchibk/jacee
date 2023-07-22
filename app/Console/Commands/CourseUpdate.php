<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Course;
use Carbon\Carbon;

class CourseUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'course:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete the course out date';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $courses = Course::get();
        foreach($courses as $course)
        {
            $ended_at = Carbon::createFromFormat('Y-m-d', $course->ended_at);
            if($ended_at->gte(Carbon::now()->format('Y-m-d')))
            {
                $course->update(['status', 0]);
            }
        }
        return true;
    }
}
