<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Uniforms extends Model
{
    //
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
