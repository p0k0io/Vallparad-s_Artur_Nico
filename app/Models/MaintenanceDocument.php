<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MaintenanceDocument extends Model
{
    protected $table = 'maintenance_documents';
    protected $fillable = [
        'path',
        'maintenance_id',
    ];

    public function maintenance()
    {
        return $this->belongsTo(Maintenance::class);
    }
}
