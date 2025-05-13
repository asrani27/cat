@extends('layouts.app')

@push('css')

@endpush
@section('title')
EDIT BATAS WAKTU PENDAFTARAN
@endsection
@section('content')
<br />
<div class="row">
    <div class="col-12">
        <form method="post" action="/superadmin/pendaftaran">
            @csrf
            <div class="row">
                <div class="col-lg-12 col-12">
                    <div class="card">
                        <div class="card-body">

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Tanggal Mulai</label>
                                <div class="col-sm-3">
                                    <input type="date" class="form-control" name="mulai" value="{{$data->mulai}}"
                                        required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Tanggal Sampai</label>
                                <div class="col-sm-3">
                                    <input type="date" class="form-control" name="sampai" value="{{$data->sampai}}"
                                        required>
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