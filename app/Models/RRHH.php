<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RRHH extends Model
{
    protected $table = "pending_hr_issues";
    protected $fillable = ['context','description','status','signature','professional_id','professional_afectat','professional_derivat'];

    public function professional(){
        return $this->belongsTo(Professional::class);
    }

    public function afectat(){
        return $this->belongsTo(Professional::class,'professional_afectat');
    }

    public function derivat(){
        return $this->belongsTo(Professional::class,'professional_derivat');
    }

    public function rrhhTrackings(){
        return $this->hasMany(RrhhTracking::class, 'rrhh_id');
    }

    public function documents(){
        return $this->hasMany(RrhhDocument::class, 'rrhh_id');
    }
}
