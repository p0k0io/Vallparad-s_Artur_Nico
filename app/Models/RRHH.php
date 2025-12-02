<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RRHH extends Model
{
    protected $table = "pending_hr_issues";
    protected $fillable = ['context','description','professional_id','professional_afectat','professional_derivat'];

    public function professional(){
        return $this->belongsTo(Professional::class);
    }

    public function professional_afectat(){
        return $this->belongsTo(Professional::class,'professional_afectat');
    }

    public function professional_derivat(){
        return $this->belongsTo(Professional::class,'professional_derivat');
    }
}
