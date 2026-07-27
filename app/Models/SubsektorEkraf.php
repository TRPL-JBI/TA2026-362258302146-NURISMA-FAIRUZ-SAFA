<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubsektorEkraf extends Model
{
    protected $table = 'subsektor_ekraf';

    protected $primaryKey = 'id_subsektor';

    protected $fillable = [
        'nama_subsektor'
    ];

    public function pelakuEkraf()
    {
        return $this->hasMany(PelakuEkraf::class,'id_subsektor','id_subsektor');
    }
}
