@extends('layouts.app')

@push('css')
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
@endpush
@section('title')
VERIFIKASI BERKAS
@endsection
@section('content')
<br />
<div class="row">
    <div class="col-12">
        <a href="/superadmin/peserta" class="btn btn-sm btn-secondary"><i class="fas fa-arrow-left"></i>
            Kembali</a><br /><br />
        <form method="post" action="/superadmin/peserta/{{$data->id}}/verify">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-lg-12 col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">STATUS</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="status" required>
                                        <option value="">-</option>
                                        <option value="LULUS" {{$data->status == 'LULUS' ? 'selected':''}}>LULUS
                                        </option>
                                        <option value="TIDAK LULUS" {{$data->status == 'TIDAK LULUS' ?
                                            'selected':''}}>TIDAK
                                            LULUS</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Keterangan</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="keterangan" required
                                        value="{{$data->keterangan}}">
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