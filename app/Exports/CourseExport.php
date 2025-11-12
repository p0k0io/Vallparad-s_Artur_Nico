<?php

namespace App\Exports;

use App\Models\EnrolledIn;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CourseExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return EnrolledIn::with(['professional', 'course'])->get()->map(function ($enrollment) {
            return [
                'professional' => $enrollment->professional->name ?? 'Sin nombre',
                'surname' => $enrollment->professional->surname1,
                'course'       => $enrollment->course->name ?? 'Sin curso',
                'status'       => $enrollment->mode,
            ];
        });
    }
    

    public function headings(): array
    {
        return ['Nombre','Apellidos', 'Curso', 'Status'];
    }
}
