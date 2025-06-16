@extends('peserta.layouts.app')

@push('css')
<style>
  /* Mencegah seleksi teks */
  .no-copy {
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
  }
</style>
@endpush

@section('content')

<div class="row">
  <div class="col-md-12">
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Formasi : {{Auth::user()->peserta->kategori->nama}}</h3>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-8">
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Selamat Menjawab</h3>
      </div>
      <div class="card-body">
        <div class="no-copy" oncopy="return false" oncut="return false" onpaste="return false"
          oncontextmenu="return false">
          {!!$soal->pertanyaan!!}
        </div>

        <form method="post" action="/simpanjawaban">
          @csrf
          <input type="hidden" name="soal_id" value="{{$soal->id}}">
          <div class="form-group">
            <div class="custom-control custom-radio">
              <input class="custom-control-input" type="radio" value="A" id="customRadio1" name="jawaban"
                {{($dijawab==null ? '' : $dijawab->jawaban) == "A" ? 'checked' : null}}>
              <label for="customRadio1" class="custom-control-label">{!!$soal->pil_a!!}</label>
            </div>
            <div class="custom-control custom-radio">
              <input class="custom-control-input" type="radio" value="B" id="customRadio2" name="jawaban"
                {{($dijawab==null ? '' : $dijawab->jawaban) == "B" ? 'checked' : null}}>
              <label for="customRadio2" class="custom-control-label">{!!$soal->pil_b!!}</label>
            </div>
            <div class="custom-control custom-radio">
              <input class="custom-control-input" type="radio" value="C" id="customRadio3" name="jawaban"
                {{($dijawab==null ? '' : $dijawab->jawaban) == "C" ? 'checked' : null}}>
              <label for="customRadio3" class="custom-control-label">{!!$soal->pil_c!!}</label>
            </div>
            <div class="custom-control custom-radio">
              <input class="custom-control-input" type="radio" value="D" id="customRadio4" name="jawaban"
                {{($dijawab==null ? '' : $dijawab->jawaban) == "D" ? 'checked' : null}}>
              <label for="customRadio4" class="custom-control-label">{!!$soal->pil_d!!}</label>
            </div>
            <div class="custom-control custom-radio">
              <input class="custom-control-input" type="radio" value="E" id="customRadio5" name="jawaban"
                {{($dijawab==null ? '' : $dijawab->jawaban) == "E" ? 'checked' : null}}>
              <label for="customRadio5" class="custom-control-label">{!!$soal->pil_e!!}</label>
            </div>
          </div>
          <button type="submit" class="btn btn-sm btn-info">Simpan Dan Lanjutkan</button>
          <a href="/peserta/ujian/soal/{{$next}}" class="btn btn-sm btn-info">Lewati Soal</a>
        </form>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">List Soal</h3>
      </div>
      <div class="card-body">
        @php
        $no = 1;
        $peserta = Auth::user()->peserta;
        $random = 'random' . substr($peserta->telp, -1);

        @endphp
        @foreach ($listSoal as $key => $item)
        @if ($item->id == $soal->id)

        <strong style="padding-bottom: 5px;">
          <a href="/peserta/ujian/soal/{{$item->id}}" class="btn btn-sm btn-warning text-bold">{{$no++}}</a></strong>
        @else

        <strong style="padding-bottom: 5px;">
          <a href="/peserta/ujian/soal/{{$item->id}}"
            class="btn btn-sm btn-{{$item->dijawab == true ? 'success':'danger'}}">{{$no++}}</a></strong>
        @endif

        @endforeach
      </div>
    </div>


    <div class="card">
      <div class="card-body">

        <i class="fas fa-clock"></i> Mulai <br />{{\Carbon\Carbon::parse($tgl_mulai)->format('d M Y H:i')}}
        WITA<br /><br />
        <i class="fas fa-clock"></i> Selesai<br />{{\Carbon\Carbon::parse($tgl_selesai)->format('d M Y H:i')}} WITA
      </div>
    </div>
    <a href="/selesaiujian" class="btn btn-success btn-block"
      onclick="return confirm('Yakin Ingin Mengakhiri Ujian?');"><i class="fas fa-save"></i> selesai ujian</a><br />
  </div>
</div>
@endsection

@push('js')
<script>
  document.addEventListener('DOMContentLoaded', function () {
        document.addEventListener('copy', function (e) {
            e.preventDefault();
            alert('Copy tidak diizinkan!');
        });
        document.addEventListener('contextmenu', function (e) {
            e.preventDefault();
        });
    });
</script>
@endpush