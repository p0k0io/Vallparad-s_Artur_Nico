<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RRHH extends Model
{
    /**
     * El modelo RRHH representa un registro de recursos humanos específico.
     * Contiene información sobre el contexto, la descripción, el estado, la firma y los IDs de los profesionales involucrados.
     * Se relaciona con el modelo Professional a través de relaciones de muchos a uno, y con los modelos RrhhTracking y RrhhDocument a través de relaciones de uno a muchos.
     */
    protected $table = "pending_hr_issues";
    protected $fillable = ['context','description','status','signature','professional_id','professional_afectat','professional_derivat'];

    public function professional(){
        return $this->belongsTo(Professional::class);
    }

    public function afectat(){
        return $this->belongsTo(Professional::class,'professional_afectat');
    }

    public function derivat(){
        return $this->belongsTo(Professional::class,'professional_derivat');
    }

    public function rrhhTrackings(){
        return $this->hasMany(RrhhTracking::class, 'rrhh_id');
    }

    public function documents(){
        return $this->hasMany(RrhhDocument::class, 'rrhh_id');
    }
}
