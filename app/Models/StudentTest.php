<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentTest extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'student_test';
    protected $fillable = [
        'test_id',
        'student_id',
        'score',
    ];
}
