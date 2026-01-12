<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MaintenanceTracking extends Model
{
    protected $table = "maintenance_tracking";
    protected $fillable = ['context','description','maintenance_id'];

    public function maintenance(){
        return $this->belongsTo(Maintenance::class);
    }
}
