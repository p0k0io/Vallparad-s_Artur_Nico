<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Accidentability extends Model
{
    protected $table = "accidents_reports";
    protected $fillable = ['type','context','description','duration','startDate','endDate','signature','status','professional_id','whoWrites'];

    public function professional(){
        return $this->belongsTo(Professional::class);
    }

    public function whoWrites(){
        return $this->belongsTo(Professional::class, 'whoWrites');
    }
}
