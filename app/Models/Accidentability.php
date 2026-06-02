<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Accidentability extends Model
{
    /**
     * El modelo Accidentability representa un informe de accidente laboral para un profesional específico.
     * Contiene información sobre el tipo de accidente, el contexto, la descripción, la duración, las fechas de inicio y fin, la firma, el estado del accidente, el profesional afectado y quién escribió el informe.
     * Este modelo se relaciona con el modelo Professional a través de la clave foránea 'professional_id' y 'whoWrites'.
     */
    protected $table = "accidents_reports";
    protected $fillable = ['type','context','description','duration','startDate','endDate','signature','status','professional_id','whoWrites'];

    public function professional(){
        return $this->belongsTo(Professional::class);
    }

    public function whoWrites(){
        return $this->belongsTo(Professional::class, 'whoWrites');
    }
}
