<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Role;
use App\Models\Soal;
use App\Models\User;
use GuzzleHttp\Client;
use App\Models\Peserta;
use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Models\WaktuPendaftaran;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class LoginController extends Controller
{
    public function login(Request $req)
    {
        $req->validate([
            'cf-turnstile-response' => 'required',
        ]);

        $response = Http::asForm()->post('https://challenges.cloudflare.com/turnstile/v0/siteverify', [
            'secret' => config('services.turnstile_secret_key'),
            'response' => $req->input('cf-turnstile-response'),
            'remoteip' => $req->ip(),
        ]);
        dd($response->json(), config('services.turnstile_site_key'), config('services.turnstile_secret_key'));
        if (!($response->json()['success'] ?? false)) {
            toastr()->error('checklist captcha');
            return back();
        }

        if (Auth::attempt(['username' => $req->username, 'password' => $req->password], true)) {
            if (Auth::user()->hasRole('superadmin')) {
                return redirect('/home/superadmin');
            } else {
                return redirect('/home/peserta');
            }
        } else {
            toastr()->error('Username / Password Tidak Ditemukan');
            $req->flash();
            return back();
        }
    }

    public function daftar()
    {
        $formasi = Kategori::get();
        return view('daftar', compact('formasi'));
    }

    public function simpanDaftar(Request $req)
    {
        $today = Carbon::now()->format('Y-m-d');
        $start = WaktuPendaftaran::first()->mulai;
        if ($today < $start) {
            toastr()->error('Pendaftaran Di Buka Pada Tanggal' . Carbon::parse($start)->translatedFormat('d F Y'));
            return back();
        } else {

            $role = Role::where('name', 'peserta')->first();
            if ($req->password == $req->confimation_password) {

                if (User::where('username', $req->nik)->first() == null) {

                    $formasi = str_replace("\r", '', Kategori::find($req->kategori_id)->nama);

                    if ($formasi == 'PERAWAT') {
                        $listSoalTeknis = Soal::where('formasi', 'PERAWAT')->get();
                        $listSoal = $listSoalTeknis;
                    } elseif ($formasi == 'TEKNISI GAS MEDIS') {
                        $listSoalUmum = Soal::where('jenis', 'UMUM')->take(40)->get();
                        $listSoalTeknis = Soal::where('formasi', $formasi)->get();
                        $listSoal = $listSoalUmum->concat($listSoalTeknis);
                    } else {
                        $listSoalUmum = Soal::where('jenis', 'UMUM')->get();
                        $listSoalTeknis = Soal::where('formasi', $formasi)->get();
                        $listSoal = $listSoalUmum->concat($listSoalTeknis);
                    }

                    // Ambil ID, acak, lalu ubah ke array
                    $acakId = $listSoal->pluck('id')->shuffle()->values()->all();

                    // Ubah ke JSON
                    $jsonId = json_encode($acakId);

                    $user = new User;
                    $user->name = $req->nama;
                    $user->username = $req->nik;
                    $user->password = bcrypt($req->password);
                    $user->save();

                    $user->roles()->attach($role);

                    $peserta = new Peserta;
                    $peserta->nik = $req->nik;
                    $peserta->nama = $req->nama;
                    $peserta->email = $req->email;
                    $peserta->user_id = $user->id;
                    $peserta->telp = $req->telp;
                    $peserta->kategori_id = $req->kategori_id;
                    $peserta->soal_acak = $jsonId;

                    $peserta->save();

                    toastr()->success('Berhasil Di Simpan');
                    Auth::login($user);
                    return redirect('/');
                } else {
                    toastr()->error('NIK sudah digunakan');
                }
            } else {
                toastr()->error('Password Tidak Sama');
            }
            $req->flash();
            return back();
        }
    }
}
