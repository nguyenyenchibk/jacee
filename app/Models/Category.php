<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'code',
        'status',
        'description',
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
