<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;
use Carbon\Carbon;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
         Course::create([
            'name' => 'Curso Asistencia en el Trabajo',
            'description' => 'Formación práctica sobre asistencia y protocolos laborales.',
            'mode' => 'onsite',
            'event_type' => 'workshop',
            'attendee' => 61,
            'startDate' => '2025-10-28',
            'endDate' => '2025-11-18',
            'center_id' => 1,
            'professional_id' => 1,
        ]);

        Course::create([
            'name' => 'Curso de Innovación Digital',
            'description' => 'Introducción a herramientas digitales y productividad.',
            'mode' => 'online',
            'event_type' => 'seminar',
            'attendee' => 45,
            'startDate' => '2025-11-05',
            'endDate' => '2025-12-10',
            'center_id' => 1,
            'professional_id' => 1,
        ]);
    }
}
