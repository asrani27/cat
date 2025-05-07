<?php

namespace App\Console\Commands;

use App\Imports\SoalElektro;
use App\Models\Soal;
use App\Imports\SoalImport;
use Illuminate\Console\Command;
use App\Imports\SoalElektromedis;
use App\Imports\SoalGasMedis;
use App\Imports\SoalJaringan;
use App\Imports\SoalPerawat;
use App\Imports\SoalPerekamMedis;
use App\Imports\SoalPranataJamuan;
use App\Imports\SoalPranataLab;
use App\Imports\SoalPsikologi;
use App\Imports\SoalUmum;
use Maatwebsite\Excel\Facades\Excel;

class ImportSoal extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:soal';
    protected $description = 'Import soal data from Excel file';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $ELEKTROMEDIS = public_path('soal/ELEKTROMEDIS.xlsx');
        Soal::where('jenis', 'ELEKTROMEDIS')->delete();
        Excel::import(new SoalElektromedis, $ELEKTROMEDIS);

        $gasmedis = public_path('soal/GAS MEDIS.xlsx');
        Soal::where('jenis', 'GAS MEDIS')->delete();
        Excel::import(new SoalGasMedis, $gasmedis);

        $jaringan = public_path('soal/JARINGAN KOMPUTER.xlsx');
        Soal::where('jenis', 'JARINGAN KOMPUTER')->delete();
        Excel::import(new SoalJaringan, $jaringan);

        $perawat = public_path('soal/PERAWAT.xlsx');
        Soal::where('jenis', 'PERAWAT')->delete();
        Excel::import(new SoalPerawat, $perawat);

        $perekam = public_path('soal/PEREKAM MEDIS.xlsx');
        Soal::where('jenis', 'PEREKAM MEDIS')->delete();
        Excel::import(new SoalPerekamMedis, $perekam);

        $jamuan = public_path('soal/PRANATA JAMUAN.xlsx');
        Soal::where('jenis', 'PRANATA JAMUAN')->delete();
        Excel::import(new SoalPranataJamuan, $jamuan);

        $lab = public_path('soal/PRANATA LAB.xlsx');
        Soal::where('jenis', 'PRANATA LAB')->delete();
        Excel::import(new SoalPranataLab, $lab);

        $psikologi = public_path('soal/PSIKOLOGI KLINIS.xlsx');
        Soal::where('jenis', 'PSIKOLOGI KLINIS')->delete();
        Excel::import(new SoalPsikologi, $psikologi);

        $elektro = public_path('soal/TEKNISI ELEKTRO.xlsx');
        Soal::where('jenis', 'TEKNISI ELEKTRO')->delete();
        Excel::import(new SoalElektro, $elektro);

        $umum = public_path('soal/UMUM.xlsx');
        Soal::where('jenis', 'UMUM')->delete();
        Excel::import(new SoalUmum, $umum);
        $this->info('Import selesai');
    }
}
