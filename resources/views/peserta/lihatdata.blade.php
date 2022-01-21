@extends('peserta.layouts.app')

@push('css')

@endpush

@section('content')


<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-body text-center">
                <h1>DATA PESERTA</h1>

                <form method="post" action="/home/peserta/uploadlagi" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-4 col-form-label">NIK</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="nik" value="{{$peserta->nik}}"
                                                readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-4 col-form-label">Nama Peserta</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="nama"
                                                value="{{$peserta->nama}}" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-4 col-form-label">Tanggal Lahir</label>
                                        <div class="col-sm-8">
                                            <input type="date" class="form-control" name="tgl" value="{{$peserta->tgl}}"
                                                required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-4 col-form-label">Telp</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="telp"
                                                value="{{$peserta->telp}}" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-4 col-form-label">Email</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="email"
                                                value="{{$peserta->email}}" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-4 col-form-label">Nama PTS/PTN</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="kampus"
                                                value="{{$peserta->kampus}}" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-4 col-form-label">Nama Jurusan</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="jurusan"
                                                value="{{$peserta->jurusan}}" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-4 col-form-label">Tahun Lulus</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="tahun_lulus"
                                                value="{{$peserta->tahun_lulus}}" placeholder="tahun lulus" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-4 col-form-label">Berkas File
                                            (Zip/Rar)</label>
                                        <div class="col-sm-8">
                                            <input type="file" class="form-control" name="file">
                                            <b>
                                                FILE : <a href="/storage/peserta/{{ $peserta->file}}" target="_blank">
                                                    {{
                                                    $peserta->file}}</a>
                                            </b>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-4 col-form-label"></label>
                                        <div class="col-sm-8">
                                            <button type="submit"
                                                class="btn btn-sm btn-block btn-primary">UPDATE</button>
                                            <a href="/home/peserta" class="btn btn-sm btn-block btn-secondary">Kembali
                                                Ke Beranda</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.info-box -->
                            </div>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('js')

@endpush