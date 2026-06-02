<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Professional extends Model
{
    /**
     * El modelo Professional representa un profesional en el sistema.
     * Contiene información sobre el nombre, apellidos, correo electrónico, dirección y otros detalles relevantes.
     */
    protected $table = "professional";
    protected $fillable = ['name','surname1','surname2','email','address','phone','locker','profession','linkStatus','status','keyCode','center_id','role','cv_id','user_id'];

    /**
     * Get the CV associated with the professional.
     */
    public function cv(){
        return $this->belongsTo(Cv::class);
    }

    /**
     * Get the center that the professional belongs to.
     */
    public function center(){
        return $this->belongsTo(Center::class);
    }

    /**
     * Get the courses associated with the professional.
     */
    public function projectcomision(){
        return $this->hasMany(ProjectComision::class);
    }


    /**
     * Get the project commissions assigned to the professional.
     */
    public function projectComisionAssigned(){
        return $this->hasMany(ProjectComissionAssigned::class);
    }

    /**
     * Get the enrolled courses for the professional.
     */
    public function evaluator(){
        return $this->hasMany(Evaluation::class, 'evaluator');
    }

    /**
     * Get the evaluations where the professional is evaluated.
     */
    public function evaluated(){
        return $this->hasMany(Evaluation::class, 'evaluated');
    }

    /**
     * Get the professional trackings where the professional is the tracked.
     */
    public function tracked(){
        return $this->hasMany(ProfessionalTracking::class, 'tracked');
    }

    /**
     * Get the professional trackings where the professional is the tracker.
     */
    public function tracker(){
        return $this->hasMany(ProfessionalTracking::class, 'tracker');
    }


    /**
     * Get the user associated with the professional.
     */
    public function user(){
        return $this->belongsTo(User::class);
    }

    /**
     * Get the maintenances associated with the professional.
     */
    public function maintenance(){
        return $this->hasMany(Maintenance::class);
    }

    /**
     * Get the accidentability records associated with the professional.
     */
    public function accidentability(){
        return $this->hasMany(Accidentability::class);
    }

    /**
     * Get the accidentability records where the professional is the one who writes.
     */
    public function whoWritesAcc(){
        return $this->hasMany(Accidentability::class,'whoWrites');
    }

    /**
     * Get the RRHH records associated with the professional.
     */
    public function rrhh(){
        return $this->hasMany(RRHH::class);
    }
}
