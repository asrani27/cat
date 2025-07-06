<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Soal;
use App\Models\Waktu;
use App\Models\Jawaban;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UjianController extends Controller
{
    public function peserta()
    {
        return Auth::user()->peserta;
    }

    public function selesai()
    {
        $peserta = $this->peserta();
        $peserta->update(['selesai_ujian' => 1]);
        return redirect('/home/peserta');
    }

    public function mulai()
    {
        $now = Carbon::now();
        $tgl_mulai = Waktu::first()->tanggal_mulai;
        $tgl_selesai = Waktu::first()->tanggal_selesai;
        $peserta    = $this->peserta();

        $nomor_acak = json_decode($peserta->soal_acak);
        $soal = Soal::whereIn('id', $nomor_acak)->get();

        $soal = $soal->sortBy(function ($item) use ($nomor_acak) {
            return array_search($item->id, $nomor_acak);
        })->values();


        if ($peserta->test == 1) {
            $soalPertama = $soal->first()->id;
            return redirect('/peserta/ujian/soal/' . $soalPertama);
        } else {
            if ($now <= $tgl_mulai) {
                toastr()->info('Ujian Belum dimulai');
                return back();
            } else {
                if ($peserta->file == null) {
                    toastr()->info('Harap Upload Berkas Anda');
                    return back();
                } else {
                    $soalPertama = $soal->first()->id;
                    return redirect('/peserta/ujian/soal/' . $soalPertama);
                }
            }
        }
    }

    public function soalUjian()
    {
        return Soal::get();
    }

    public function next($id)
    {

        $nomor_acak = json_decode(Auth::user()->peserta->soal_acak);
        $current_index = array_search($id, $nomor_acak);

        $next_soal = null;
        if ($current_index !== false) {
            $next_index = $current_index + 1;

            if (isset($nomor_acak[$next_index])) {
                $next_soal = $nomor_acak[$next_index];
            } else {
                // Jika sudah di soal terakhir, kembali ke soal pertama
                $next_soal = $nomor_acak[0];
            }
        }
        return $next_soal;
    }

    public function soal($id)
    {
        $peserta    = $this->peserta();

        $now = Carbon::now();
        $waktu = Waktu::first();
        $tgl_mulai = $waktu->tanggal_mulai;
        $tgl_selesai = $waktu->tanggal_selesai;

        $mulai     = $tgl_mulai;
        $selesai   = $tgl_selesai;
        if ($peserta->test == 1) {

            $jam        = Carbon::now()->format('H:i');
            $waktu      = $waktu->durasi;
            $soal       = Soal::find($id);
            $next       = $this->next($id);

            $nomor_acak = json_decode($peserta->soal_acak);

            if (!in_array($id, $nomor_acak)) {
                toastr()->error('ID tersebut bukan soal untuk anda');
                return back();
            }
            $daftarsoal = Soal::whereIn('id', $nomor_acak)->get();

            $listSoal = $daftarsoal->sortBy(function ($item) use ($nomor_acak) {
                return array_search($item->id, $nomor_acak);
            })->values()->map(function ($item) use ($peserta) {
                $check = Jawaban::where('peserta_id', $peserta->id)->where('soal_id', $item->id)->first();
                if ($check == null) {
                    $item->dijawab = false;
                } else {
                    $item->dijawab = $check->jawaban;
                }
                return $item;
            });


            $jmlsoal    = $listSoal->count();
            $jmlbelumjawab = $listSoal->where('dijawab', false)->count();

            $dijawab    = Jawaban::where('peserta_id', $peserta->id)->where('soal_id', $id)->first();

            return view('peserta.home', compact('jam', 'waktu', 'peserta', 'tgl_mulai', 'tgl_selesai', 'listSoal', 'soal', 'next', 'dijawab', 'jmlsoal', 'jmlbelumjawab'));
        } else {

            $random     = 'random' . substr($peserta->telp, -1);

            if ($peserta->selesai_ujian == 1) {
                return redirect('home/peserta');
            } else {
                $now = Carbon::now();
                $tgl_mulai = $waktu->tanggal_mulai;
                $tgl_selesai = $waktu->tanggal_selesai;

                $mulai     = $tgl_mulai;
                $selesai   = $tgl_selesai;
                $check     = Carbon::now()->between($mulai, $selesai);

                if ($check) {

                    $nomor_acak = json_decode($peserta->soal_acak);

                    if (!in_array($id, $nomor_acak)) {
                        toastr()->error('ID tersebut bukan soal untuk anda');
                        return back();
                    }
                    $daftarsoal = Soal::whereIn('id', $nomor_acak)->get();

                    // Ambil semua jawaban peserta dalam satu query, dan buat keyed by soal_id
                    $jawabanPeserta = Jawaban::where('peserta_id', $peserta->id)->get()->keyBy('soal_id');

                    // Urutkan $daftarsoal berdasarkan $nomor_acak
                    $sortedSoal = $daftarsoal->sortBy(function ($item) use ($nomor_acak) {
                        return array_search($item->id, $nomor_acak);
                    })->values();

                    // Mapping soal dengan jawaban
                    $listSoal = $sortedSoal->map(function ($item) use ($jawabanPeserta) {
                        $item->dijawab = $jawabanPeserta[$item->id]->jawaban ?? false;
                        return $item;
                    });

                    // $listSoal = $daftarsoal->sortBy(function ($item) use ($nomor_acak) {
                    //     return array_search($item->id, $nomor_acak);
                    // })->values()->map(function ($item) use ($peserta) {
                    //     $check = Jawaban::where('peserta_id', $peserta->id)->where('soal_id', $item->id)->first();
                    //     if ($check == null) {
                    //         $item->dijawab = false;
                    //     } else {
                    //         $item->dijawab = $check->jawaban;
                    //     }
                    //     return $item;
                    // });


                    // $jmlsoal    = $listSoal->count();
                    $jam        = Carbon::now()->format('H:i');
                    $waktu      = $waktu->durasi;

                    $soal       = Soal::find($id);

                    $current_index = array_search($id, $nomor_acak);

                    $next = null;
                    if ($current_index !== false) {
                        $next_index = $current_index + 1;

                        if (isset($nomor_acak[$next_index])) {
                            $next = $nomor_acak[$next_index];
                        } else {
                            // Jika sudah di soal terakhir, kembali ke soal pertama
                            $next = $nomor_acak[0];
                        }
                    }

                    // $jmlbelumjawab = $listSoal->where('dijawab', false)->count();

                    $dijawab    = Jawaban::where('peserta_id', $peserta->id)->where('soal_id', $id)->first();

                    return view('peserta.home', compact('jam', 'waktu', 'peserta', 'tgl_mulai', 'tgl_selesai', 'listSoal', 'soal', 'next', 'dijawab'));
                } else {
                    return redirect('/home/peserta');
                }
            }
        }
    }

    public function simpan(Request $req)
    {
        if ($req->jawaban == null) {
            toastr()->error('Harap Pilih Jawaban Anda');
            return back();
        } else {
            $check = Jawaban::where('peserta_id', $this->peserta()->id)->where('soal_id', $req->soal_id)->first();
            if ($check == null) {
                $new = new Jawaban;
                $new->peserta_id = $this->peserta()->id;
                $new->soal_id = $req->soal_id;
                $new->jawaban = $req->jawaban;
                $new->save();
                return redirect('/peserta/ujian/soal/' . $this->next($req->soal_id));
            } else {

                $check->update(['jawaban' => $req->jawaban]);
                return redirect('/peserta/ujian/soal/' . $this->next($req->soal_id));
            }
        }
    }

    public function soal2()
    {
        return Soal::get();
    }

    public function sesi2()
    {
        $peserta    = Auth::user()->peserta;

        $jmlsoal    = $this->soal2()->count();
        $jam        = Carbon::now()->format('H:i');
        $waktu      = Waktu::first()->durasi;

        $listSoal   = $this->soal2()->map(function ($item) use ($peserta) {
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

        // //check selesai ujian
        // if ($peserta->selesai_ujian == 1) {
        //     return view('peserta.selesai', compact('jmlsoal', 'jam', 'waktu', 'peserta', 'jmlbelumjawab', 'skor'));
        // } else {

        //     $mulai     = Waktu::first()->tanggal_mulai;
        //     $selesai   = Waktu::first()->tanggal_selesai;
        //     $check     = Carbon::now()->between($mulai, $selesai);
        //     $now       = Carbon::now();

        //     if ($now < Carbon::parse(Waktu::first()->tanggal_mulai)) {
        //         return view('peserta.start', compact('jmlsoal', 'jam', 'waktu', 'peserta', 'jmlbelumjawab', 'mulai', 'selesai'));
        //     } elseif ($now > Waktu::first()->tanggal_selesai) {
        //         return view('peserta.selesai', compact('jmlsoal', 'jam', 'waktu', 'peserta', 'jmlbelumjawab', 'skor'));
        //     } else {
        //         $soalPertama = Soal::first()->id;
        //         return redirect('/peserta/ujian/soal/' . $soalPertama);
        //     }
        // }
        if ($jmlbelumjawab == 50) {
            toastr()->info('Tidak bisa melanjutkan kesesi ke 2 karena tidak mengikuti / menjawab soal sesi pertama');
            return redirect('/home/peserta');
        } else {
            return view('peserta.sesi2', compact('jmlsoal', 'jam', 'waktu', 'peserta', 'jmlbelumjawab', 'skor'));
        }
    }

    public function simpansesi2(Request $req)
    {
        Auth::user()->peserta->update(['github' => $req->github]);
        toastr()->success('Berhasil Di Simpan');
        return back();
    }
}
