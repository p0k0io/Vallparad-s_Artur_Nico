<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    /**
     * El modelo Course representa un curso de formación asociado a un centro específico y a un profesional específico.
     * Contiene información sobre el nombre del curso, la descripción, el modo, el tipo de evento, el asistente, las fechas de inicio y fin, el ID del centro al que pertenece y el ID del profesional asociado.
     * Este modelo se relaciona con el modelo Center a través de la clave foránea 'center_id', con el modelo Professional a través de la clave foránea 'professional_id' y con el modelo EnrolledIn a través de una relación de uno a muchos.
     */
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
