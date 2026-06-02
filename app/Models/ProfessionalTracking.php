<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfessionalTracking extends Model
{
    /**
     * El modelo ProfessionalTracking representa un seguimiento de un profesional específico.
     * Contiene información sobre el tipo, el asunto, la descripción y los IDs de los profesionales involucrados.
     */
    protected $table = "professional_tracking";
    protected $fillable = ['type','subject','description','tracked','tracker'];

    public function professionalTracked(){
        return $this->belongsTo(Professional::class, 'tracked');
    }
    public function professionalTracker() // Canviem el nom aquí
    {
        return $this->belongsTo(Professional::class, 'tracker');
    }
}
