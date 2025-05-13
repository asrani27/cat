<?php

namespace App\Imports;

use App\Models\Soal;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;

class SoalPengadminitrasiUmum implements ToModel, WithStartRow
{
    /**
     * @param Collection $collection
     */
    public function startRow(): int
    {
        return 4; // Mulai dari baris ke-3
    }
    public function model(array $row)
    {
        $param['jenis'] = 'TEKNIS';
        $param['formasi'] = 'ADMINISTRASI UMUM';
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
