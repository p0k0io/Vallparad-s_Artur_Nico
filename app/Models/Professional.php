<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Professional extends Model
{
    protected $table = "professional";
    protected $fillable = ['name','surname1','surname2','email','address','phone','locker','profession','linkStatus','status','keyCode','center_id','rol_id','cv_id'];

    public function cv(){
        return $this->belongsTo(Cv::class);
    }

    public function role(){
        return $this->belongsTo(Role::class);
    }

    public function center(){
        return $this->belongsTo(Center::class);
    }

    public function projectcomission(){
        return $this->hasMany(ProjectComission::class);
    }
}
