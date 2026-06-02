<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class ExternalContact extends Model
{
    /**
     * El modelo ExternalContact representa un contacto externo asociado a un centro específico.
     * Contiene información sobre el nombre del contacto, la descripción, el gerente, el teléfono, la dirección, el correo electrónico, el ID del centro al que pertenece y el tipo de contacto.
     * Este modelo se relaciona con el modelo Center a través de la clave foránea 'center_id'.
     */
    protected $table = "external_contacts";
    protected $fillable = ['name','description', 'manager', 'phone','address', 'email', 'center_id', 'type'];

    public function center(){
        return $this->belongsTo(Center::class, 'id');
    }
}
