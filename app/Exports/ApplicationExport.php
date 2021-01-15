<?php

namespace App\Exports;

use App\Models\Phase;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ApplicationExport implements FromCollection, WithMapping, WithHeadings
{
    use Exportable;

    public function collection()
    {
        return Phase::withCount('applications')->get();
    }

    public function map($phase): array
    {
        return [
            $phase->name,
            $phase->applications_count
        ];
    }

    public function headings(): array
    {
        return [
            'Phase',
            'Applications'
        ];
    }
}
