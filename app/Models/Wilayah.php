<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wilayah extends Model
{
    protected $table = 'wilayah';

    protected $primaryKey = 'id_wilayah';

    protected $fillable = [
        'kecamatan',
        'kabupaten'
    ];

    public function pelakuEkraf()
    {
        return $this->hasMany(PelakuEkraf::class,'id_wilayah','id_wilayah');
    }
}