@extends('layouts.app')

@push('css')
<!-- DataTables -->
<link rel="stylesheet" href="/theme/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="/theme/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
@endpush
@section('title')
<strong>CAT</strong>
@endsection
@section('content')
<br />
<div class="row">
  <div class="col-lg-12">
    <div class="card card-widget">
      <div class="card-header">
        <div class="user-block">
          <img class="img-circle"
            src="https://upload.wikimedia.org/wikipedia/commons/thumb/1/12/User_icon_2.svg/2048px-User_icon_2.svg.png"
            alt="User Image">
          <span class="username"><a href="#">{{$formasi->nama}}</a></span>
          <span class="description"><strong>{{$formasi->penempatan}}</strong></span>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-header">
        DATA HASIL UJIAN PESERTA
        <a href="/superadmin/formasi/{{$formasi->id}}/excel" class="btn btn-primary btn-sm">Export Excel</a>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table id="example1" class="table table-hover table-striped table-bordered text-nowrap table-sm">
            <thead>
              <tr style="font-size:11px; font-family:Arial, Helvetica, sans-serif" class="bg-gradient-primary">
                <th class="text-center">#</th>
                <th>NIK / NAMA / TELP</th>
                <th class="text-center">Detail Soal</th>
                <th class="text-center">Pendidikan</th>
                <th class="text-center">File</th>
                <th class="text-center">Status</th>
                <th class="text-center">Aksi</th>

              </tr>
            </thead>
            @php
            $no =1;
            @endphp

            <tbody>
              @foreach ($data as $item)
              <tr style="font-size:11px; font-family:Arial, Helvetica, sans-serif">
                <td>{{$no++}}</td>
                <td>{{$item->nik}} <br />{{$item->nama}}</br>{{$item->telp}}</td>
                <td class="text-left">
                  Jumlah : {{$jmlSoal}} <br />
                  Di Jawab : {{$item->dijawab}} <br />
                  Belum Di Jawab : {{$jmlSoal - $item->dijawab}} <br />
                  Benar : {{$item->benar}} <br />
                  Salah : {{$jmlSoal - $item->benar}}

                </td>
                <td class="text-left">
                  Sekolah/PTA : {{$item->kampus}} <br />
                  Jurusan : {{$item->jurusan}} <br />
                  Tahun Lulus : {{$item->tahun_lulus}} <br />
                  Email : {{$item->email}}</td>
                <td>
                  @if ($item->file == null)

                  @else
                  <a href="/file-peserta/{{$item->file}}">Download</a>
                  @endif
                </td>
                <td>
                  Ujian : {{$item->status_ujian}} ({{$item->keterangan_ujian}})<br />
                  Berkas : {{$item->status_berkas}} ({{$item->keterangan_berkas}}) <br />
                  Wawancara : {{$item->status_wawancara}} ({{$item->keterangan_wawancara}})
                  <br>
                  @if ($item->sanggah->count() != 0)
                  <b><span class="text-red"> Sanggah : {{$item->sanggah->first()->isi}}</span></b>
                  @endif
                </td>
                <td>

                  <form action="/superadmin/peserta/{{$item->id}}" method="post">
                    <a href="/superadmin/formasi/{{$formasi->id}}/peserta/{{$item->id}}/verify"
                      class="btn btn-xs btn-info"><i class="fas fa-check"></i> Verify</a>
                    @csrf
                    <a href="/superadmin/formasi/{{$formasi->id}}/peserta/{{$item->id}}/edit"
                      class="btn btn-xs btn-success"><i class="fas fa-edit"></i> Edit</a>
                    @csrf


                    <a href="/superadmin/formasi/{{$formasi->id}}/peserta/{{$item->id}}/delete"
                      class="btn btn-xs btn-danger" onclick="return confirm('yakin DI Hapus?');"><i
                        class="fas fa-trash"></i>
                      Delete</a>

                    @if ($item->user == null)

                    <a href="/superadmin/formasi/{{$formasi->id}}/peserta/{{$item->id}}/akun"
                      class="btn btn-xs btn-warning"><i class="fas fa-key"></i> Buat Akun</a>
                    @else
                    <a href="/superadmin/formasi/{{$formasi->id}}/peserta/{{$item->id}}/pass"
                      class="btn btn-xs btn-secondary"><i class="fas fa-key"></i> Reset Pass</a>
                    @endif
                  </form>

                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>


@endsection

@push('js')

<!-- DataTables -->
<script src="/theme/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="/theme/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="/theme/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="/theme/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
@endpush