<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RrhhDocument extends Model
{
    /**
     * El modelo RrhhDocument representa un documento asociado a un registro de recursos humanos específico.
     * Contiene información sobre la ruta del documento y el ID del registro de recursos humanos al que está asociado.
     */
    protected $table = 'rrhh_documents';
    protected $fillable = [
        'path',
        'rrhh_id',
    ];

    public function rrhh()
    {
        return $this->belongsTo(RRHH::class);
    }
}
