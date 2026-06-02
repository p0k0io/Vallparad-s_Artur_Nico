<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CenterManagementDocument extends Model
{
    /**
     * El modelo CenterManagementDocument representa un documento de gestión asociado a un centro específico.
     * Contiene información sobre la descripción del documento, la ruta del archivo, el ID del centro al que pertenece y el tipo de documento.
     * Este modelo se relaciona con el modelo Center a través de la clave foránea 'center_id' y con el modelo DocumentType a través de la clave foránea 'type_id'.
     */
    protected $table = "center_management_documents";

    protected $fillable = [
        'description',
        'path',
        'center_id',
        'type_id',
    ];

    // Relación con Center
    public function center()
    {
        return $this->belongsTo(Center::class); // << aquí debe apuntar a tu modelo Center
    }

    // Relación con DocumentType
    public function type()
    {
        return $this->belongsTo(DocumentType::class, 'type_id');
    }
}
