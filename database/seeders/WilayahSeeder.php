<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WilayahSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('wilayah')->insert([

            ['kecamatan' => 'Pesanggaran'],
            ['kecamatan' => 'Siliragung'],
            ['kecamatan' => 'Bangorejo'],
            ['kecamatan' => 'Purwoharjo'],
            ['kecamatan' => 'Tegaldlimo'],
            ['kecamatan' => 'Muncar'],
            ['kecamatan' => 'Cluring'],
            ['kecamatan' => 'Gambiran'],
            ['kecamatan' => 'Tegalsari'],
            ['kecamatan' => 'Genteng'],
            ['kecamatan' => 'Srono'],
            ['kecamatan' => 'Rogojampi'],
            ['kecamatan' => 'Kabat'],
            ['kecamatan' => 'Singojuruh'],
            ['kecamatan' => 'Sempu'],
            ['kecamatan' => 'Songgon'],
            ['kecamatan' => 'Glagah'],
            ['kecamatan' => 'Licin'],
            ['kecamatan' => 'Banyuwangi'],
            ['kecamatan' => 'Giri'],
            ['kecamatan' => 'Kalipuro'],
            ['kecamatan' => 'Wongsorejo'],

        ]);
    }
}