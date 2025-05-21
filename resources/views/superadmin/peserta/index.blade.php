@extends('layouts.app')

@push('css')
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
@endpush
@section('title')
ADMIN
@endsection
@section('content')
<br />
<div class="row">
    <div class="col-12">
        <a href="/superadmin/peserta/create" class="btn btn-sm bg-gradient-purple"><i class="fas fa-plus"></i> Tambah
            Peserta</a>
        <br /><br />
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data Peserta</h3>
                <div class="card-tools">
                    <form method="get" action="/superadmin/peserta/search">
                        <div class="input-group input-group-sm" style="width: 250px;">
                            <input type="text" name="search" class="form-control float-right" value="{{old('search')}}"
                                placeholder="Nama / NIK">

                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap table-sm">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>FORMASI</th>
                            <th>NIK (username login)</th>
                            <th>Nama</th>
                            <th>Telp</th>
                            <th>Tgl lahir</th>
                            <th>Kampus/Jurusan</th>
                            <th>Tahun Lulus</th>
                            <th>Email</th>
                            <th>File</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    @php
                    $no =1;
                    @endphp
                    <tbody>
                        @foreach ($data as $key => $item)
                        <tr style="font-size:11px; font-family:Arial, Helvetica, sans-serif">
                            <td>{{$no++}}</td>
                            <td>{{$item->kategori == null ? '' : $item->kategori->nama}}</td>
                            <td>{{$item->nik}}</td>
                            <td>{{$item->nama}}</td>
                            <td>{{$item->telp}}</td>
                            <td>{{$item->tgl}}</td>
                            <td>{{$item->kampus}}</br>{{$item->jurusan}}</td>
                            <td>{{$item->tahun_lulus}}</td>
                            <td>{{$item->email}}</td>
                            <td>
                                @if ($item->file == null)

                                @else
                                <a href="/storage/peserta/{{$item->file}}">Download</a>
                                @endif
                            </td>
                            <td>
                                Ujian : {{$item->status_ujian}} ({{$item->keterangan_ujian}})<br />
                                Berkas : {{$item->status_berkas}} ({{$item->keterangan_berkas}}) <br />
                                Wawancara : {{$item->status_wawancara}} ({{$item->keterangan_wawancara}}) <br />
                                <hr>
                                @if ($item->sanggah->count() != 0)
                                Sanggah : {{$item->sanggah->first()->isi}}
                                @endif
                            </td>
                            <td>

                                <form action="/superadmin/peserta/{{$item->id}}" method="post">
                                    <a href="/superadmin/peserta/{{$item->id}}/verify" class="btn btn-xs btn-info"><i
                                            class="fas fa-check"></i> Verify</a>
                                    @csrf
                                    <a href="/superadmin/peserta/{{$item->id}}/edit" class="btn btn-xs btn-success"><i
                                            class="fas fa-edit"></i> Edit</a>
                                    @csrf
                                    @method('delete')

                                    <button type="submit" class="btn btn-xs btn-danger"
                                        onclick="return confirm('yakin DI Hapus?');"><i class="fas fa-trash"></i>
                                        Delete</button>

                                    @if ($item->user == null)

                                    <a href="/superadmin/peserta/{{$item->id}}/akun" class="btn btn-xs btn-warning"><i
                                            class="fas fa-key"></i> Buat Akun</a>
                                    @else
                                    <a href="/superadmin/peserta/{{$item->id}}/pass" class="btn btn-xs btn-secondary"><i
                                            class="fas fa-key"></i> Reset Pass</a>
                                    @endif
                                </form>

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        {{-- {{$data->links()}} --}}
    </div>
</div>

@endsection

@push('js')
@endpush