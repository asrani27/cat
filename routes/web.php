<?php

use App\Models\Soal;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SoalController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UjianController;
use App\Http\Controllers\WaktuController;
use App\Http\Controllers\PesertaController;
use App\Http\Controllers\KategoriController;

Route::get('/', function () {
    if (Auth::check()) {
        if (Auth::user()->hasRole('superadmin')) {
            return redirect('/home/superadmin');
        } elseif (Auth::user()->hasRole('peserta')) {
            return redirect('/home/peserta');
        }
    }
    return view('welcome');
});

Route::get('/logout', function () {
    Auth::logout();
    return redirect('/');
});

Route::get('/generate', function () {

    // $hasil = array();
    // $total = 100;
    // $x = 0;
    // do {
    //     $angka_random = rand(1, 100);
    //     if (!in_array($angka_random, $hasil)) {
    //         array_push($hasil, $angka_random);
    //         $x++;
    //     };
    // } while ($x < $total);

    // $soal =  Soal::get();
    // foreach ($soal as $key => $item) {
    //     $item->update(['random0' => $hasil[$key]]);
    // }
    return 'sukses';
});

Route::get('/login', function () {
    if (Auth::check()) {
        return redirect('/');
    }
    return view('welcome');
})->name('login');

Route::post('/login', [LoginController::class, 'login']);

// Route::get('/daftar', function () {
//     return redirect('/');
// });
Route::get('/daftar', [LoginController::class, 'daftar']);
Route::post('/daftar', [LoginController::class, 'simpanDaftar']);

Route::group(['middleware' => ['auth', 'role:superadmin']], function () {
    Route::prefix('superadmin')->group(function () {
        Route::get('gantipass', [HomeController::class, 'gantipass']);
        Route::post('gantipass', [HomeController::class, 'resetpass']);
        Route::get('peserta/{id}/akun', [PesertaController::class, 'akun']);
        Route::get('peserta/{id}/pass', [PesertaController::class, 'pass']);
        Route::resource('peserta', PesertaController::class);
        Route::resource('waktu', WaktuController::class);
        Route::resource('kategori', KategoriController::class);
        Route::resource('soal', SoalController::class);
    });
});

Route::group(['middleware' => ['auth', 'role:peserta']], function () {
    Route::post('home/peserta/upload', [PesertaController::class, 'upload']);
    Route::post('home/peserta/uploadlagi', [PesertaController::class, 'uploadlagi']);
    Route::get('home/peserta/gantipass', [PesertaController::class, 'gantipass']);
    Route::post('home/peserta/gantipass', [PesertaController::class, 'updatepass']);
    Route::get('home/peserta/lihatdata', [PesertaController::class, 'lihatdata']);
    Route::get('peserta/mulai', [UjianController::class, 'mulai']);
    Route::get('peserta/ujian/soal/{id}', [UjianController::class, 'soal']);
    Route::get('peserta/ujian/sesi2', [UjianController::class, 'sesi2']);
    Route::get('peserta/ujian/random/{id}', [UjianController::class, 'random']);
    Route::post('simpanjawaban', [UjianController::class, 'simpan']);
    Route::get('selesaiujian', [UjianController::class, 'selesai']);
});


Route::group(['middleware' => ['auth', 'role:superadmin|peserta']], function () {
    Route::get('/home/superadmin', [HomeController::class, 'superadmin']);
    Route::get('/home/peserta', [HomeController::class, 'peserta']);
});
