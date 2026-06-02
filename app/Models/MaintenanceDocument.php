<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MaintenanceDocument extends Model
{
    /**
     * El modelo MaintenanceDocument representa un documento asociado a una tarea de mantenimiento específica.
     * Contiene información sobre la ruta del archivo del documento y se relaciona con el modelo Maintenance a través de una relación de muchos a uno.
     */
    protected $table = 'maintenance_documents';
    protected $fillable = [
        'path',
        'maintenance_id',
    ];

    public function maintenance()
    {
        return $this->belongsTo(Maintenance::class);
    }
}
