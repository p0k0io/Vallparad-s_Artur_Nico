<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectComision extends Model
{
    protected $table = "projects_comisions";
    protected $fillable = ['name','description','observation','type','responsible','center_id'];

    public function professional(){
        return $this->belongsTo(Professional::class);
    }

    public function center(){
        return $this->belongsTo(Center::class);
    }

}
