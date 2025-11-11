<?php

namespace App\Exports;

use App\Models\EnrolledIn;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CourseExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return EnrolledIn::select('professional_id', 'course_id', 'mode')->get();
    }

    public function headings(): array
    {
        return ['Professional', 'Curso', 'Status'];
    }
}
