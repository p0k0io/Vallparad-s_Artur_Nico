<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Professional;
use App\Models\Course;

class EnrolledIn extends Model
{
    /**
     * El modelo EnrolledIn representa la relación de inscripción de un profesional en un curso específico.
     * Contiene información sobre el ID del profesional, el ID del curso y el modo de inscripción.
     * Este modelo se relaciona con el modelo Professional a través de la clave foránea 'professional_id' y con el modelo Course a través de la clave foránea 'course_id'.
     */
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
