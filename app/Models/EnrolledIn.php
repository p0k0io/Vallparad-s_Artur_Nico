<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Professional;
use App\Models\Course;

class EnrolledIn extends Model
{
    protected $table = 'enrolled_in'; 

    protected $fillable = [
        'professional_id',
        'course_id',
        'mode',
    ];

    public function professional()
    {
        return $this->belongsTo(Professional::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
