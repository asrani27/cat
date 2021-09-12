<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Peserta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PesertaController extends Controller
{
    public function index()
    {
        $data = Peserta::paginate(10);
        return view('superadmin.peserta.index',compact('data'));
    }
    
    public function create()
    {
        return view('superadmin.peserta.create');
    }
    
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nik' =>  'unique:peserta|numeric',
        ]);

        if ($validator->fails()) {
            $request->flash();
            toastr()->error('NIK sudah ada');
            return back();
        }

        Peserta::create($request->all());
        
        toastr()->success('Sukses Di Simpan');
        return redirect('/superadmin/peserta');
        
    }
    
    public function show($id)
    {
        //
    }
    
    public function edit($id)
    {
        $data = Peserta::find($id);
        
        return view('superadmin.peserta.edit',compact('data'));
    }
    
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nik' =>  'unique:peserta,nik,'.$id,
        ]);

        if ($validator->fails()) {
            $request->flash();
            toastr()->error('NIK sudah ada');
            return back();
        }

        $attr = $request->all();

        Peserta::find($id)->update($attr);

        toastr()->success('Sukses Di Update');
        return redirect('/superadmin/peserta');
    }

    public function destroy($id)
    {
        Peserta::find($id)->delete();
        toastr()->success('Sukses Di Hapus');
        return back();
    }

    public function akun($id)
    {
        $role = Role::where('name', 'peserta')->first();
        //Create User Peserta
        $peserta = Peserta::find($id);
        $n = new User;
        $n->name = $peserta->nama;
        $n->username = $peserta->nik;
        $n->password = bcrypt($peserta->telp);
        $n->save();

        $n->roles()->attach($role);

        $peserta->update(['user_id' => $n->id]);

        toastr()->success('Akun sukses di buat, Password : '. $peserta->telp);
        return back();
    }

    public function pass($id)
    {
        $u = Peserta::find($id)->user;
        $u->password = bcrypt(Peserta::find($id)->telp);
        $u->save();
        
        toastr()->success('Password Baru : '. Peserta::find($id)->telp);
        return back();
    }
}
