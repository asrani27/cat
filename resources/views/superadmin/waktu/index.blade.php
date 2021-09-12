@extends('layouts.app')

@push('css')

@endpush
@section('title')
    EDIT BATAS WAKTU
@endsection
@section('content')
<br/>
<div class="row">
    <div class="col-12">
<form method="post" action="/superadmin/waktu/{{$data->id}}">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-lg-12 col-12">
            <div class="card">
                <div class="card-body">  
                    <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Batas Waktu</label>
                    <div class="col-sm-1">
                        <input type="text" class="form-control" name="durasi" value="{{$data->durasi}}" required>
                    </div>
                    <label class="col-sm-2 col-form-label">Menit</label>
                    </div>

                    <div class="form-group row">
                    <label class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-block btn-primary"><strong>UPDATE</strong></button>
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