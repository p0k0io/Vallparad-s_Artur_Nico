<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UniformSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         DB::table('uniforms')->insert([
            [
                'shirtSize' => 'XL',
                'pantsSize' => 'XL',
                'shoeSize' => 'XL'
            ]

         ]);
    }
}
