<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    /**
     * El modelo Role representa un rol específico en el sistema.
     * Contiene información sobre el nombre del rol.
     */
    protected $table = "roles";
    protected $fillable = ['roleName'];
}
