<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class ExternalContact extends Model
{
    //
    protected $table = "external_contacts";
    protected $fillable = ['name','description', 'manager', 'phone','address', 'email', 'center_id'];

    public function center(){
        return $this->belongsTo(Center::class, 'id');
    }
}
