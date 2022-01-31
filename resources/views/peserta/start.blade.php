@extends('peserta.layouts.app')

@push('css')

@endpush

@section('content')


<div class="row">
  <div class="col-md-12">
    <div class="card card-primary">
      <div class="card-body text-center">
        <h3>Prosedur dan informasi pelaksanaan ujian online (Tahap I)</h3><br />
        <div style="text-align: justify">
          <ul>
            <li>
              <strong style="color:red">Bagi peserta yang belum mengupload berkas dengan lengkap belum bisa mengikuti
                ujian. silahkan lengkapi dulu</strong>
            </li>
            <li>
              Ujian dilaksanakan tanggal 6 februari 2022 pada pukul 09.00 WITA secara online dengan 2 sesi yaitu :
            </li>
            <li>
              Sesi pertama dilakukan pada dengan menggunakan metode pilihan ganda dengan jumlah soal sebanyak 50 soal
              yang dapat dikerjakan dalam rentang waktu 1 jam (09.00 WITA – 10.00 WITA).
            </li>
            <li>
              Sesi kedua akan dilaksanakan langsung setelah anda melakukan submit pada sesi ujian pertama
            </li>
            <li>
              Sesi kedua berbentuk tes koding secara offline dirumah masing-masing untuk memecahkan 1 masalah logika
              yang diupload paling lambat pada tanggal 7 Februari 2022 pukul 09.00 WITA pada kolom yang disediakan dalam
              bentuk file zip/rar
            </li>
            <li>
              Bagi peserta yang tidak melakukan submit pada ujian sesi I (pilihan ganda), maka tidak akan dapat
              melakukan proses ujian sesi 2 (essay) pada tahap I ini
            </li>
            <li>
              Bahasa pemrograman yang disarankan pada ujian sesi 2 (essay) adalah PHP/Javascript. Boleh menggunakan
              framework ataupun native
            </li>
          </ul>
        </div>

        <h1>BER DO'A LAH SEBELUM MEMULAI UJIAN</h1>
        <strong>MULAI {{\Carbon\Carbon::parse($mulai)->format('d M Y H:i')}} WITA<br /> SELESAI
          {{\Carbon\Carbon::parse($selesai)->format('d M Y H:i')}} WITA</strong> <br />
        <a href="/peserta/mulai" class="btn btn-primary btn-lg"><i class="fas fa-edit"></i> MULAI UJIAN</a><br />
      </div>
    </div>
  </div>
</div>

@endsection

@push('js')

@endpush