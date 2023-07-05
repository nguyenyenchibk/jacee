<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Discussion extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'created_by',
        'lesson_id',
        'content'
    ];

    public function setAuthorAttribute($value)
    {
        $this->attributes['author'] = $value;
    }

    public function lesson(): BelongsTo
    {
        return $this->belongsTo(Lesson::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
}
