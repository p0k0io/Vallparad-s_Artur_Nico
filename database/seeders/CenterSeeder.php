<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CenterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         DB::table('centers')->insert([
        [
        'name'     => 'Can Serra',
        'phone'    => '666666666',
        'location' => 'Ctra. d’Esplugues, 18, 08906'
        ]
    ]);
    }
}
