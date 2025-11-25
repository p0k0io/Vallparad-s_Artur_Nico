<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Incident extends Model
{
    protected $table = "incidents";
    protected $fillable = ['type','professional_id'];


    public function professional(){
        return $this->belongsTo(Professional::class);
    }

    public function maintenance(){
        return $this->hasMany(Maintenance::class);
    }
}
