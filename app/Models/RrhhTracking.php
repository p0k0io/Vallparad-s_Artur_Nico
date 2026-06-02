<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RrhhTracking extends Model
{
    /**
     * El modelo RrhhTracking representa un seguimiento asociado a un registro de recursos humanos específico.
     * Contiene información sobre el contexto, la descripción y el ID del registro de recursos humanos al que está asociado.
     * Se relaciona con el modelo RRHH a través de una relación de muchos a uno.
     */
    protected $table = "rrhh_tracking";
    protected $fillable = ['context','description','rrhh_id'];

    public function rrhh(){
        return $this->belongsTo(RRHH::class, 'rrhh_id');
    }
}
