<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LokasiEkraf extends Model
{
    protected $table = 'lokasi_ekraf';

    protected $primaryKey = 'id_lokasi';

    protected $fillable = [
        'id_ekraf',
        'latitude',
        'longitude',
    ];

    public function pelakuEkraf()
    {
        return $this->belongsTo(
            PelakuEkraf::class,
            'id_ekraf',
            'id_ekraf'
        );
    }
}