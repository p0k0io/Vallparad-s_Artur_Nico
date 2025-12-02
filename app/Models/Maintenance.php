<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    protected $table = "maintenances";
    protected $fillable = ['context','description','path','professional_id','status'];

    public function professional(){
        return $this->belongsTo(Professional::class);
    }
}
