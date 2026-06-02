<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Uniforms extends Model
{
    /**
     * El modelo Uniforms representa un uniforme específico asociado a un profesional.
     * Contiene información sobre las tallas de camisa, pantalón y zapatos, la cantidad de cada prenda, el estado del uniforme y el ID del profesional al que está asociado.
     * Se relaciona con el modelo Professional a través de una relación de muchos a uno, y con el modelo Uniform a través de una relación de muchos a uno para obtener el último uniforme asignado.
     */
    protected $table = "uniforms";
    protected $fillable = ['shirtSize','pantsSize','shoeSize','shirtAm','pantAm','shoeAm', 'status','professional_id'];
    
    
    public function professional()
    {
        return $this->belongsTo(Professional::class, 'professional_id');
    }

    
    public function lastUniform()
    {
        return $this->belongsTo(Uniform::class, 'lastUniform'); 
    }


}
