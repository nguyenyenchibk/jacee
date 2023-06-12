<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

class Course extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'teacher_id',
        'category_id',
        'name',
        'code',
        'status',
        'description',
        'started_at',
        'ended_at'
    ];

    public function getFullNameAttribute($value)
    {
        return "{$this->code} - {$this->name}";
    }

    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class);
    }
}
