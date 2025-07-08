<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('role')->insert([
            [
                'id' => 1,
                'nama_role' => 'umum'
            ],
            [
                'id' => 2,
                'nama_role' => 'administrator'
            ],
            [
                'id' => 3,
                'nama_role' => 'operator'
            ],
            [
                'id' => 4,
                'nama_role' => 'bendahara'
            ]
        ]);
    }
}