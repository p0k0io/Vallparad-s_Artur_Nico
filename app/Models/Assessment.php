<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assessment extends Model
{
    //
    protected $table = "assessment";
    protected $fillable = ['P1','P2','average','professional_id'];


    public function professional(){
        return $this->belongsTo(Professional::class);
    }
}
