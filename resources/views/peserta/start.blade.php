@extends('peserta.layouts.app')

@push('css')
    
@endpush

@section('content')
<br/>
<div class="row">
    <div class="col-md-2 col-sm-6 col-12">
      <div class="info-box">
        <div class="info-box-content text-center">
          <span class="info-box-text">NOMOR PESERTA</span>
          <span class="info-box-number">{{$peserta->nik}}</span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-md-2 col-sm-6 col-12">
      <div class="info-box">
        <div class="info-box-content text-center">
          <span class="info-box-text">NAMA PESERTA</span>
          <span class="info-box-number">{{$peserta->nama}}</span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-md-2 col-sm-6 col-12">
      <div class="info-box">
        <div class="info-box-content text-center">
          <span class="info-box-text">BATAS WAKTU</span>
          <span class="info-box-number">{{$waktu}} Menit</span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-md-2 col-sm-6 col-12">
      <div class="info-box">
        <div class="info-box-content text-center">
          <span class="info-box-text">JUMLAH SOAL</span>
          <span class="info-box-number">{{$jmlsoal}}</span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <div class="col-md-2 col-sm-6 col-12">
      <div class="info-box">
        <div class="info-box-content text-center">
          <span class="info-box-text text-success">SUDAH DI JAWAB</span>
          <span class="info-box-number text-success">{{$jmlsoal - $jmlbelumjawab}}</span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <div class="col-md-2 col-sm-6 col-12">
      <div class="info-box">
        <div class="info-box-content text-center">
          <span class="info-box-text text-danger">BELUM DI JAWAB</span>
          <span class="info-box-number text-danger">{{$jmlbelumjawab}}</span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-body text-center">
                <h1>{{$jam}} WITA</h1></br>
                <a href="/peserta/mulai" class="btn btn-primary btn-lg"><i class="fas fa-edit"></i> MULAI UJIAN</a><br/>
            </div>
        </div>
    </div>
</div>

@endsection

@push('js')
    
@endpush