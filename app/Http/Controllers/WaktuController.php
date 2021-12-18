<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Waktu;
use Illuminate\Http\Request;

class WaktuController extends Controller
{
    public function index()
    {
        $data = Waktu::first();
        $data->tanggal_mulai = Carbon::parse($data->tanggal_mulai)->format('Y-m-d\TH:i');
        $data->tanggal_selesai = Carbon::parse($data->tanggal_selesai)->format('Y-m-d\TH:i');
        //dd($data);
        return view('superadmin.waktu.index', compact('data'));
    }

    public function update(Request $request)
    {
        $attr = $request->all();
        $attr['tanggal_mulai'] = Carbon::parse($request->tanggal_mulai)->format('Y-m-d H:i:s');
        $attr['tanggal_selesai'] = Carbon::parse($request->tanggal_selesai)->format('Y-m-d H:i:s');
        if ($attr['tanggal_mulai'] > $attr['tanggal_selesai']) {
            toastr()->error('Tgl Mulai Tidak bisa lebih Dari Tgl Selesai');
            return back();
        } else {

            $jml_menit = Carbon::parse($request->tanggal_mulai)->diffInMinutes(Carbon::parse($request->tanggal_selesai));

            $attr['durasi'] = $jml_menit;
            Waktu::first()->update($attr);

            toastr()->success('Sukses Di Update');
            return redirect('/superadmin/waktu');
        }
    }
}
