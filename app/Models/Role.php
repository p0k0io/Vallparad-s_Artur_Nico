<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = "cv";
    protected $fillable = ['roleName'];

    public function professional(): HasMany{
        return $this->hasMany(Professional::class);
    }
}
