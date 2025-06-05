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
        <a href="/superadmin/formasi/{{$formasi_id}}" class="btn btn-sm btn-secondary"><i class="fas fa-arrow-left"></i>
            Kembali</a><br /><br />
        <form method="post" action="/superadmin/formasi/{{$formasi_id}}/peserta/{{$data->id}}/verify">
            @csrf
            <div class="row">
                <div class="col-lg-12 col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">STATUS UJIAN</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="status_ujian">
                                        <option value="">-</option>
                                        <option value="LULUS" {{$data->status_ujian == 'LULUS' ? 'selected':''}}>LULUS
                                        </option>
                                        <option value="TIDAK LULUS" {{$data->status_ujian == 'TIDAK LULUS' ?
                                            'selected':''}}>TIDAK
                                            LULUS</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Keterangan Ujian</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="keterangan_ujian"
                                        value="{{$data->keterangan_ujian}}">
                                </div>
                            </div>


                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">STATUS BERKAS</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="status_berkas">
                                        <option value="">-</option>
                                        <option value="LULUS" {{$data->status_berkas == 'LULUS' ? 'selected':''}}>LULUS
                                        </option>
                                        <option value="TIDAK LULUS" {{$data->status_berkas == 'TIDAK LULUS' ?
                                            'selected':''}}>TIDAK
                                            LULUS</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Keterangan Berkas</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="keterangan_berkas"
                                        value="{{$data->keterangan_berkas}}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">STATUS WAWANCARA</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="status_wawancara">
                                        <option value="">-</option>
                                        <option value="LULUS" {{$data->status_wawancara == 'LULUS' ?
                                            'selected':''}}>LULUS
                                        </option>
                                        <option value="TIDAK LULUS" {{$data->status_wawancara == 'TIDAK LULUS' ?
                                            'selected':''}}>TIDAK
                                            LULUS</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Keterangan Wawancara</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="keterangan_wawancara"
                                        value="{{$data->keterangan_wawancara}}">
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