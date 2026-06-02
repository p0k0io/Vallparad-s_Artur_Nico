<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class ServeiGeneral extends Model
{
    /**
     * El modelo ServeiGeneral representa un servicio general específico.
     * Contiene información sobre el centro asociado, el responsable, la información personal y el nombre del servicio.
     * Se relaciona con el modelo Center a través de una relación de muchos a uno.
     */
    protected $table = 'serveis_generals';
    protected $fillable = [
        'center_id',
        'responsable',
        'personal_info',
        'nom_servei',
    ];

    protected $casts = [
        'personal_info' => 'array',
    ];

    public function center()
    {
        return $this->belongsTo(Center::class, 'center_id');
    }

}
