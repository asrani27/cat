<?php

namespace App\Imports;

use App\Models\Soal;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class SoalPsikologi implements ToModel, WithStartRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function startRow(): int
    {
        return 4; // Mulai dari baris ke-3
    }
    public function model(array $row)
    {
        $param['jenis'] = 'PSIKOLOGI KLINIS';
        $param['pertanyaan'] = $row[1];
        $param['pil_a'] = $row[2];
        $param['pil_b'] = $row[3];
        $param['pil_c'] = $row[4];
        $param['pil_d'] = $row[5];
        $param['pil_e'] = $row[6];
        $param['kunci'] = $row[7];

        if ($param['pertanyaan'] == null) {
        } else {
            Soal::insert($param);
        }
    }
}
