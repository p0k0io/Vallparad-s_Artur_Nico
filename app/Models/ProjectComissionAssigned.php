<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class ProjectComissionAssigned extends Model
{
    /**
     * El modelo ProjectComissionAssigned representa la asignación de un profesional a una comisión de proyecto específica.
     * Contiene información sobre los IDs del profesional y la comisión de proyecto, y se relaciona con los modelos Professional y ProjectComision a través de relaciones de muchos a uno.
     */
    protected $table = "project_comision_assignments";
    protected $fillable = ['project_comision_id','professional_id'];

    public function professional(){
        return $this->belongsTo(Professional::class);
    }

    public function projectComision(){
        return $this->belongsTo(ProjectComision::class);
    }
}
