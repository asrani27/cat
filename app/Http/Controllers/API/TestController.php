<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Jawaban;
use App\Models\Soal;
use App\Models\User;
use App\Models\Waktu;
use Carbon\Carbon;

class TestController extends Controller
{

    function getPeserta($user_id) {
        return User::find($user_id)->peserta;
    }

    public function getListUser() {
        $take = request()->take ?? 10;
        return User::whereHas('peserta', function($query) {
            $query->whereNotNull('soal_acak');
        })
        ->take($take)
        ->pluck('id');
    }

    function getSemuaSoalPeserta($user_id) {
        $soal_ids = $this->getPeserta($user_id)->soal_acak;
        // Decode if it's a JSON string, otherwise use as-is
        $decoded_ids = is_string($soal_ids) ? json_decode($soal_ids) : $soal_ids;

        return response()->json($decoded_ids);
    }

    public function soal(int $user_id, int $soal_id)
    {
        $peserta    = $this->getPeserta($user_id);

        $now = Carbon::now();
        $tgl_mulai = Waktu::first()->tanggal_mulai;
        $tgl_selesai = Waktu::first()->tanggal_selesai;

        $mulai     = $tgl_mulai;
        $selesai   = $tgl_selesai;
        if ($peserta->test == 1) {

            $jam        = Carbon::now()->format('H:i');
            $waktu      = Waktu::first()->durasi;
            $soal       = Soal::find($soal_id);
            $next       = $this->next($soal_id);

            $nomor_acak = json_decode($peserta->soal_acak);

            if (!in_array($soal_id, $nomor_acak)) {
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

            $dijawab    = Jawaban::where('peserta_id', $peserta->id)->where('soal_id', $soal_id)->first();

            // return view('peserta.home', compact('jmlsoal', 'jam', 'waktu', 'peserta', 'tgl_mulai', 'tgl_selesai', 'listSoal', 'soal', 'next', 'dijawab', 'jmlbelumjawab'));
            return response()->json(null, 403);
        } else {

            $random     = 'random' . substr($peserta->telp, -1);

            if ($peserta->selesai_ujian == 1) {
                return redirect('home/peserta');
            } else {
                $now = Carbon::now();
                $tgl_mulai = Waktu::first()->tanggal_mulai;
                $tgl_selesai = Waktu::first()->tanggal_selesai;

                $mulai     = $tgl_mulai;
                $selesai   = $tgl_selesai;
                $check     = Carbon::now()->between($mulai, $selesai);

                // if ($check) {
                if (true) {
                    $nomor_acak = json_decode($peserta->soal_acak);

                    if (!in_array($soal_id, $nomor_acak)) {
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
                    $jam        = Carbon::now()->format('H:i');
                    $waktu      = Waktu::first()->durasi;

                    $soal       = Soal::find($soal_id);

                    $current_index = array_search($soal_id, $nomor_acak);

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

                    $jmlbelumjawab = $listSoal->where('dijawab', false)->count();

                    $dijawab    = Jawaban::where('peserta_id', $peserta->id)->where('soal_id', $soal_id)->first();

                    // return view('peserta.home', compact('jmlsoal', 'jam', 'waktu', 'peserta', 'tgl_mulai', 'tgl_selesai', 'listSoal', 'soal', 'next', 'dijawab', 'jmlbelumjawab'));
                    // return response()->json(compact('jmlsoal', 'jam', 'waktu', 'peserta', 'tgl_mulai', 'tgl_selesai', 'listSoal', 'soal', 'next', 'dijawab', 'jmlbelumjawab'));
                    return response()->json($soal);
                } else {
                    return response()->json([
                        'message' => 'Ujian sudah selesai'
                    ]);
                }
            }
        }
    }
}
