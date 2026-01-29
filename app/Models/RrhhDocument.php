<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RrhhDocument extends Model
{
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
