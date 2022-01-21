@extends('peserta.layouts.app')

@push('css')

@endpush

@section('content')


<div class="row">
  <div class="col-md-12">
    <div class="card card-primary">
      <div class="card-body text-center">
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