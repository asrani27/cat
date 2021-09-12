@extends('layouts.app')

@push('css')
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
@endpush
@section('title')
    TAMBAH
@endsection
@section('content')
<br/>
<div class="row">
    <div class="col-12">
        <a href="/superadmin/peserta" class="btn btn-sm btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a><br/><br/>
<form method="post" action="/superadmin/peserta">
    @csrf
    <div class="row">
        <div class="col-lg-12 col-12">
            <div class="card">
                <div class="card-body">
                    
                    <div class="form-group row">
                    <label class="col-sm-2 col-form-label">NIK</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="nik" required  minlength="16" maxlength="16">
                    </div>
                    </div>

                    <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="nama" required>
                    </div>
                    </div>
                    
                    <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Telp</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="telp" required>
                    </div>
                    </div>

                    <div class="form-group row">
                    <label class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-block btn-primary"><strong>SIMPAN</strong></button>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
    </div>
</div>

@endsection

@push('js')

@endpush