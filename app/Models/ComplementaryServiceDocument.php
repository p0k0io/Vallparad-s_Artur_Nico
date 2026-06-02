<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ComplementaryServiceDocument extends Model
{
    /**
     * El modelo ComplementaryServiceDocument representa un documento asociado a un servicio complementario específico.
     * Contiene información sobre la ruta del archivo y el ID del servicio complementario al que pertenece.
     * Este modelo se relaciona con el modelo ComplementaryService a través de la clave foránea 'complementary_service_id'.
     */
    protected $table = 'complementary_service_documents';
    protected $fillable = [
        'path',
        'complementary_service_id',
    ];

    public function complementaryService()
    {
        return $this->belongsTo(ComplementaryService::class);
    }
}
