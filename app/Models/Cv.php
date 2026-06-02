<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cv extends Model
{
    /**
     * El modelo Cv representa el currículum vitae de un profesional específico.
     * Contiene información sobre la ruta del archivo del CV y se relaciona con el modelo Professional a través de una relación de uno a uno.
     */
    protected $table = "cv";
    protected $fillable = ['path'];

    public function professional(){
        return $this->hasOne(Professional::class);
    }
}
