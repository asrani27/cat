<?php

namespace App\Console\Commands;

use App\Models\Soal;
use App\Models\Peserta;
use App\Models\Kategori;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class SoalAcak extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'soal:acak';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        DB::table('jawaban')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $peserta = Peserta::get();
        foreach ($peserta as $key => $item) {
            $formasi = str_replace("\r", '', Kategori::find($item->kategori_id)->nama);
            if ($formasi == 'PERAWAT') {
                $listSoalTeknis = Soal::where('formasi', 'PERAWAT')->get();
                $listSoal = $listSoalTeknis;
            } elseif ($formasi == 'TEKNISI GAS MEDIS') {
                $listSoalUmum = Soal::where('jenis', 'UMUM')->take(40)->get();
                $listSoalTeknis = Soal::where('formasi', $formasi)->get();
            } else {
                $listSoalUmum = Soal::where('jenis', 'UMUM')->get();
                $listSoalTeknis = Soal::where('formasi', $formasi)->get();
                $listSoal = $listSoalUmum->concat($listSoalTeknis);
            }

            // Ambil ID, acak, lalu ubah ke array
            $acakId = $listSoal->pluck('id')->shuffle()->values()->all();

            // Ubah ke JSON
            $jsonId = json_encode($acakId);
            $item->update(['soal_acak' => $jsonId]);
        }
    }
}
