<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StasiunSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('stasiun')->insert([
            [
                'kode_stasiun' => 'ULSU',
                'nama_stasiun' => 'Ulu Siau',
                'lokasi' => 'Sulawesi Utara',
            ],
            [
                'kode_stasiun' => 'AMPN',
                'nama_stasiun' => 'Ampana',
                'lokasi' => 'Sulawesi Utara',
            ],
            [
                'kode_stasiun' => 'ABLU',
                'nama_stasiun' => 'Ambalau',
                'lokasi' => 'Maluku',
            ],
            [
                'kode_stasiun' => 'MRRE',
                'nama_stasiun' => 'Marore',
                'lokasi' => 'Sulawesi Utara',
            ],
            [
                'kode_stasiun' => 'UJPD',
                'nama_stasiun' => 'Makassar',
                'lokasi' => 'Sulawesi Utara',
            ],
            [
                'kode_stasiun' => 'AGRK',
                'nama_stasiun' => 'Anggrek',
                'lokasi' => 'Gorontalo',
            ],
            [
                'kode_stasiun' => 'ALOR',
                'nama_stasiun' => 'Alor',
                'lokasi' => 'Nusa Tenggara Timur',
            ],
            [
                'kode_stasiun' => 'AMBN',
                'nama_stasiun' => 'Ambon',
                'lokasi' => 'Maluku',
            ],
            [
                'kode_stasiun' => 'AMHI',
                'nama_stasiun' => 'Amahai',
                'lokasi' => 'Maluku',
            ],
            [
                'kode_stasiun' => 'GEBE',
                'nama_stasiun' => 'Gebe',
                'lokasi' => 'Maluku Utara',
            ]
        ]);
    }
}
