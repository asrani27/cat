<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Role;
use App\Models\Soal;
use App\Models\User;
use App\Models\Waktu;
use GuzzleHttp\Client;
use App\Models\Hotline;
use App\Models\Jawaban;
use App\Models\Peserta;
use App\Models\Kategori;
use App\Models\BenarSalah;
use Illuminate\Http\Request;
use App\Exports\PendaftarExport;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;

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
        $kategori   = Kategori::distinct('nama')->count('nama');
        $durasi     = Waktu::first()->durasi;

        $yangupload = Peserta::where('file', '!=', null)->get()->count();
        $datasoal = $this->soal();

        // $data = $this->datapeserta()->map(function ($item) use ($datasoal) {
        //     $jawaban = Jawaban::where('peserta_id', $item->id)->get();
        //     $item->dijawab = $jawaban->count();
        //     $item->benar = Jawaban::where('peserta_id', $item->id)
        //         ->get()->map(function ($item2) {
        //             if ($item2->jawaban == $item2->soal->kunci) {
        //                 $item2->benar = 'Y';
        //             } else {
        //                 $item2->benar = 'T';
        //             }
        //             return $item2;
        //         })->where('benar', 'Y')->count();

        //     return $item;
        // })->sortByDesc('benar');

        $formasi = Kategori::get();
        return view('superadmin.home', compact('peserta', 'soal', 'kategori', 'durasi', 'yangupload', 'formasi'));
    }

    public function delete($id_formasi, $id)
    {
        try {
            Peserta::find($id)->user->delete();
            Peserta::find($id)->delete();
            toastr()->success('Sukses Di Hapus');
            return back();
        } catch (\Exception $e) {
            toastr()->error('Gagal Di Hapus');
            return back();
        }
    }
    public function excel($id)
    {
        $filename = Kategori::find($id)->nama . '.xlsx';
        return Excel::download(new PendaftarExport($id), $filename);
    }
    // public function formasi($id)
    // {
    //     $formasi = str_replace("\r", '', Kategori::find($id)->nama);

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
    //     $data = Kategori::find($id)->peserta->map(function ($item) {
    //         $jawaban = Jawaban::where('peserta_id', $item->id)->get();
    //         $item->dijawab = $jawaban->count();
    //         $item->benar = Jawaban::where('peserta_id', $item->id)
    //             ->get()->map(function ($item2) {
    //                 if ($item2->jawaban == $item2->soal->kunci) {
    //                     $item2->benar = 'Y';
    //                 } else {
    //                     $item2->benar = 'T';
    //                 }
    //                 return $item2;
    //             })->where('benar', 'Y')->count();

    //         return $item;
    //     })->sortByDesc('benar');

    //     $formasi = Kategori::find($id);
    //     return view('superadmin.formasi', compact('data', 'formasi', 'jmlSoal'));
    // }
    public function formasi($id)
    {
        $kategori = Kategori::findOrFail($id);
        $formasiNama = str_replace("\r", '', $kategori->nama);

        // $soal = collect();
        // if ($formasiNama === 'PERAWAT') {
        //     $soal = Soal::where('formasi', 'PERAWAT')->get();
        // } else {
        //     $soalUmum = Soal::where('jenis', 'UMUM');
        //     if ($formasiNama === 'TEKNISI GAS MEDIS') {
        //         $soalUmum = $soalUmum->take(40);
        //     }
        //     $soal = $soalUmum->get()->merge(
        //         Soal::where('formasi', $formasiNama)->get()
        //     );
        // }

        // $jmlSoal = $soal->count();
        $jmlSoal = 60;
        $data = Peserta::where('kategori_id', $id)->get();
        // $data = $kategori->peserta->map(function ($peserta) {
        //     $jawaban = $peserta->jawaban;

        //     $dijawab = $jawaban->count();

        //     $benar = $jawaban->filter(function ($j) {
        //         return $j->jawaban === optional($j->soal)->kunci;
        //     })->count();

        //     $peserta->dijawab = $dijawab;
        //     $peserta->benar = $benar;

        //     return $peserta;
        // })->sortByDesc('benar');

        return view('superadmin.formasi', [
            'data' => $data,
            'formasi' => $kategori,
            'jmlSoal' => $jmlSoal
        ]);
    }

    public function editPeserta($formasi_id, $id)
    {
        $data = Peserta::find($id);

        return view('superadmin.peserta.edit', compact('data', 'formasi_id'));
    }
    public function updatePeserta(Request $request, $formasi_id, $id)
    {
        $validator = Validator::make($request->all(), [
            'nik' =>  'unique:peserta,nik,' . $id,
        ]);

        if ($validator->fails()) {
            $request->flash();
            toastr()->error('NIK sudah ada');
            return back();
        }

        $attr = $request->all();

        Peserta::find($id)->update($attr);

        toastr()->success('Sukses Di Update');
        return redirect('/superadmin/formasi/' . $formasi_id);
    }
    public function akun($formasi_id, $id)
    {
        $role = Role::where('name', 'peserta')->first();
        //Create User Peserta
        $peserta = Peserta::find($id);
        $n = new User;
        $n->name = $peserta->nama;
        $n->username = $peserta->nik;
        $n->password = bcrypt($peserta->tgl);
        $n->save();

        $n->roles()->attach($role);

        $peserta->update(['user_id' => $n->id]);

        toastr()->success('Akun sukses di buat, Password : ' . $peserta->telp);
        return back();
    }

    public function pass($formasi_id, $id)
    {
        $u = Peserta::find($id)->user;
        $u->password = bcrypt('112233');
        $u->save();

        toastr()->success('Password Baru : 112233');
        return back();
    }
    public function verify($formasi_id, $id)
    {
        $data = Peserta::find($id);

        return view('superadmin.peserta.verify', compact('data', 'formasi_id'));
    }

    public function updateStatus(Request $req, $formasi_id, $id)
    {
        $data = Peserta::find($id);
        $data->status_ujian = $req->status_ujian;
        $data->keterangan_ujian = $req->keterangan_ujian;
        $data->status_berkas = $req->status_berkas;
        $data->keterangan_berkas = $req->keterangan_berkas;
        $data->status_wawancara = $req->status_wawancara;
        $data->keterangan_wawancara = $req->keterangan_wawancara;
        $data->save();
        toastr()->success('Sukses Di Update');
        return back();
    }
    public function gantipass()
    {
        return view('superadmin.gantipass.index');
    }
    public function hotline()
    {
        $data = Hotline::first();
        return view('superadmin.hotline.index', compact('data'));
    }
    public function updateHotline(Request $req)
    {
        Hotline::first()->update(['nomor' => $req->nomor]);
        toastr()->success('Berhasil Di Ubah');
        return back();
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
        $waktu2      = Waktu::first();
        $jmlsoal    = count(json_decode($peserta->soal_acak));
        $jam        = Carbon::now()->format('H:i');
        $waktu      = $waktu2->durasi;

        $nomor_acak = json_decode($peserta->soal_acak);
        $soal = Soal::whereIn('id', $nomor_acak)->get();

        $soal = $soal->sortBy(function ($item) use ($nomor_acak) {
            return array_search($item->id, $nomor_acak);
        })->values();

        $jawabanPeserta = Jawaban::where('peserta_id', $peserta->id)->get()->keyBy('soal_id');

        $listSoal = $soal->map(function ($item) use ($jawabanPeserta) {
            $item->dijawab = $jawabanPeserta[$item->id]->jawaban ?? false;
            return $item;
        });

        $jmlbelumjawab = $listSoal->where('dijawab', false)->count();


        //check selesai ujian
        if ($peserta->selesai_ujian == 1) {
            //hitung skor Benar
            // $skor1 = Jawaban::where('peserta_id', $peserta->id)
            //     ->whereHas('soal', function ($query) {
            //         $query->whereColumn('jawaban', 'kunci');
            //     })->get();

            $skor = Jawaban::where('peserta_id', $peserta->id)
                ->get()->map(function ($item2) {
                    if ($item2->jawaban == $item2->soal->kunci) {
                        $item2->benar = 'Y';
                    } else {
                        $item2->benar = 'T';
                    }
                    return $item2;
                })->where('benar', 'Y')->count();

            return view('peserta.selesai', compact('jmlsoal', 'jam', 'waktu', 'peserta', 'jmlbelumjawab', 'skor', 'listSoal'));
        } else {

            $mulai     = $waktu2->tanggal_mulai;
            $selesai   = $waktu2->tanggal_selesai;
            $check     = Carbon::now()->between($mulai, $selesai);
            $now       = Carbon::now();

            if ($now <= Carbon::parse($waktu2->tanggal_mulai)) {
                return view('peserta.start', compact('jmlsoal', 'jam', 'waktu', 'peserta', 'jmlbelumjawab', 'mulai', 'selesai', 'listSoal'));
            } elseif ($now > $waktu2->tanggal_selesai) {
                //hitung skor Benar
                $skor = Jawaban::where('peserta_id', $peserta->id)
                    ->whereHas('soal', function ($query) {
                        $query->whereColumn('jawaban', 'kunci');
                    })->count();
                return view('peserta.selesai', compact('jmlsoal', 'jam', 'waktu', 'peserta', 'jmlbelumjawab', 'skor', 'listSoal'));
            } elseif ($peserta->file == null) {
                toastr()->error('Berkas Belum Di upload');
                return view('peserta.start', compact('jmlsoal', 'jam', 'waktu', 'peserta', 'jmlbelumjawab', 'mulai', 'selesai', 'listSoal'));
            } else {

                return redirect('/peserta/ujian/soal/' . $soal->first()->id);
            }
        }
    }

    public function testapi()
    {
        $token = null;
        $data = [];
        return view('testapi', compact('token', 'data'));
    }

    public function gettoken(Request $req)
    {
        $client = new Client(['base_uri' => 'http://cat.asrandev.com/api/']);
        $response = $client->request('POST', 'login', [
            'form_params' => [
                'username' => $req->username,
                'password' => $req->password,
            ]
        ]);
        $resp = json_decode($response->getBody()->getContents());

        $token = $resp->api_token;
        $req->flash();
        $data = [];
        return view('testapi', compact('token', 'data'));
    }

    public function getnilai(Request $req)
    {
        $token = $req->token;
        $client = new Client(['base_uri' => 'http://cat.asrandev.com/api/']);
        $headers = [
            'Authorization' => 'Bearer ' . $token,
            'Accept'        => 'application/json',
        ];
        //get Profile
        $profile = $client->request('GET', 'profile', [
            'headers' => $headers
        ]);
        $resp_profile = json_decode($profile->getBody()->getContents())->data;

        //get kunci
        $kunci = $client->request('GET', 'kunci', [
            'headers' => $headers
        ]);
        $resp_kunci = json_decode($kunci->getBody()->getContents())->data;

        //get jawabanku
        $jawaban = $client->request('GET', 'jawabanku', [
            'headers' => $headers
        ]);
        $resp_jawaban = json_decode($jawaban->getBody()->getContents())->data;

        $data = collect($resp_kunci)->map(function ($item) use ($resp_jawaban) {
            if (collect($resp_jawaban)->where('soal_id', $item->id)->first() == null) {
                $item->jawabanku = null;
            } else {
                $item->jawabanku = collect($resp_jawaban)->where('soal_id', $item->id)->first()->jawaban;
            }
            return $item;
        });

        return view('testapi', compact('token', 'data'));
    }
}
