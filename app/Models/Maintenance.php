<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    protected $table = "maintenances";
    protected $fillable = ['context','description','responsible','path','professional_id','status','signature'];

    public function professional(){
        return $this->belongsTo(Professional::class);
    }

    public function maintenanceTrackings(){
        return $this->hasMany(MaintenanceTracking::class);
    }
}
