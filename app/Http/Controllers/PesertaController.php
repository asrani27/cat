<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Role;
use App\Models\Soal;
use App\Models\User;
use App\Models\Waktu;
use App\Models\Jawaban;
use App\Models\Peserta;
use App\Models\Sanggah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
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
    public function sanggah(Request $req)
    {
        $check = Sanggah::where('peserta_id', Auth::user()->peserta->id)->first();
        if ($check == null) {
            $n = new Sanggah();
            $n->peserta_id = Auth::user()->peserta->id;
            $n->isi = $req->isi;
            $n->save();
            toastr()->success('Berhasil Di Ajukan');
        } else {
            toastr()->error('Sudah melakukkan sanggah');
        }
        return back();
    }
    public function edit($id)
    {
        $data = Peserta::find($id);

        return view('superadmin.peserta.edit', compact('data'));
    }
    public function updateStatus(Request $req, $id)
    {
        $data = Peserta::find($id);
        $data->status_ujian = $req->status_ujian;
        $data->keterangan_ujian = $req->keterangan_ujian;
        $data->status_berkas = $req->status_berkas;
        $data->keterangan_berkas = $req->keterangan_berkas;
        $data->status_wawancara = $req->status_wawancara;
        $data->keterangan_wawancara = $req->keterangan_wawancara;
        $data->save();
        toastr()->success('Sukses Di Update');
        return back();
    }
    public function verify($id)
    {
        $data = Peserta::find($id);

        return view('superadmin.peserta.verify', compact('data'));
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

    public function search()
    {
        $keyword = request()->get('search');
        $data = Peserta::where('nik', '%' . $keyword . '%')->orWhere('nama', '%' . $keyword . '%')->paginate(10);
        return view('superadmin.peserta.index', compact('data'));
    }
    public function destroy($id)
    {
        try {
            Peserta::find($id)->user->delete();
            Peserta::find($id)->delete();
            toastr()->success('Sukses Di Hapus');
            return back();
        } catch (\Exception $e) {
            toastr()->error('Gagal Di Hapus');
            return back();
        }
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
            'file' => 'mimes:pdf|max:8000'
        ]);

        if ($validator->fails()) {
            toastr()->error('File Harus Berupa PDF yang di jadikan 1 dan Maks 8MB');
            $req->flash();
            return back();
        }

        if ($req->hasFile('file')) {
            $nik = Auth::user()->peserta->nik;
            $nama = Auth::user()->peserta->nama;
            $ext = $req->file->getClientOriginalExtension();

            $filename = $nik . '_' . preg_replace('/\s+/', '_', $nama) . '.' . $ext;

            Storage::disk('minio')->putFileAs('peserta', $req->file('file'), $filename);
            $attr['file'] = $filename;
        } else {
            $attr['file'] = null;
            $filename = null;
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
        $peserta    = Auth::user()->peserta;

        $jmlsoal    = count(json_decode($peserta->soal_acak));
        $jam        = Carbon::now()->format('H:i');
        $waktu      = Waktu::first()->durasi;

        $nomor_acak = json_decode($peserta->soal_acak);
        $soal = Soal::whereIn('id', $nomor_acak)->get();

        $soal = $soal->sortBy(function ($item) use ($nomor_acak) {
            return array_search($item->id, $nomor_acak);
        })->values();

        $listSoal   = $soal->map(function ($item) use ($peserta) {
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
                'file' => 'mimes:pdf|max:8000'
            ]);

            if ($validator->fails()) {
                toastr()->error('File Harus Berupa pdf dan Maks 8MB');
                return back();
            }

            if ($req->hasFile('file')) {
                $nik = Auth::user()->peserta->nik;
                $nama = Auth::user()->peserta->nama;
                $ext = $req->file->getClientOriginalExtension();

                $filename = $nik . '_' . preg_replace('/\s+/', '_', $nama) . '.' . $ext;

                Storage::disk('minio')->putFileAs('peserta', $req->file('file'), $filename);
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
            return redirect('/home/peserta/lihatdata');
        }
    }

    public function download($filename)
    {
        $path = 'https://minio.banjarmasinkota.go.id/asrani/peserta/' . $filename;
        dd('dd');
        $content = Storage::disk('minio')->get('peserta/1111111111111111_testing_terakhir.pdf');
        dd(strlen($content));
        // Since files are public, let's try to generate a temporary URL
        try {
            // Check if file exists first
            if (!Storage::disk('minio')->exists($path)) {
                // Try to list files to debug
                $files = Storage::disk('minio')->files('peserta');
                $allFiles = Storage::disk('minio')->allFiles();

                return response()->json([
                    'error' => 'File not found',
                    'searching_for' => $path,
                    'files_in_peserta' => $files,
                    'all_files' => $allFiles,
                    'bucket' => env('AWS_BUCKET'),
                    'endpoint' => env('AWS_ENDPOINT')
                ], 404);
            }

            // For public files, we can generate a temporary URL or stream directly
            $url = Storage::disk('minio')->temporaryUrl($path, now()->addMinutes(5));

            return redirect($url);
        } catch (\Exception $e) {
            // If temporary URL fails, try direct stream
            try {
                $stream = Storage::disk('minio')->readStream($path);
                $mime = Storage::disk('minio')->mimeType($path);

                return response()->stream(function () use ($stream) {
                    fpassthru($stream);
                }, 200, [
                    'Content-Type' => $mime,
                    'Content-Disposition' => 'attachment; filename="' . $filename . '"',
                ]);
            } catch (\Exception $e2) {
                return response()->json([
                    'error' => 'Failed to download file',
                    'message' => $e2->getMessage(),
                    'path' => $path
                ], 500);
            }
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
