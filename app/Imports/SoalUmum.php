<?php

namespace App\Imports;

use App\Models\Soal;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class SoalUmum implements ToModel, WithStartRow
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

    public function drawings()
    {
        $drawings = [];

        foreach (func_get_args()[0]->getDrawingCollection() as $drawing) {
            /** @var Drawing $drawing */
            $row = $drawing->getCoordinates(); // contoh: 'C5'

            $filename = uniqid() . '.' . pathinfo($drawing->getPath(), PATHINFO_EXTENSION);
            $destination = public_path('uploads/images/' . $filename);

            copy($drawing->getPath(), $destination);

            // Simpan ke array berdasarkan baris
            preg_match('/\D+(\d+)/', $row, $matches);
            $rowNumber = $matches[1] ?? null;

            if ($rowNumber) {
                $this->images[$rowNumber] = 'uploads/images/' . $filename;
            }

            $drawings[] = $drawing;
        }

        return $drawings;
    }
}
