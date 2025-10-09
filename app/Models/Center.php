<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Center extends Model
{
    protected $table = "centers";
    protected $fillable = ['name','phone','email','location'];

    public function professional(): HasMany{
        return $this->hasMany(Professional::class);
    }

    public function projectcomission(): HasOne{
        return $this->hasOne(ProjectComission::class);
    }
}
