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
        "professional_id" // Añadido para la relación
    ];

    // Relación con Center
    public function center()
    {
        return $this->belongsTo(Center::class);
    }

    // Relación con Professional
    public function professional()
    {
        return $this->belongsTo(Professional::class);
    }
}
