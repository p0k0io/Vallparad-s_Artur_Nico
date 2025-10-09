<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectComision extends Model
{
    protected $table = "projects_comisions";
    protected $fillable = ['name','description','observation','type','responsible','center_id'];

    public function professional(): BelongsTo{
        return $this->belongsTo(Professional::class);
    }

    public function center(): BelongsTo{
        return $this->belongsTo(Center::class);
    }

}
