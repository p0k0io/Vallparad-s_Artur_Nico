<?php

namespace App\Exports;

use App\Models\ProjectComissionAssigned;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;

class ProjectComissionExport implements FromCollection, WithHeadings, WithEvents
{
    public function collection()
    {
        return ProjectComissionAssigned::with(['professional', 'projectComision'])->get()->map(function ($assignation) {
            return [
                'professional' => $assignation->professional->name ?? 'Sense nom',
                'surname' => $assignation->professional->surname1,
                'projectComision'       => $assignation->projectComision->name ?? 'Sense Projecte/Comisio',
                'type'       => $assignation->projectComision->type,
            ];
        });
    }
    
    /*
    CSV AFECTA I NO DEIXA PINTAR

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                // Pinta la fila 1 (headings)
                $event->sheet->getStyle('A1:D1')->applyFromArray([
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'startColor' => ['rgb' => 'FFFF00'],
                    ],
                ]);
            },
        ];
    }
    */

    public function headings(): array
    {
        return ['Nom','Cognoms', 'Projecte/Comisio', 'Tipus'];
    }
}
