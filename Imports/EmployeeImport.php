<?php

namespace Luanardev\Modules\Employees\Imports;

use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class EmployeeImport implements  WithMultipleSheets, WithChunkReading, WithBatchInserts, ShouldQueue
{
    use Importable;

    public function sheets(): array
    {
        return [
            'Profile' => new ProfileImport(),
            'Employment' => new EmploymentImport(),
            'Spouse' => new SpouseImport(),
            'Kinsman' => new KinsmanImport(),
            'Dependant' => new DependantImport(),
            'Qualification' => new QualificationImport(),
            'Award' => new AwardImport()
        ];
    }

    public function batchSize(): int
    {
        return 1000;
    }

    public function chunkSize(): int
    {
        return 1000;
    }

}
