<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ComplementaryService extends Model
{
    protected $table = 'complementary_services';
    protected $with = ['documents']; //Aixo es molt raro, he utilitzat chat gpt pero es que el codi de complementaryService.blade.php es rarisim
    protected $fillable = [
        'name',
        'description',
        'manager',
        'contact',
        'startDate',
        'observations',
        'docs',
        'center_id',
    ];

    public function center()
    {
        return $this->belongsTo(Center::class, 'center_id');
    }

    public function documents()
    {
        return $this->hasMany(ComplementaryServiceDocument::class);
    }
}
