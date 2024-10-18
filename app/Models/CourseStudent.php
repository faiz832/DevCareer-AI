<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CourseStudent extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id', 'course_id', 'videos_completed', 'is_completed', 'completed_at', 'certificate_path'
    ];

    protected $casts = [
        'is_completed' => 'boolean',
        'completed_at' => 'datetime',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
