@extends('peserta.layouts.app')

@push('css')

@endpush

@section('content')


<div class="row">
  <div class="col-md-12">
    <div class="card card-primary">
      <div class="card-body text-center">
        @if(\Carbon\Carbon::now()->format('Y-m-d') > \App\Models\WaktuPendaftaran::first()->sampai)
        @if (Auth::user()->peserta->file == null)
        <div class="alert alert-danger alert-dismissible">
          <h5><i class="icon fas fa-ban"></i> Anda Tidak Dapat Mengikuti Ujian, Karena tidak mengupload berkas lamaran
          </h5>
        </div>
        @else

        <div class="alert alert-success alert-dismissible">
          <h5><i class="icon far fa-thumbs-up"></i> Selamat, Anda Dapat Mengikuti Ujian pada tanggal 7 juli 2025</h5>
        </div>
        <h3>Prosedur dan informasi pelaksanaan ujian online</h3><br />
        <div style="text-align: justify">

          1.⁠ ⁠Berkas wajib digabung menjadi satu dalam bentuk pdf dan diupload sampai dengan tanggal 3 Juli 2025 Pukul
          23.59<br />
          2.⁠ ⁠⁠Peserta yang tidak mengupload berkas sampai tanggal 3 Juli 2025 tidak bisa mengikuti ujian<br />
          3.⁠ ⁠⁠Ujian akan dilaksanakan pada tanggal 07Juli 2025 pukul 09.00 -10.00 WITA<br />
          4.⁠ ⁠⁠Peserta yang telah mengupload berkas dapat mengikuti ujian dengan mengklik tombol mulai ujian dibawah
          ini<br />
          <center>
            <h2>SETELAH MASUK WAKTU UJIAN, HALAMAN AKAN MASUK KE SOAL UJIAN, NAMUN JIKA HALAMAN TIDAK BERUBAH SILAHKAN
              KLIK
              TOMBOL
              MULAI UJIAN</h2>
            <strong>MULAI {{\Carbon\Carbon::parse($mulai)->format('d M Y H:i')}} WITA<br /> SELESAI
              {{\Carbon\Carbon::parse($selesai)->format('d M Y H:i')}} WITA</strong> <br />
            <a href="/peserta/mulai" class="btn btn-primary btn-lg"><i class="fas fa-edit"></i> MULAI UJIAN</a><br />
          </center>
        </div>

        @endif
        @else
        <h3>Prosedur dan informasi pelaksanaan ujian online</h3><br />
        <div style="text-align: justify">

          1.⁠ ⁠Berkas wajib digabung menjadi satu dalam bentuk pdf dan diupload sampai dengan tanggal 3 Juli 2025 Pukul
          23.59<br />
          2.⁠ ⁠⁠Peserta yang tidak mengupload berkas sampai tanggal 3 Juli 2025 tidak bisa mengikuti ujian<br />
          3.⁠ ⁠⁠Ujian akan dilaksanakan pada tanggal 07Juli 2025 pukul 09.00 -10.00 WITA<br />
          4.⁠ ⁠⁠Peserta yang telah mengupload berkas dapat mengikuti ujian dengan mengklik tombol mulai ujian dibawah
          ini<br />
          <center>
            <h2>SETELAH MASUK WAKTU UJIAN, HALAMAN AKAN MASUK KE SOAL UJIAN, NAMUN JIKA HALAMAN TIDAK BERUBAH SILAHKAN
              KLIK
              TOMBOL
              MULAI UJIAN</h2>
            <strong>MULAI {{\Carbon\Carbon::parse($mulai)->format('d M Y H:i')}} WITA<br /> SELESAI
              {{\Carbon\Carbon::parse($selesai)->format('d M Y H:i')}} WITA</strong> <br />
            <a href="/peserta/mulai" class="btn btn-primary btn-lg"><i class="fas fa-edit"></i> MULAI UJIAN</a><br />
          </center>
        </div>

        @endif
      </div>
    </div>
  </div>
</div>

@endsection

@push('js')

@endpush