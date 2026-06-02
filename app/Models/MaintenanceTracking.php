<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MaintenanceTracking extends Model
{
    /**
     * El modelo MaintenanceTracking representa un seguimiento de una tarea de mantenimiento específica.
     * Contiene información sobre el contexto, la descripción y el ID de la tarea de mantenimiento a la que está asociado.
     * Este modelo se relaciona con el modelo Maintenance a través de la clave foránea 'maintenance_id'.
     */
    protected $table = "maintenance_tracking";
    protected $fillable = ['context','description','maintenance_id'];

    public function maintenance(){
        return $this->belongsTo(Maintenance::class);
    }
}
