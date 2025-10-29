<?php

namespace App\Exports;

use App\Models\Uniforms;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UniformsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Uniforms::all();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Shirt Size',
            'Pants Size',
            'Shoe Size',
            'Professional ID',
            'Last Uniform',
            'Created At',
            'Updated At',
        ];
    }
}
