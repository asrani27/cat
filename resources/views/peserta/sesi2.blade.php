@extends('peserta.layouts.app')

@push('css')

@endpush

@section('content')

<form method="post" action="/home/peserta/ujian/sesi2" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-body text-center">
                    Silahkan Download Soal Sesi 2 <a href="/soal/essay.pdf" target="_blank"
                        class="btn btn-sm btn-info">Disini</a>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-4 col-form-label">Link Repo Github (Jawaban sesi 2)
                        </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="github" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-4 col-form-label"></label>
                        <div class="col-sm-8">
                            <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@push('js')

@endpush