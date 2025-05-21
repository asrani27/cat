<?php

namespace App\Console\Commands;

use App\Models\Soal;
use App\Imports\SoalUmum;
use App\Imports\SoalBinatu;
use App\Imports\SoalImport;
use App\Imports\SoalElektro;
use App\Imports\SoalPerawat;
use App\Imports\SoalGasMedis;
use App\Imports\SoalJaringan;
use App\Imports\SoalPsikologi;
use App\Imports\SoalPramubakti;
use App\Imports\SoalPranataLab;
use Illuminate\Console\Command;
use App\Imports\SoalPemulasaran;
use App\Imports\SoalElektromedis;
use App\Imports\SoalPerekamMedis;
use App\Imports\SoalPranataJamuan;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\SoalPengadminitrasiUmum;

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
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('soal')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // $ELEKTROMEDIS = public_path('soal/ELEKTROMEDIS.xlsx');
        // Soal::where('formasi', 'TEKNIK ELEKTROMEDIS')->delete();
        // Excel::import(new SoalElektromedis, $ELEKTROMEDIS);

        $gasmedis = public_path('soal/GAS MEDIS.xlsx');
        Soal::where('formasi', 'TEKNISI GAS MEDIS')->delete();
        Excel::import(new SoalGasMedis, $gasmedis);

        // $jaringan = public_path('soal/JARINGAN KOMPUTER.xlsx');
        // Soal::where('formasi', 'TEKNISI JARINGAN')->delete();
        // Excel::import(new SoalJaringan, $jaringan);

        $perawat = public_path('soal/SOAL_PERAWAT.xlsx');
        Soal::where('formasi', 'PERAWAT')->delete();
        Excel::import(new SoalPerawat, $perawat);

        // $perekam = public_path('soal/PEREKAM MEDIS.xlsx');
        // Soal::where('formasi', 'PEREKAM MEDIS')->delete();
        // Excel::import(new SoalPerekamMedis, $perekam);

        // $jamuan = public_path('soal/PRANATA JAMUAN.xlsx');
        // Soal::where('formasi', 'PRANATA JAMUAN')->delete();
        // Excel::import(new SoalPranataJamuan, $jamuan);

        // $lab = public_path('soal/PRANATA LAB.xlsx');
        // Soal::where('formasi', 'PRANATA LAB')->delete();
        // Excel::import(new SoalPranataLab, $lab);

        // $psikologi = public_path('soal/PSIKOLOGI KLINIS.xlsx');
        // Soal::where('formasi', 'PSIKOLOGI KLINIS')->delete();
        // Excel::import(new SoalPsikologi, $psikologi);

        // $elektro = public_path('soal/TEKNISI ELEKTRO.xlsx');
        // Soal::where('formasi', 'TEKNISI ELEKTRO')->delete();
        // Excel::import(new SoalElektro, $elektro);

        // $administrasi_umum = public_path('soal/TEKNIS2.xlsx');
        // Soal::where('formasi', 'PENGADMINISTRASI UMUM')->delete();
        // Excel::import(new SoalPengadminitrasiUmum, $administrasi_umum);

        // $binatu = public_path('soal/TEKNIS2.xlsx');
        // Soal::where('formasi', 'BINATU')->delete();
        // Excel::import(new SoalBinatu, $binatu);

        // $pemulasaran = public_path('soal/TEKNIS2.xlsx');
        // Soal::where('formasi', 'PEMULASARAN JENAZAH')->delete();
        // Excel::import(new SoalPemulasaran, $pemulasaran);

        // $pramubakti = public_path('soal/TEKNIS2.xlsx');
        // Soal::where('formasi', 'PRAMUBAKTI')->delete();
        // Excel::import(new SoalPramubakti, $pramubakti);

        // $umum = public_path('soal/UMUM.xlsx');
        // Soal::where('jenis', 'UMUM')->delete();
        // Excel::import(new SoalUmum, $umum);
        $this->info('Import selesai');
    }
}
