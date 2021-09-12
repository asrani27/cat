<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KategoriController extends Controller
{
    
    public function index()
    {
        $data = Kategori::paginate(10);
        return view('superadmin.kategori.index',compact('data'));
    }
    
    public function create()
    {
        return view('superadmin.kategori.create');
    }
    
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' =>  'unique:kategori',
        ]);

        if ($validator->fails()) {
            $request->flash();
            toastr()->error('Kategori sudah ada');
            return back();
        }
        Kategori::create($request->all());
        
        toastr()->success('Sukses Di Simpan');
        return redirect('/superadmin/kategori');
        
    }
    
    public function show($id)
    {
        //
    }
    
    public function edit($id)
    {
        $data = Kategori::find($id);
        
        return view('superadmin.kategori.edit',compact('data'));
    }
    
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama' =>  'unique:kategori,nama,'.$id,
        ]);

        if ($validator->fails()) {
            $request->flash();
            toastr()->error('Kategori sudah ada');
            return back();
        }

        $attr = $request->all();

        Kategori::find($id)->update($attr);

        toastr()->success('Sukses Di Update');
        return redirect('/superadmin/kategori');
    }

    public function destroy($id)
    {
        Kategori::find($id)->delete();
        toastr()->success('Sukses Di Hapus');
        return back();
    }
}
