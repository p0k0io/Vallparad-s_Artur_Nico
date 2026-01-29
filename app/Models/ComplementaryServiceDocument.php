<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ComplementaryServiceDocument extends Model
{
    protected $table = 'complementary_service_documents';
    protected $fillable = [
        'path',
        'complementary_service_id',
    ];

    public function complementaryService()
    {
        return $this->belongsTo(ComplementaryService::class);
    }
}
