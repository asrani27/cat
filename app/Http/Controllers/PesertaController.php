<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Role;
use App\Models\Soal;
use App\Models\User;
use App\Models\Waktu;
use App\Models\Jawaban;
use App\Models\Peserta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PesertaController extends Controller
{
    public function index()
    {
        $data = Peserta::get();
        return view('superadmin.peserta.index', compact('data'));
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

        return view('superadmin.peserta.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nik' =>  'unique:peserta,nik,' . $id,
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
        $n->password = bcrypt($peserta->tgl);
        $n->save();

        $n->roles()->attach($role);

        $peserta->update(['user_id' => $n->id]);

        toastr()->success('Akun sukses di buat, Password : ' . $peserta->telp);
        return back();
    }

    public function pass($id)
    {
        $u = Peserta::find($id)->user;
        $u->password = bcrypt('112233');
        $u->save();

        toastr()->success('Password Baru : 112233');
        return back();
    }

    public function upload(Request $req)
    {

        $validator = Validator::make($req->all(), [
            'file' => 'mimes:zip,rar|max:10000'
        ]);

        if ($validator->fails()) {
            toastr()->error('File Harus Berupa zip/rar dan Maks 10MB');
            return back();
        }

        if ($req->hasFile('file')) {
            $filename = $req->file->getClientOriginalName();
            $filename = date('d-m-Y-') . rand(1, 9999) . $filename;
            $req->file->storeAs('/public/peserta', $filename);
            $attr['file'] = $filename;
        } else {
            $attr['file'] = null;
        }

        Auth::user()->peserta->update([
            'kampus' => $req->kampus,
            'jurusan' => $req->jurusan,
            'tahun_lulus' => $req->tahun_lulus,
            'tgl' => $req->tgl,
            'file' => $filename
        ]);

        toastr()->success('Berhasil DiSimpan');
        return back();
    }

    public function soal()
    {
        return Soal::get();
    }

    public function lihatdata()
    {
        $peserta = Auth::user()->peserta;


        $jmlsoal    = $this->soal()->count();
        $jam        = Carbon::now()->format('H:i');
        $waktu      = Waktu::first()->durasi;

        $listSoal   = $this->soal()->map(function ($item) use ($peserta) {
            $check = Jawaban::where('peserta_id', $peserta->id)->where('soal_id', $item->id)->first();
            if ($check == null) {
                $item->dijawab = false;
            } else {
                $item->dijawab = $check->jawaban;
            }
            return $item;
        });
        $jmlbelumjawab = $listSoal->where('dijawab', false)->count();
        return view('peserta.lihatdata', compact('peserta', 'waktu', 'jam', 'jmlsoal', 'listSoal', 'jmlbelumjawab'));
    }

    public function uploadlagi(Request $req)
    {
        if ($req->file == null) {
            //simpan tanpa file
            Auth::user()->peserta->update([
                'nik' => $req->nik,
                'nama' => $req->nama,
                'telp' => $req->telp,
                'tgl' => $req->tgl,
                'kampus' => $req->kampus,
                'email' => $req->email,
                'tahun_lulus' => $req->tahun_lulus,
                'jurusan' => $req->jurusan,
            ]);
            toastr()->success('Data Berhasil Diupdate');
            return redirect('/home/peserta');
        } else {
            $validator = Validator::make($req->all(), [
                'file' => 'mimes:zip,rar|max:10000'
            ]);

            if ($validator->fails()) {
                toastr()->error('File Harus Berupa zip/rar dan Maks 10MB');
                return back();
            }

            if ($req->hasFile('file')) {
                $filename = $req->file->getClientOriginalName();
                $filename = date('d-m-Y-') . rand(1, 9999) . $filename;
                $req->file->storeAs('/public/peserta', $filename);
            }

            Auth::user()->peserta->update([
                'nik' => $req->nik,
                'nama' => $req->nama,
                'telp' => $req->telp,
                'tgl' => $req->tgl,
                'kampus' => $req->kampus,
                'email' => $req->email,
                'tahun_lulus' => $req->tahun_lulus,
                'jurusan' => $req->jurusan,
                'file' => $filename,
            ]);
            toastr()->success('Data Berhasil Diupdate');
            return redirect('/home/peserta');
        }
    }

    public function gantipass()
    {
        $peserta = Auth::user()->peserta;

        $jmlsoal    = $this->soal()->count();
        $jam        = Carbon::now()->format('H:i');
        $waktu      = Waktu::first()->durasi;

        $listSoal   = $this->soal()->map(function ($item) use ($peserta) {
            $check = Jawaban::where('peserta_id', $peserta->id)->where('soal_id', $item->id)->first();
            if ($check == null) {
                $item->dijawab = false;
            } else {
                $item->dijawab = $check->jawaban;
            }
            return $item;
        });
        $jmlbelumjawab = $listSoal->where('dijawab', false)->count();
        return view('peserta.gantipass', compact('peserta', 'waktu', 'jam', 'jmlsoal', 'listSoal', 'jmlbelumjawab'));
    }

    public function updatepass(Request $req)
    {
        if ($req->password != $req->password2) {
            toastr()->error('Password Tidak Sama');
            return back();
        } else {
            Auth::user()->update([
                'password' => bcrypt($req->password)
            ]);
            toastr()->success('Password Diupdate');
            return redirect('/home/peserta');
        }
    }
}
