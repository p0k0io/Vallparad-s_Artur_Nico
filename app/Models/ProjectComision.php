<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectComision extends Model
{
    protected $table = "projects_comisions";
    protected $fillable = ['name','description','observations','type','startDate','professional_id','center_id'];

    public function professional(){
        return $this->belongsTo(Professional::class);
    }

    public function center(){
        return $this->belongsTo(Center::class, 'id');
    }

    public function projectcomisionAssigned(){
        return $this->hasMany(ProjectComissionAssigned::class);
    }

}
