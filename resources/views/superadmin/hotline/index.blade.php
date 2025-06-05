@extends('layouts.app')

@push('css')

@endpush
@section('title')
UBAH NOMOR HOTLINE
@endsection
@section('content')
<br />
<div class="row">
    <div class="col-12">
        <form method="post" action="/superadmin/hotline">
            @csrf
            <div class="row">
                <div class="col-lg-12 col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Nomor Hotline</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" name="nomor" value="{{$data->nomor}}"
                                        required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label"></label>
                                <div class="col-sm-3">
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