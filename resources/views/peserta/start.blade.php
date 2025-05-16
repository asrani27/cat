@extends('peserta.layouts.app')

@push('css')

@endpush

@section('content')


<div class="row">
  <div class="col-md-12">
    <div class="card card-primary">
      <div class="card-body text-center">
        <h3>Prosedur dan informasi pelaksanaan ujian online</h3><br />
        <div style="text-align: justify">
          <ul>
            <li>
              <strong>Bagi peserta yang belum mengupload berkas dengan lengkap belum bisa mengikuti
                ujian. silahkan lengkapi dulu. Untuk berkas wajib di compress menjadi .ZIP</strong>
            </li>
            <li>
              Setelah Berkas di upload, akan di verifikasi oleh admin, harap menunggu hasil verifikasi pada tanggal :
              28 Mei 2025
            </li>
            <li>
              Bagi yang lulus verifikasi berkas dapat mengikut ujian online, dengan mengklik tombol start di bawah ini
            </li>

          </ul>
          <center>
            <h1>SETELAH MASUK WAKTU UJIAN, HALAMAN AKAN MASUK KE SOAL UJIAN, NAMUN JIKA HALAMAN TIDAK BERUBAH SILAHKAN
              KLIK
              TOMBOL
              MULAI UJIAN</h1>
            <strong>MULAI {{\Carbon\Carbon::parse($mulai)->format('d M Y H:i')}} WITA<br /> SELESAI
              {{\Carbon\Carbon::parse($selesai)->format('d M Y H:i')}} WITA</strong> <br />
            <a href="/peserta/mulai" class="btn btn-primary btn-lg"><i class="fas fa-edit"></i> MULAI UJIAN</a><br />
          </center>
        </div>
        {{--
        @if (Auth::user()->status == NULL)

        @elseif(Auth::user()->status == 'LULUS')

        <h1>ANDA LULUS, SILAHKAN KLIK TOMBOL MULAI UJIAN</h1>
        <strong>MULAI {{\Carbon\Carbon::parse($mulai)->format('d M Y H:i')}} WITA<br /> SELESAI
          {{\Carbon\Carbon::parse($selesai)->format('d M Y H:i')}} WITA</strong> <br />
        <a href="/peserta/mulai" class="btn btn-primary btn-lg"><i class="fas fa-edit"></i> MULAI UJIAN</a><br />
        @else
        <h1>MOHON MAAF, ANDA TIDAK LULUS BERKAS ADMINISTRASI</h1>
        @endif --}}
      </div>
    </div>
  </div>
</div>

@endsection

@push('js')

@endpush