<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Center extends Model
{
    protected $table = "centers";
    protected $fillable = ['name','phone','email','location','status'];

    public function professionals(){
        return $this->hasMany(Professional::class);
    }

    public function projectcomission(){
        return $this->hasOne(ProjectComission::class, 'center_id');
    }
}
