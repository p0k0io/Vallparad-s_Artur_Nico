<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfessionalTracking extends Model
{
    protected $table = "professional_tracking";
    protected $fillable = ['type','subject','description','tracked','tracker'];

    public function professionalTracked(){
        return $this->belongsTo(Professional::class, 'tracked');
    }
    public function professionalTracker() // Canviem el nom aquí
    {
        return $this->belongsTo(Professional::class, 'tracker');
    }
}
