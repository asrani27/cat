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
                                    @if ($peserta->file != null)

                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-4 col-form-label">Berkas File PDF
                                            (Maks 8MB) lebih kecil lebih baik</label>
                                        <div class="col-sm-8">
                                            <input type="file" class="form-control" id="fileInput" />
                                            <div id="progress" style="text-align: left">
                                                <span id="progressText">Progress: 0%</span>
                                                <i id="loadingIcon" class="fa fa-spinner fa-spin text-primary ml-2"
                                                    style="display: none;"></i>

                                                <span id="uploadingText" class="text-muted ml-2"
                                                    style="display: none;">Sedang mengupload,
                                                    tunggu sampai selesai...</span>
                                            </div>
                                            <div style="text-align: left">

                                                <b>
                                                    File Anda :<a href="/file-peserta/{{ $peserta->file}}"
                                                        target="_blank"> <i class="fa fa-download"></i> Download </a>
                                                </b>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
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

<script>
    document.getElementById('file').addEventListener('change', function () {
     const maxSize = 8 * 1000 * 1000; // 8 MB
    if (this.files[0].size > maxSize) {
        alert('Ukuran file terlalu besar! kurangi lagi size nya.');
        this.value = ''; // Reset input
    }
});
</script>
<script src="https://cdn.jsdelivr.net/npm/resumablejs/resumable.js"></script>
<script>
    const MAX_FILE_SIZE = 8 * 1024 * 1024;
    const r = new Resumable({
            target: "{{ route('upload.chunk') }}",
            query: {
                _token: document.querySelector('meta[name="csrf-token"]').content
            },
            chunkSize: 1 * 512 * 512, // 1MB
            simultaneousUploads: 1,
            testChunks: false,
        });

        r.assignBrowse(document.getElementById('fileInput'));

        r.on('fileAdded', function (file) {
            if (file.size > MAX_FILE_SIZE) {
                alert('Ukuran file maksimal 8 MB!');
                return;
            }
            document.getElementById('loadingIcon').style.display = 'inline-block';
            document.getElementById('uploadingText').style.display = 'inline-block';
            r.upload();
        });

        r.on('fileProgress', function (file) {
            const progress = Math.floor(file.progress() * 100);
            document.getElementById('progressText').innerText = 'Progress: ' + progress + '%';
        });

        r.on('fileSuccess', function (file, message) {
            const res = JSON.parse(message);
            if (res.done) {
                
                document.getElementById('loadingIcon').style.display = 'none';
                document.getElementById('uploadingText').style.display = 'none';
                location.reload();  
                alert('Berhasil Di Upload');
            }
        });

       r.on('fileError', function (file, message) {
          try {
              const res = JSON.parse(message);
              if (res.message) {
                  alert(res.message); // ← tampilkan pesan dari server
              } else {
                  alert('Upload gagal!');
              }
          } catch (e) {
              alert('Terjadi kesalahan saat upload!');
              console.error(e);
          }

          // Sembunyikan loading
          document.getElementById('loadingIcon').style.display = 'none';
          document.getElementById('uploadingText').style.display = 'none';
      });

</script>
@endpush