<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RrhhTracking extends Model
{
    protected $table = "rrhh_tracking";
    protected $fillable = ['context','description','rrhh_id'];

    public function rrhh(){
        return $this->belongsTo(RRHH::class, 'rrhh_id');
    }
}
