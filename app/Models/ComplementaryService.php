<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ComplementaryService extends Model
{
    protected $table = 'complementary_services';
    protected $fillable = [
        'name',
        'description',
        'manager',
        'phone',
        'startDate',
        'center_id',
    ];

    public function center()
    {
        return $this->belongsTo(Center::class, 'center_id');
    }
}
