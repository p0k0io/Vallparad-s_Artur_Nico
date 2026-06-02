<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Maintenance class, contains relations to professional, maintenanceTrackings and documents
 */
class Maintenance extends Model
{
    protected $table = "maintenances";
    protected $fillable = ['context','description','responsible','path','professional_id','status','signature'];

    /**
     * Get the professional that owns the maintenance.
     */
    public function professional(){
        return $this->belongsTo(Professional::class);
    }

    /**
     * Get the maintenance trackings for the maintenance.
     * 
     */
    public function maintenanceTrackings(){
        return $this->hasMany(MaintenanceTracking::class);
    }

    public function documents()
    {
        return $this->hasMany(MaintenanceDocument::class);
    }
}
