<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Professional extends Model
{
    protected $table = "professional";
    protected $fillable = ['name','surname1','surname2','email','address','phone','locker','profession','linkStatus','keyCode','locker_id','key_id','center_id','rol_id','cv_id'];
}
