<?php

namespace App\Http\Controllers;

use App\Models\Soal;
use App\Models\Kategori;
use Illuminate\Http\Request;

class SoalController extends Controller
{
    public function index()
    {
        $data = Soal::paginate(10);
        return view('superadmin.soal.index',compact('data'));
    }
    
    public function create()
    {
        $kategori = Kategori::get();
        return view('superadmin.soal.create',compact('kategori'));
    }
    
    public function store(Request $request)
    {
        Soal::create($request->all());
        
        toastr()->success('Sukses Di Simpan');
        return redirect('/superadmin/soal');
        
    }
    
    public function show($id)
    {
        //
    }
    
    public function edit($id)
    {
        $data = Soal::find($id);
        $kategori = Kategori::get();
        
        return view('superadmin.soal.edit',compact('data','kategori'));
    }
    
    public function update(Request $request, $id)
    {
        $attr = $request->all();

        Soal::find($id)->update($attr);

        toastr()->success('Sukses Di Update');
        return redirect('/superadmin/soal');
    }

    public function destroy($id)
    {
        Soal::find($id)->delete();
        toastr()->success('Sukses Di Hapus');
        return back();
    }
}
