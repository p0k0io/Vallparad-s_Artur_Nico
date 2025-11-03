<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfessionalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('professional')->insert([
            [
                'surname1' => 'García',
                'surname2' => 'López',
                'name' => 'Juan',
                'email' => 'juan.garcia@example.com',
                'address' => 'Calle Mayor 123',
                'phone' => '600123456',
                'locker' => 'L-01',
                'profession' => 'Médico',
                'linkStatus' => null,
                'status' => 1,
                'keyCode' => 'ABC123',
                'center_id' => 1,
                'role' => 1,
                'cv_id' => 1,
            ],
            [
                'surname1' => 'Martínez',
                'surname2' => 'Ruiz',
                'name' => 'Ana',
                'email' => 'ana.martinez@example.com',
                'address' => 'Avenida Sol 45',
                'phone' => '600654321',
                'locker' => 'L-02',
                'profession' => 'Enfermera',
                'linkStatus' => null,
                'status' => 1,
                'keyCode' => 'XYZ789',
                'center_id' => 1,
                'role' => 1,
                'cv_id' => 1,
            ],
            [
                'surname1' => 'Santos',
                'surname2' => 'Pérez',
                'name' => 'Luis',
                'email' => 'luis.santos@example.com',
                'address' => 'Plaza Central 8',
                'phone' => '600987654',
                'locker' => 'L-03',
                'profession' => 'Fisioterapeuta',
                'linkStatus' => null,
                'status' => 1,
                'keyCode' => 'LMN456',
                'center_id' => 1,
                'role' => 1,
                'cv_id' => 1,
            ],
        ]);
    }
}
