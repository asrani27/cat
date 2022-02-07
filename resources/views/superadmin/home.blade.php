@extends('layouts.app')

@push('css')

<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
  integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
  crossorigin="" />
<style>
  #mapid {
    height: 380px;
  }
</style>
@endpush
@section('title')
<strong>CAT</strong>
@endsection
@section('content')
<br />
<div class="row">
  <div class="col-lg-12">
    <div class="card card-widget">
      <div class="card-header">
        <div class="user-block">
          <img class="img-circle"
            src="https://upload.wikimedia.org/wikipedia/commons/thumb/1/12/User_icon_2.svg/2048px-User_icon_2.svg.png"
            alt="User Image">
          <span class="username"><a href="#">{{Auth::user()->name}}</a></span>
          <span class="description"><strong>SELAMAT DATANG DI APLIKASI COMPUTER ASSISTED TEST (CAT)</strong></span>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-info">
      <div class="inner">
        <h3>{{$peserta}}</h3>

        <p><strong>PESERTA, YG UPLOAD ({{$yangupload}})</strong></p>
      </div>
      <div class="icon">
        <i class="fas fa-users"></i>
      </div>
      <a href="/superadmin/peserta" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-success">
      <div class="inner">
        <h3>{{$soal}}</h3>

        <p><strong>JUMLAH SOAL</strong></p>
      </div>
      <div class="icon">
        <i class="fas fa-list"></i>
      </div>
      <a href="/superadmin/soal" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-warning">
      <div class="inner">
        <h3>{{$kategori}}</h3>

        <p><strong>KATEGORI</strong></p>
      </div>
      <div class="icon">
        <i class="fas fa-list"></i>
      </div>
      <a href="/superadmin/kategori" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-danger">
      <div class="inner">
        <h3>{{$durasi}} Menit</h3>

        <p><strong>WAKTU</strong></p>
      </div>
      <div class="icon">
        <i class="fas fa-clock"></i>
      </div>
      <a href="/superadmin/waktu" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <!-- ./col -->
</div>
<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-header">
        DATA HASIL UJIAN PESERTA
      </div>
      <div class="card-body">
        <div class=" table-responsive">
          <table class="table table-hover table-striped table-bordered text-nowrap table-sm">
            <thead>
              <tr style="font-size:11px; font-family:Arial, Helvetica, sans-serif" class="bg-gradient-primary">
                <th class="text-center">#</th>
                <th>NIK</th>
                <th class="text-center">Nama</th>
                <th class="text-center">Kampus</th>
                <th class="text-center">Telp</th>
                <th class="text-center">Git</th>
                <th class="text-center">Jumlah Soal</th>
                <th class="text-center">Di Jawab</th>
                <th class="text-center">Belum Jawab</th>
                <th class="text-center">Benar</th>
                <th class="text-center">Salah</th>
                {{-- <th class="text-center">Aksi</th> --}}
              </tr>
            </thead>
            @php
            $no =1;
            @endphp

            <tbody>
              @foreach ($data as $item)
              <tr style="font-size:11px; font-family:Arial, Helvetica, sans-serif">
                <td>{{$no++}}</td>
                <td>{{$item->nik}}</td>
                <td>{{$item->nama}}</td>
                <td style="width: 20%">{{$item->kampus}}</td>
                <td>{{$item->telp}}</td>
                <td>{{$item->github}}</td>
                <td class="text-center">{{$soal}}</td>
                <td class="text-center">{{$item->dijawab}}</td>
                <td class="text-center">{{$soal - $item->dijawab}}</td>
                <td class="text-center">{{$item->benar}}</td>
                <td class="text-center">{{$soal - $item->benar}}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@push('js')

@endpush