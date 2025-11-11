<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Professional extends Model
{
    protected $table = "professional";
    protected $fillable = ['name','surname1','surname2','email','address','phone','locker','profession','linkStatus','status','keyCode','center_id','role','cv_id'];

    public function cv(){
        return $this->belongsTo(Cv::class);
    }

    public function center(){
        return $this->belongsTo(Center::class);
    }

    public function projectcomision(){
        return $this->hasMany(ProjectComision::class);
    }

    public function projectComisionAssigned(){
        return $this->hasMany(ProjectComisionAssigned::class);
    }

    public function evaluator(){
        return $this->hasMany(Evaluation::class, 'evaluator');
    }
    public function evaluated(){
        return $this->hasMany(Evaluation::class, 'evaluated');
    }
    public function tracking(){
        return $this->hasMany(ProfessionalTracking::class, 'tracker');
    }
}
