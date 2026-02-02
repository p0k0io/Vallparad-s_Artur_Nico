<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    //
    protected $table = "evaluations";
    protected $fillable = ['P1','P2','P3','P4','P5','P6','P7','P8','P9','P10','P11','P12','P13','P14','P15','P16','P17','P18','P19','P20','evaluated','evaluator'];


    public function evaluatorAssessment(){
        return $this->belongsTo(Professional::class, 'evaluator');
    }

    public function evaluatedAssessment(){
        return $this->belongsTo(Professional::class, 'evaluated');
    }
}
