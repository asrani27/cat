<?php

namespace App\Console\Commands;

use App\Models\Peserta;
use Illuminate\Console\Command;
use PhpOffice\PhpSpreadsheet\IOFactory;

class HasilCat extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:hasil-cat';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $path = public_path('hasil/hasil_cat.xlsx');

        if (!file_exists($path)) {
            $this->error("File tidak ditemukan: $path");
            return 1;
        }

        $spreadsheet = IOFactory::load($path);
        $sheet = $spreadsheet->getActiveSheet();

        $data = []; // untuk menampung semua NIK
        $total = 0;

        for ($row = 7;; $row++) {
            $value = $sheet->getCell("B" . $row)->getValue();

            if ($value === null || trim($value) === '') break;

            $cleanValue = ltrim(trim($value), "'"); // Bersihkan spasi dan tanda kutip satu
            $this->line("Baris $row: $cleanValue");

            $data[] = $cleanValue;
            $total++;
        }

        $this->info("Total data terbaca dari kolom B: $total");

        // Update keterangan_ujian untuk peserta dengan NIK yang cocok
        $affected = Peserta::whereIn('nik', $data)->update(['keterangan_ujian' => 'LULUS']);

        $this->info("Total peserta yang berhasil di-update: $affected");
        return 0;
    }
}
