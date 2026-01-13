<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServeiGeneralSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('serveis_generals')->insert([
            'center_id' => 1,
            'responsable' => 'Joaquim',
            'personal_info' => '"[{\"nom\":\"Joan\",\"horari\":\"8:00-12:00\"},{\"nom\":\"Perè\",\"horari\":\"9:00-11:00\"}]"',
            'nom_servei' => 'Cuina',
        ]);

        DB::table('serveis_generals')->insert([
            'center_id' => 1,
            'responsable' => 'Joaquim',
            'personal_info' => '"[{\"nom\":\"Joan\",\"horari\":\"8:00-12:00\"},{\"nom\":\"Perè\",\"horari\":\"9:00-11:00\"}]"',
            'nom_servei' => 'Neteja',
        ]);
    }
}
