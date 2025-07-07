<?php

namespace App\Exports;

use App\Models\Soal;
use App\Models\Jawaban;
use App\Models\Kategori;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class PendaftarExport implements FromView, ShouldAutoSize
{
    /**
     * @return \Illuminate\Support\Collection
     */
    protected $id;
    public function __construct($id)
    {
        $this->id = $id;
    }
    public function view(): View
    {
        $formasi = str_replace("\r", '', Kategori::find($this->id)->nama);

        if ($formasi == 'PERAWAT') {
            $soal = Soal::where('formasi', 'PERAWAT')->get();
        } elseif ($formasi == 'TEKNISI GAS MEDIS') {
            $soal = Soal::where('jenis', 'UMUM')->take(40)->get()
                ->concat(Soal::where('formasi', $formasi)->get());
        } else {
            $soal = Soal::where('jenis', 'UMUM')->get()
                ->concat(Soal::where('formasi', $formasi)->get());
        }

        $jmlSoal = $soal->count();

        $data = Kategori::with(['peserta.jawaban.soal'])->findOrFail($this->id)
            ->peserta->map(function ($peserta) {
                $jawaban = $peserta->jawaban;

                $peserta->dijawab = $jawaban->count();

                $peserta->benar = $jawaban->filter(function ($jawab) {
                    return $jawab->jawaban === optional($jawab->soal)->kunci;
                })->count();

                return $peserta;
            })
            ->sortByDesc('benar')
            ->values();

        // Ranking logic
        $currentRank = 1;
        $skip = 0;
        $prevNilai = null;

        $data = $data->map(function ($peserta) use (&$currentRank, &$skip, &$prevNilai) {
            if ($peserta->benar !== $prevNilai) {
                $currentRank += $skip;
                $skip = 1;
                $prevNilai = $peserta->benar;
            } else {
                $skip++;
            }

            $peserta->ranking = $currentRank;
            return $peserta;
        });

        return view('exports.pendaftar', compact('data', 'jmlSoal'));
    }
    // public function view(): View
    // {
    //     $formasi = str_replace("\r", '', Kategori::find($this->id)->nama);

    //     if ($formasi == 'PERAWAT') {
    //         $listSoalTeknis = Soal::where('formasi', 'PERAWAT')->get();
    //         $soal = $listSoalTeknis;
    //     } elseif ($formasi == 'TEKNISI GAS MEDIS') {
    //         $listSoalUmum = Soal::where('jenis', 'UMUM')->take(40)->get();
    //         $listSoalTeknis = Soal::where('formasi', $formasi)->get();
    //         $soal = $listSoalUmum->concat($listSoalTeknis);
    //     } else {
    //         $listSoalUmum = Soal::where('jenis', 'UMUM')->get();
    //         $listSoalTeknis = Soal::where('formasi', $formasi)->get();
    //         $soal = $listSoalUmum->concat($listSoalTeknis);
    //     }


    //     $jmlSoal = $soal->count();

    //     $data = Kategori::with(['peserta.jawaban.soal'])->findOrFail($this->id)
    //         ->peserta->map(function ($peserta) {
    //             $jawaban = $peserta->jawaban;

    //             $peserta->dijawab = $jawaban->count();

    //             $peserta->benar = $jawaban->filter(function ($jawab) {
    //                 return $jawab->jawaban === optional($jawab->soal)->kunci;
    //             })->count();

    //             return $peserta;
    //         })->sortByDesc('benar');
    //     return view('exports.pendaftar', compact('data', 'jmlSoal'));
    // }
}
