<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Soal;
use App\Models\Waktu;
use App\Models\Jawaban;
use App\Models\Peserta;
use App\Models\Kategori;
use App\Models\BenarSalah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function datapeserta()
    {
        return Peserta::get();
    }

    public function superadmin()
    {
        $peserta    = $this->datapeserta()->count();
        $soal       = $this->soal()->count();
        $kategori   = Kategori::get()->count();
        $durasi     = Waktu::first()->durasi;

        $yangupload = Peserta::where('file', '!=', null)->get()->count();
        $datasoal = $this->soal();

        $data = $this->datapeserta()->map(function ($item) use ($datasoal) {
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

        return view('superadmin.home', compact('peserta', 'soal', 'kategori', 'durasi', 'data', 'yangupload'));
    }

    public function gantipass()
    {
        return view('superadmin.gantipass.index');
    }

    public function resetpass(Request $req)
    {
        if ($req->password1 == $req->password2) {
            $u = Auth::user();
            $u->password = bcrypt($req->password1);
            $u->save();

            Auth::logout();
            toastr()->success('Berhasil Di Ubah, Login Dengan Password Baru');
            return redirect('/');
        } else {
            toastr()->error('Password Tidak Sama');
            return back();
        }
    }

    public function soal()
    {
        return Soal::get();
    }

    public function peserta()
    {
        $peserta    = Auth::user()->peserta;

        $jmlsoal    = $this->soal()->count();
        $jam        = Carbon::now()->format('H:i');
        $waktu      = Waktu::first()->durasi;

        $listSoal   = $this->soal()->map(function ($item) use ($peserta) {
            $check = Jawaban::where('peserta_id', $peserta->id)->where('soal_id', $item->id)->first();
            if ($check == null) {
                $item->dijawab = false;
            } else {
                $item->dijawab = $check->jawaban;
            }
            return $item;
        });
        $jmlbelumjawab = $listSoal->where('dijawab', false)->count();

        //hitung skor Benar
        $skor = Jawaban::where('peserta_id', $peserta->id)
            ->get()->map(function ($item2) {
                if ($item2->jawaban == $item2->soal->kunci) {
                    $item2->benar = 'Y';
                } else {
                    $item2->benar = 'T';
                }
                return $item2;
            })->where('benar', 'Y')->count();

        //check selesai ujian
        if ($peserta->selesai_ujian == 1) {
            return view('peserta.selesai', compact('jmlsoal', 'jam', 'waktu', 'peserta', 'jmlbelumjawab', 'skor'));
        } else {

            $mulai     = Waktu::first()->tanggal_mulai;
            $selesai   = Waktu::first()->tanggal_selesai;
            $check     = Carbon::now()->between($mulai, $selesai);
            $now       = Carbon::now();

            if ($now < Carbon::parse(Waktu::first()->tanggal_mulai)) {
                return view('peserta.start', compact('jmlsoal', 'jam', 'waktu', 'peserta', 'jmlbelumjawab', 'mulai', 'selesai'));
            } elseif ($now > Waktu::first()->tanggal_selesai) {
                return view('peserta.selesai', compact('jmlsoal', 'jam', 'waktu', 'peserta', 'jmlbelumjawab', 'skor'));
            } else {
                $soalPertama = Soal::first()->id;
                return redirect('/peserta/ujian/soal/' . $soalPertama);
            }
        }
    }
}
