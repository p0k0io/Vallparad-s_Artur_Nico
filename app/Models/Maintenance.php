<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    protected $table = "maintenances";
    protected $fillable = ['context','description','path','incident_id'];

    public function incident(){
        return $this->belongsTo(Incident::class);
    }
}
