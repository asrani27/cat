<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Rekrutmen</title>

  <link rel="stylesheet" href="/theme/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="/theme/dist/css/adminlte.min.css">
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  @toastr_css
</head>

<body class="hold-transition layout-top-nav">
  <div class="wrapper">
    <nav class="main-header navbar navbar-expand-md navbar-light navbar-white bg-gradient-success">
      <div class="container">
        <a href="/home/peserta" class="navbar-brand">

          <img src="/theme/logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
          <span class="brand-text font-weight-light"><strong>Rekrutmen Tenaga RSUD Sultan Suriansyah</strong></span>
        </a>

        <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse"
          aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse order-3" id="navbarCollapse">
          <!-- Left navbar links -->
          <ul class="navbar-nav">

          </ul>
        </div>

        <!-- Right navbar links -->
        <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
          <li class="nav-item">
            <a href="/logout" class="nav-link" onclick="return confirm('Yakin Ingin Keluar Dari Aplikasi?');"><i
                class="fas fa-sign-out-alt"></i></a>
          </li>

        </ul>
      </div>
    </nav>
    <!-- /.navbar -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="background-color: silver">

      <!-- Main content -->
      <div class="content">
        <div class="container">
          <br />
          <div class="row">
            <div class="col-md-2 col-sm-6 col-12">
              <div class="info-box">
                <div class="info-box-content text-center">
                  <span class="info-box-text">NIK</span>
                  <span class="info-box-number">{{$peserta->nik}}</span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-2 col-sm-6 col-12">
              <div class="info-box">
                <div class="info-box-content text-center">
                  <span class="info-box-text">NAMA PESERTA</span>
                  <span class="info-box-number">{{$peserta->nama}}</span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-2 col-sm-6 col-12">
              <div class="info-box">
                <div class="info-box-content text-center">
                  <span class="info-box-text">BATAS WAKTU</span>
                  <span class="info-box-number">{{$waktu}} Menit</span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-2 col-sm-6 col-12">
              <div class="info-box">
                <div class="info-box-content text-center">
                  <span class="info-box-text">JUMLAH SOAL</span>
                  <span class="info-box-number">{{$jmlsoal}}</span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <div class="col-md-2 col-sm-6 col-12">
              <div class="info-box">
                <div class="info-box-content text-center">
                  <span class="info-box-text text-success">SUDAH DI JAWAB</span>
                  <span class="info-box-number text-success">{{$jmlsoal - $jmlbelumjawab}}</span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <div class="col-md-2 col-sm-6 col-12">
              <div class="info-box">
                <div class="info-box-content text-center">
                  <span class="info-box-text text-danger">BELUM DI JAWAB</span>
                  <span class="info-box-number text-danger">{{$jmlbelumjawab}}</span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->
          </div>

          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <a href="/home/peserta" class="btn btn-sm btn-secondary">Home</a>
                  <a href="/home/peserta/lihatdata" class="btn btn-sm btn-primary">Update Data Peserta</a>
                  <a href="/home/peserta/gantipass" class="btn btn-sm btn-info">Ganti Password</a>
                  <a href="https://wa.me/{{app()->make(\App\Helpers\Helper::class)->hotline()}}" target="_blank"
                    class="btn btn-sm btn-danger"> <i class="fa fa-phone"></i> Hotline
                    ({{ app()->make(\App\Helpers\Helper::class)->hotline() }})</a>
                </div>
              </div>
            </div>
          </div>


          @if ($peserta->kampus == null)
          <form method="post" action="/home/peserta/upload" enctype="multipart/form-data">
            @csrf
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-body">
                    <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-4 col-form-label">Nama Sekolah/PTS/PTN</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" name="kampus" value="{{old('kampus')}}"
                          placeholder="Sekolah/PTS/PTN" required>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-4 col-form-label">Nama Jurusan</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" name="jurusan" value="{{old('jurusan')}}"
                          placeholder="Jurusan" required>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-4 col-form-label">Tahun Lulus</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" name="tahun_lulus" value="{{old('tahun_lulus')}}"
                          placeholder="tahun lulus" required>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-4 col-form-label">Tanggal Lahir</label>
                      <div class="col-sm-8">
                        <input type="date" class="form-control" name="tgl" value="{{old('tgl')}}" required>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-4 col-form-label"></label>
                      <div class="col-sm-8">
                        <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                      </div>
                    </div>





                  </div>
                  <!-- /.info-box -->
                </div>
              </div>
              <!-- /.col -->
            </div>
          </form>
          @endif

          @if ($peserta->file == null)

          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-4 col-form-label">Berkas File (PDF) maks 8MB, lebih kecil
                      lebih baik</label>
                    <div class="col-sm-8">
                      <input type="file" id="fileInput" />
                      <div id="progress">
                        <span id="progressText">Progress: 0%</span>
                        <i id="loadingIcon" class="fa fa-spinner fa-spin text-primary ml-2" style="display: none;"></i>

                        <span id="uploadingText" class="text-muted ml-2" style="display: none;">Sedang mengupload,
                          tunggu sampai selesai...</span>
                      </div>
                     
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          @endif

          @yield('content')
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Main Footer -->
    <footer class="main-footer text-center">
      {{-- <div class="float-right d-none d-sm-inline">
        CAT
      </div> --}}
      <strong>Copyright &copy; 2021 <a href="https://asrandev.com">Diskominfotik Kota Banjarmasin</a>.</strong>
    </footer>
  </div>
  <!-- ./wrapper -->

  <!-- REQUIRED SCRIPTS -->

  <!-- jQuery -->
  <script src="/theme/plugins/jquery/jquery.min.js"></script>
  <script src="/theme/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="/theme/dist/js/adminlte.min.js"></script>
  @toastr_js
  @toastr_render
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
</body>

</html>