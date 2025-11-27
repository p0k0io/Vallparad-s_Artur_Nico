<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Accidentability extends Model
{
    protected $table = "accidents_reports";
    protected $fillable = ['type','context','description','duration','professional_id','incident_id'];

    public function incident(){
        return $this->belongsTo(Incident::class);
    }

    public function professional(){
        return $this->belongsTo(Professional::class);
    }
}
