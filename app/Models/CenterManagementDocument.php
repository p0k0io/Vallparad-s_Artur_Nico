<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CenterManagementDocument extends Model
{
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
