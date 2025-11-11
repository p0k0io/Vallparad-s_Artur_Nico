<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class ProjectComissionAssigned extends Model
{
    protected $table = "project_comision_assignment";
    protected $fillable = ['project_comision_id','professional_id'];

    public function professional(){
        return $this->belongsTo(Professional::class);
    }

    public function projectComision(){
        return $this->belongsTo(ProjectComision::class);
    }
}
