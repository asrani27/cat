<?php

namespace App\Http\Controllers;

use App\Models\Waktu;
use Illuminate\Http\Request;

class WaktuController extends Controller
{
    public function index()
    {
        $data = Waktu::first();
        return view('superadmin.waktu.index',compact('data'));
    }

    public function update(Request $request)
    {
        $attr = $request->all();

        Waktu::first()->update($attr);

        toastr()->success('Sukses Di Update');
        return redirect('/superadmin/waktu');
    }
}
