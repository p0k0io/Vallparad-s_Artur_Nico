<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class centers extends Seeder
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
        'location' => 'Ctra. d’Esplugues, 18, 08906',
        'status'   => 1
    ]
]);
    
    }
}
