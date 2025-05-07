<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Role;
use App\Models\User;
use GuzzleHttp\Client;
use App\Models\Peserta;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $req)
    {
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
        $start = '2025-05-19';
        if ($today < $start) {
            toastr()->error('Pendaftaran Di Buka Pada Tanggal 19 Mei 2025');
            return back();
        } else {

            $role = Role::where('name', 'peserta')->first();
            if ($req->password == $req->confimation_password) {

                if (User::where('username', $req->nik)->first() == null) {
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
                    $peserta->kampus = $req->kampus;
                    $peserta->tahun_lulus = $req->tahun_lulus;
                    $peserta->jurusan = $req->jurusan;
                    $peserta->user_id = $user->id;
                    $peserta->telp = $req->telp;
                    $peserta->kategori_id = $req->kategori_id;
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
