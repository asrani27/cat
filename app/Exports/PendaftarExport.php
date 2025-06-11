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
            $listSoalTeknis = Soal::where('formasi', 'PERAWAT')->get();
            $soal = $listSoalTeknis;
        } elseif ($formasi == 'TEKNISI GAS MEDIS') {
            $listSoalUmum = Soal::where('jenis', 'UMUM')->take(40)->get();
            $listSoalTeknis = Soal::where('formasi', $formasi)->get();
            $soal = $listSoalUmum->concat($listSoalTeknis);
        } else {
            $listSoalUmum = Soal::where('jenis', 'UMUM')->get();
            $listSoalTeknis = Soal::where('formasi', $formasi)->get();
            $soal = $listSoalUmum->concat($listSoalTeknis);
        }


        $jmlSoal = $soal->count();
        $data = Kategori::find($this->id)->peserta->map(function ($item) {
            $jawaban = Jawaban::where('peserta_id', $item->id)->get();
            $item->dijawab = $jawaban->count();
            $item->benar = Jawaban::where('peserta_id', $item->id)
                ->get()->map(function ($item2) {
                    if ($item2->jawaban == $item2->soal->kunci) {
                        $item2->benar = 'Y';
                    } else {
                        $item2->benar = 'T';
                    }
                    return $item2;
                })->where('benar', 'Y')->count();

            return $item;
        })->sortByDesc('benar');
        return view('exports.pendaftar', compact('data', 'jmlSoal'));
    }
}
