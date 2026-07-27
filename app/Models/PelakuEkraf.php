<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\LokasiEkraf;

class PelakuEkraf extends Model
{
    protected $table = 'pelaku_ekraf';

    protected $primaryKey = 'id_ekraf';

    protected $fillable = [
        'id_user',
        'id_subsektor',
        'id_wilayah',
        'nama_perusahaan',
        'nama_proyek',
        'alamat',
        'link_gmaps',
        'nomor_telp'
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'id_user','id_user');
    }

    public function subsektor()
    {
        return $this->belongsTo(SubsektorEkraf::class,'id_subsektor','id_subsektor');
    }

    public function wilayah()
    {
        return $this->belongsTo(Wilayah::class,'id_wilayah','id_wilayah');
    }

    public function lokasi()
    {
        return $this->hasOne(LokasiEkraf::class,'id_ekraf','id_ekraf');
    }
}