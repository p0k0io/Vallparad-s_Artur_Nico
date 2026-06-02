<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ComplementaryService extends Model
{
    /**
     * El modelo ComplementaryService representa un servicio complementario asociado a un centro específico.
     * Contiene información sobre el nombre del servicio, la descripción, el gerente, el contacto, las fechas de inicio, las observaciones, los documentos relacionados y el ID del centro al que pertenece.
     * Este modelo se relaciona con el modelo Center a través de la clave foránea 'center_id' y con el modelo ComplementaryServiceDocument a través de una relación de uno a muchos.
     */
    protected $table = 'complementary_services';
    protected $with = ['documents']; //Aixo es molt raro, he utilitzat chat gpt pero es que el codi de complementaryService.blade.php es rarisim
    protected $fillable = [
        'name',
        'description',
        'manager',
        'contact',
        'startDate',
        'observations',
        'docs',
        'center_id',
    ];

    public function center()
    {
        return $this->belongsTo(Center::class, 'center_id');
    }

    public function documents()
    {
        return $this->hasMany(ComplementaryServiceDocument::class);
    }
}
