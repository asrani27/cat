@extends('layouts.app')

@push('css')
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
@endpush
@section('title')
EDIT
@endsection
@section('content')
<br />
<div class="row">
    <div class="col-12">
        <a href="/superadmin/kategori" class="btn btn-sm btn-secondary"><i class="fas fa-arrow-left"></i>
            Kembali</a><br /><br />
        <form method="post" action="/superadmin/kategori/{{$data->id}}">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-lg-12 col-12">
                    <div class="card">
                        <div class="card-body">

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Nama Formasi</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="nama" required
                                        value="{{$data->nama}}">
                                </div>
                            </div>


                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Syarat Pendidikan</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="pendidikan"
                                        value="{{$data->pendidikan}}" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Penempatan</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="penempatan"
                                        value="{{$data->penempatan}}" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Jenis Kelamin</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="jkel">
                                        <option value="">-</option>
                                        <option value="L" {{$data->jkel == 'L' ? 'selected':''}} >Laki-Laki</option>
                                        <option value="P" {{$data->jkel == 'P' ? 'selected':''}}>Perempuan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <small>*kosongkan jika boleh keduanya</small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <button type="submit"
                                        class="btn btn-block btn-primary"><strong>UPDATE</strong></button>
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