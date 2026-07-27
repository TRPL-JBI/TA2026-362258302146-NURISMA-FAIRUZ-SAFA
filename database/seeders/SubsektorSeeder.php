<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubsektorSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('subsektor_ekraf')->insert([

            ['nama_subsektor' => 'Aplikasi'],
            ['nama_subsektor' => 'Arsitektur'],
            ['nama_subsektor' => 'Desain Interior'],
            ['nama_subsektor' => 'Desain Komunikasi Visual'],
            ['nama_subsektor' => 'Desain Produk'],
            ['nama_subsektor' => 'Fashion'],
            ['nama_subsektor' => 'Film, Animasi dan Video'],
            ['nama_subsektor' => 'Fotografi'],
            ['nama_subsektor' => 'Game Developer'],
            ['nama_subsektor' => 'Kriya'],
            ['nama_subsektor' => 'Kuliner'],
            ['nama_subsektor' => 'Musik'],
            ['nama_subsektor' => 'Penerbitan'],
            ['nama_subsektor' => 'Periklanan'],
            ['nama_subsektor' => 'Seni Pertunjukan'],
            ['nama_subsektor' => 'Seni Rupa'],
            ['nama_subsektor' => 'Televisi dan Radio'],

        ]);
    }
}