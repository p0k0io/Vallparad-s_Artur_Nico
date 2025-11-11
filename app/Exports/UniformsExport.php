<?php

namespace App\Exports;

use App\Models\Uniforms;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;

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
            'Talla Camisa',
            'Talla Pantalo',
            'Talla Peu',
            'Quantitat Camisas',
            'Quantitat Pantalons',
            'Quantitat Sabates',
            'Estat',
            'Nom Professional',
            'Ultim Uniforme',
            'Comanda Creada',
            'Comanda Actualitzada',
        ];
    }
}