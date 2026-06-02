<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentType extends Model
{
    /**
     * El modelo DocumentType representa un tipo de documento que puede estar asociado a diferentes documentos de gestión de centros.
     * Contiene información sobre el tipo de documento y se relaciona con el modelo CenterManagementDocument a través de una relación de uno a muchos.
     */
    protected $table = "document_types";
    protected $fillable = ["type"];


}
