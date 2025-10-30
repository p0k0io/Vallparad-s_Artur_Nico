<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    //
    protected $table = "evaluations";
    protected $fillable = ['P1','P2','evaluated','evaluator'];


    public function evaluator(){
        return $this->belongsTo(Professional::class, 'evaluator');
    }

    public function evaluated(){
        return $this->belongsTo(Professional::class, 'evaluated');
    }
}
