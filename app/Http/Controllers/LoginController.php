<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use GuzzleHttp\Client;
use App\Models\Peserta;
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
        return view('daftar');
    }

    public function simpanDaftar(Request $req)
    {
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
                $peserta->telp = $req->telp;
                $peserta->user_id = $user->id;
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
