<?php

namespace App\Http\Controllers\API;

use App\Models\Soal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function soal_kunci()
    {
        $soal = Soal::get(['id', 'kunci']);
        $data['message_error'] = 200;
        $data['message']       = 'Data Ditemukan';
        $data['data']          = $soal;

        return response()->json($data);
    }

    public function profile()
    {
        $data['message_error'] = 200;
        $data['message']       = 'Data Ditemukan';
        $data['data']          = Auth::user()->peserta;
        return response()->json($data);
    }

    public function jawabanku()
    {
        $jawaban = Auth::user()->peserta->jawaban;
        $data['message_error'] = 200;
        $data['message']       = 'Data Ditemukan';
        $data['data']          = $jawaban;

        return response()->json($data);
    }

    public function login(Request $req)
    {
        //return response()->json('test');
        if ($req->username == null || $req->password == null) {
            $data['message_error'] = 101;
            $data['message']       = 'username atau password kosong';
            $data['api_token']     = null;
            return response()->json($data);
        } else {
            if (Auth::attempt(['username' => $req->username, 'password' => $req->password])) {

                $user = Auth::user();
                if ($user->tokens()->first() == null) {
                    $token = $user->createToken('myapptoken')->plainTextToken;
                } else {
                    $user->tokens()->delete();
                    $token = $user->createToken('myapptoken')->plainTextToken;
                }

                $data['message_error'] = 200;
                $data['message']       = 'Auth Berhasil';
                $data['api_token']     = $token;
                return response()->json($data);
            } else {
                $data['message_error'] = 201;
                $data['message']       = 'username atau password anda tidak ditemukan';
                $data['api_token']          = null;
                return response()->json($data);
            }
        }
    }

    public function ceklogin(Request $req)
    {
        return response()->json('test');
    }
}
