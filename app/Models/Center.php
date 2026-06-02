<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Center extends Model
{
    /**
     * El modelo Center representa un centro de trabajo en la aplicación.
     * Contiene información sobre el nombre, teléfono, correo electrónico, ubicación y estado del centro.
     */
    protected $table = "centers";
    protected $fillable = ['name','phone','email','location','status'];

    /**
     * Obtiene la lista de profesionales asociados a este centro.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function professionals(){
        return $this->hasMany(Professional::class);
    }

    public function projectcomission(){
        return $this->hasOne(ProjectComission::class, 'center_id');
    }

    public function complementaryservice()
    {
        return $this->hasMany(ComplementaryService::class);
    }
}
