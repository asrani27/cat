<?php

namespace App\Console\Commands;

use App\Models\Jawaban;
use App\Models\Peserta;
use Illuminate\Console\Command;

class checkNilai extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-nilai';

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
        $data = Peserta::get();
        $jumlahBeda = 0;

        foreach ($data as $item) {
            $skor1 = Jawaban::where('peserta_id', $item->id)
                ->whereHas('soal', function ($query) {
                    $query->whereColumn('jawaban', 'kunci');
                })->count();

            $skor2 = Jawaban::where('peserta_id', $item->id)
                ->get()->map(function ($item2) {
                    $item2->benar = $item2->jawaban == $item2->soal->kunci ? 'Y' : 'T';
                    return $item2;
                })->where('benar', 'Y')->count();

            if ($skor1 !== $skor2) {
                $this->warn("❗ Perbedaan skor ditemukan pada NIK: {$item->nik} | skor1 = {$skor1}, skor2 = {$skor2}");

                $this->line("  ✨ Detail:");
                $jawabanList = Jawaban::where('peserta_id', $item->id)->get();
                foreach ($jawabanList as $j) {
                    $soal = $j->soal; // pastikan relasi soal() didefinisikan
                    $this->line("    Jawaban: [{$j->jawaban}] | Kunci: [{$soal->kunci}] | " . ($j->jawaban === $soal->kunci ? '✅' : '❌'));
                }
            }
        }

        $this->newLine();
        $this->info("🔍 Total peserta dengan skor berbeda: {$jumlahBeda}");
    }
}
