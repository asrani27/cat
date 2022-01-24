@extends('peserta.layouts.app')

@push('css')

@endpush

@section('content')


<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-body text-center">
                <h1></h1>

                <form method="post" action="/home/peserta/gantipass" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-4 col-form-label">Password Baru</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="password" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-4 col-form-label">Masukkan Lagi
                                            Password</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="password2" required>
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