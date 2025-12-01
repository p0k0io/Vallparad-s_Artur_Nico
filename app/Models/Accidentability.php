<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Accidentability extends Model
{
    protected $table = "accidents_reports";
    protected $fillable = ['type','context','description','duration','startDate','endDate','professional_id'];

    public function professional(){
        return $this->belongsTo(Professional::class);
    }
}
