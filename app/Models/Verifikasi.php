<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Verifikasi extends Model
{
    protected $table = 'verifikasi';

    protected $primaryKey = 'id_verifikasi';

    protected $fillable = [

        'id_user',

        'nama_perusahaan',

        'nama_proyek',

        'alamat',

        'id_subsektor',

        'id_wilayah',

        'link_gmaps',

        'nomor_telp',

        'jenis_pengajuan',

        'status_verifikasi',

        'catatan',

        'tanggal_verifikasi'

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
}