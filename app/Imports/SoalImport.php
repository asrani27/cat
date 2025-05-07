<?php

namespace App\Imports;

use App\Models\Soal;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class SoalImport implements ToModel, WithStartRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function startRow(): int
    {
        return 4; // Mulai dari baris ke-4
    }
    public function model(array $row)
    {

        return new Soal([
            'name' => $row[0],
            'email' => $row[1],
        ]);
    }
}
