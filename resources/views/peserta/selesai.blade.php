@extends('peserta.layouts.app')

@push('css')

@endpush

@section('content')

<div class="row">
  <div class="col-md-12">
    <div class="card card-primary">
      <div class="card-body text-center">
        <h1>UJIAN TELAH SELESAI</h1>
        <h1>SKOR ANDA : {{$skor}}</h1>
        {{-- <a href="/home/peserta/ujian/sesi2" class="btn btn-primary">LANJUT SOAL </br>SESI 2</a> --}}
      </div>
    </div>
  </div>
  <div class="col-md-12">
    <div class="card card-primary">
      <div class="card-body text-center">
        <h3>Tahapan Rekrutmen</h3>
        <table width="100%" cellpadding="10px" cellspacing="10px" style="border: 1px solid black">
          <tr>
            <td style="border: 1px solid black;font-weight:bold">1</td>
            <td style="border: 1px solid black">Ujian Online</td>
            <td style="border: 1px solid black">{{Auth::user()->peserta->status_ujian}}
              ({{Auth::user()->peserta->keterangan_ujian}})</td>
            <td style="border: 1px solid black">
            </td>
          </tr>
          <tr>
            <td style="border: 1px solid black;font-weight:bold">2</td>
            <td style="border: 1px solid black">Verifikasi Berkas Lamaran</td>
            <td style="border: 1px solid black">{{Auth::user()->peserta->status_berkas}}<br />
              ({{Auth::user()->peserta->keterangan_berkas}})<br />

            </td>
            <td style="border: 1px solid black">
              @if (Auth::user()->peserta->status_berkas == 'TIDAK LULUS')
              <strong>Alasan Sanggah :</strong>
              @if (Auth::user()->peserta->sanggah->count() == 0)

              <form method="post" action="/home/peserta/sanggah">
                @csrf
                <textarea rows='2' class="form-control" name="isi"></textarea>
                <button type="submit" class="btn btn-xs btn-danger"
                  onclick="return confirm('Sudah yakin ingin mengajukan sanggah?');">Ajukan Sanggahan</button>
              </form>
              @else
              <br />{{Auth::user()->peserta->sanggah->first()->isi}}
              @endif
              @endif
            </td>
          </tr>
          <tr>
            <td style="border: 1px solid black;font-weight:bold">3</td>
            <td style="border: 1px solid black">Wawancara</td>
            <td style="border: 1px solid black">{{Auth::user()->peserta->status_wawancara}}
              ({{Auth::user()->peserta->keterangan_wawancara}})</td>
            <td style="border: 1px solid black"></td>
          </tr>
        </table>
      </div>
    </div>
  </div>
</div>

@endsection

@push('js')

@endpush