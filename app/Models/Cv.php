<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cv extends Model
{
    protected $table = "cv";
    protected $fillable = ['path'];

    public function professional(): HasOne{
        return $this->hasOne(Professional::class);
    }
}
