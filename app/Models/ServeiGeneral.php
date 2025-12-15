<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class ServeiGeneral extends Model
{
    //
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
