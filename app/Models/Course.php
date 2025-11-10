<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table = "courses";

    protected $fillable = [
        "name",
        "description",
        "mode",
        "event_type",
        "attendee",
        "startDate",
        "endDate",
        "center_id",
        "professional_id" 
    ];


    public function center()
    {
        return $this->belongsTo(Center::class);
    }

    public function professional()
    {
        return $this->belongsTo(Professional::class);
    }

        public function enrolledIn()
    {
        return $this->hasMany(EnrolledIn::class, 'course_id');
    }

}
