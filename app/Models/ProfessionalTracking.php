<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfessionalTracking extends Model
{
    protected $table = "professional_tracking";
    protected $fillable = ['type','subject','description','tracked','tracker'];

    public function professional(){
        return $this->belongsTo(Professional::class, 'id');
    }
    public function tracked(){
        return $this->belongsTo(Professional::class, 'id');
    }
    public function tracker(){
        return $this->belongsTo(Professional::class, 'id');
    }
}
