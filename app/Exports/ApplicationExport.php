<?php

namespace App\Exports;

use App\Models\Phase;
use App\Models\PhaseRecord;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ApplicationExport implements FromCollection, WithMapping, WithHeadings
{
    use Exportable;

    protected $date;

    public function __construct($date)
    {
        $this->date = $date;
    }

    public function collection()
    {
        return Phase::withCount('applications')->get();
    }

    public function map($phase): array
    {
        PhaseRecord::create([
            'phase_id' => $phase['id'],
            'application_count' => $phase['applications_count'],
            'created_at' => $this->date
        ]);
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
