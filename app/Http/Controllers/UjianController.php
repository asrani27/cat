<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Soal;
use App\Models\Waktu;
use App\Models\Jawaban;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UjianController extends Controller
{
    public function peserta()
    {
        return Auth::user()->peserta;
    }

    public function selesai()
    {
        $peserta = $this->peserta();
        $peserta->update(['selesai_ujian'=>1]);
        return redirect('/home/peserta');
    }
    public function mulai()
    {
        if($this->peserta()->mulai !=  null){
            toastr()->error('Ujian Sudah Selesai');
            return back();
        }else{
            $durasi = Waktu::first()->durasi + 1;
            $user = $this->peserta();
    
            $now = Carbon::now();
            $mulai = $now->format('Y-m-d H:i');
            $selesai = $now->addMinute($durasi)->format('Y-m-d H:i');
    
            $user->update([
                'mulai' => $mulai,
                'selesai' => $selesai
            ]);
            $soalPertama = Soal::first()->id;
            return redirect('/peserta/ujian/soal/'. $soalPertama);
        }
    }

    public function soalUjian()
    {
        return Soal::get();
    }

    public function next($id)
    {
        return Soal::where('id', '>', $id)->first() == null ? Soal::first()->id : Soal::where('id', '>', $id)->first()->id;
    }

    public function soal($id)
    {
        
        $peserta    = $this->peserta();

        $mulai     = $peserta->mulai;
        $selesai   = $peserta->selesai;
        $check     = Carbon::now()->between($mulai,$selesai);
        if($check){
            $jmlsoal    = $this->soalUjian()->count();
            $jam        = Carbon::now()->format('H:i');
            $waktu      = Waktu::first()->durasi;
            $soal       = Soal::find($id);
            $next       = $this->next($id);
            $listSoal   = $this->soalUjian()->map(function($item)use($peserta){
                $check = Jawaban::where('peserta_id',$peserta->id)->where('soal_id', $item->id)->first();
                if($check == null){
                    $item->dijawab = false;
                }else{
                    $item->dijawab = $check->jawaban;
                }
                return $item;
            });
            $jmlbelumjawab = $listSoal->where('dijawab', false)->count();
            
            $dijawab    = Jawaban::where('peserta_id', $peserta->id)->where('soal_id', $id)->first();
            
            return view('peserta.home',compact('jmlsoal','jam','waktu','peserta','listSoal','soal','next','dijawab','jmlbelumjawab'));
        }else{
            return redirect('/home/peserta');
        }
    }

    public function simpan(Request $req)
    {
        if($req->jawaban == null){
            toastr()->error('Harap Pilih Jawaban Anda');
            return back();
        }else{
            $check = Jawaban::where('peserta_id', $this->peserta()->id)->where('soal_id', $req->soal_id)->first();
            if($check == null){
                $new = new Jawaban;
                $new->peserta_id = $this->peserta()->id;
                $new->soal_id = $req->soal_id;
                $new->jawaban = $req->jawaban;
                $new->save();
                return redirect('/peserta/ujian/soal/'. $this->next($req->soal_id));
            }else{
                $check->update(['jawaban'=>$req->jawaban]);
                return redirect('/peserta/ujian/soal/'. $this->next($req->soal_id));
            }
        }
    }
}
