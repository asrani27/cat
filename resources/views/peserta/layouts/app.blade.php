<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>CAT</title>

  <link rel="stylesheet" href="/theme/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="/theme/dist/css/adminlte.min.css">
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  @toastr_css
</head>

<body class="hold-transition layout-top-nav">
  <div class="wrapper">
    <nav class="main-header navbar navbar-expand-md navbar-light navbar-white bg-gradient-teal">
      <div class="container">
        <a href="#" class="navbar-brand">
          {{-- <img src="/theme/logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8"> --}}
          <span class="brand-text font-weight-light"><strong>Rekrutmen Tenaga Ahli Programmer 2022
              Diskominfotik</strong></span>
        </a>

        <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse"
          aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse order-3" id="navbarCollapse">
          <!-- Left navbar links -->
          <ul class="navbar-nav">
            {{-- <li class="nav-item">
              <a href="index3.html" class="nav-link">Home</a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">Contact</a>
            </li>
            <li class="nav-item dropdown">
              <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                class="nav-link dropdown-toggle">Dropdown</a>
              <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                <li><a href="#" class="dropdown-item">Some action </a></li>
                <li><a href="#" class="dropdown-item">Some other action</a></li>

                <li class="dropdown-divider"></li>

                <!-- Level two dropdown-->
                <li class="dropdown-submenu dropdown-hover">
                  <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false" class="dropdown-item dropdown-toggle">Hover for action</a>
                  <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">
                    <li>
                      <a tabindex="-1" href="#" class="dropdown-item">level 2</a>
                    </li>

                    <!-- Level three dropdown-->
                    <li class="dropdown-submenu">
                      <a id="dropdownSubMenu3" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false" class="dropdown-item dropdown-toggle">level 2</a>
                      <ul aria-labelledby="dropdownSubMenu3" class="dropdown-menu border-0 shadow">
                        <li><a href="#" class="dropdown-item">3rd level</a></li>
                        <li><a href="#" class="dropdown-item">3rd level</a></li>
                      </ul>
                    </li>
                    <!-- End Level three -->

                    <li><a href="#" class="dropdown-item">level 2</a></li>
                    <li><a href="#" class="dropdown-item">level 2</a></li>
                  </ul>
                </li>
                <!-- End Level two -->
              </ul>
            </li> --}}
          </ul>
        </div>

        <!-- Right navbar links -->
        <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
          <li class="nav-item">
            <a href="/logout" class="nav-link" onclick="return confirm('Yakin Ingin Keluar Dari Aplikasi?');"><i
                class="fas fa-sign-out-alt"></i></a>
          </li>
          <!-- Messages Dropdown Menu -->
          {{-- <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
              <i class="fas fa-comments"></i>
              <span class="badge badge-danger navbar-badge">3</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
              <a href="#" class="dropdown-item">
                <!-- Message Start -->
                <div class="media">
                  <img src="../../dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                  <div class="media-body">
                    <h3 class="dropdown-item-title">
                      Brad Diesel
                      <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                    </h3>
                    <p class="text-sm">Call me whenever you can...</p>
                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                  </div>
                </div>
                <!-- Message End -->
              </a>
              <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item">
                <!-- Message Start -->
                <div class="media">
                  <img src="../../dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                  <div class="media-body">
                    <h3 class="dropdown-item-title">
                      John Pierce
                      <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                    </h3>
                    <p class="text-sm">I got your message bro</p>
                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                  </div>
                </div>
                <!-- Message End -->
              </a>
              <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item">
                <!-- Message Start -->
                <div class="media">
                  <img src="../../dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                  <div class="media-body">
                    <h3 class="dropdown-item-title">
                      Nora Silvester
                      <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                    </h3>
                    <p class="text-sm">The subject goes here</p>
                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                  </div>
                </div>
                <!-- Message End -->
              </a>
              <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
            </div>
          </li>
          <!-- Notifications Dropdown Menu -->
          <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
              <i class="far fa-bell"></i>
              <span class="badge badge-warning navbar-badge">15</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
              <span class="dropdown-header">15 Notifications</span>
              <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item">
                <i class="fas fa-envelope mr-2"></i> 4 new messages
                <span class="float-right text-muted text-sm">3 mins</span>
              </a>
              <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item">
                <i class="fas fa-users mr-2"></i> 8 friend requests
                <span class="float-right text-muted text-sm">12 hours</span>
              </a>
              <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item">
                <i class="fas fa-file mr-2"></i> 3 new reports
                <span class="float-right text-muted text-sm">2 days</span>
              </a>
              <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button"><i
                class="fas fa-th-large"></i></a>
          </li> --}}
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
                  <span class="info-box-text">NOMOR PESERTA</span>
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

          @if ($peserta->file != null)

          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  Data Berkas telah di upload,
                  <a href="/home/peserta/lihatdata" class="btn btn-sm btn-primary">Lihat Disini</a>
                </div>
              </div>
            </div>
          </div>
          @else
          <form method="post" action="/home/peserta/upload" enctype="multipart/form-data">
            @csrf
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    Harap Isi Dan Upload Berkas Anda
                  </div>
                  <div class="card-body">
                    <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-4 col-form-label">Nama PTS/PTN</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" name="kampus" placeholder="Perguruan Tinggi" required>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-4 col-form-label">Nama Jurusan</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" name="jurusan" placeholder="Jurusan" required>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-4 col-form-label">Tanggal Lahir</label>
                      <div class="col-sm-8">
                        <input type="date" class="form-control" name="tgl" required>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-4 col-form-label">Berkas File (Zip/Rar)</label>
                      <div class="col-sm-8">
                        <input type="file" class="form-control" name="file" required>
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
</body>

</html>