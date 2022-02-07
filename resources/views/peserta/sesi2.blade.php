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

                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-4 col-form-label">
                        </label>
                        <div class="col-sm-8">
                            Silahkan Download Soal Sesi 2 <a href="/soal/essay.pdf" target="_blank"
                                class="btn btn-xs btn-info">Disini</a>, Paling lambat tanggal 7 Feb 2022 Jam 09:00 WITA
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-4 col-form-label">Link Repo Github (Jawaban sesi 2)
                        </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="github"
                                value="{{Auth::user()->peserta->github}}"
                                placeholder="github.com/budisudarsono/ujian_sesi2_tahap1_budi" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-4 col-form-label"></label>
                        <div class="col-sm-8">
                            Batas waktu telah berakhir, kami akan mendownload projek github anda.
                            {{-- <button type="submit" class="btn btn-block btn-sm btn-primary">Simpan</button> --}}
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