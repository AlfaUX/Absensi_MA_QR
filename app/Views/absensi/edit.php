
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Absensi MA Trisula</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url()?>/templates/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="<?= base_url()?>/templates/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?= base_url()?>/templates/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="<?= base_url()?>/templates/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url()?>/templates/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?= base_url()?>/templates/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?= base_url()?>/templates/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="<?= base_url()?>/templates/plugins/summernote/summernote-bs4.min.css">
  
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <?= $this->include('layout/navbar')?>
        <?= $this->include('layout/sidebar')?>
        <div class="content-wrapper">
            <div class="content-header">
              <div class="container-fluid">
                <div class="row mb-2">
                  <div class="col-sm-6">
                    <h1 class="m-0">Edit Presensi</h1>
                  </div><!-- /.col -->
                  <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                      <li class="breadcrumb-item"><a href="#">Home</a></li>
                      <li class="breadcrumb-item active">Edit Presensi</li>
                    </ol>
                  </div>
                </div>
              </div>
            </div>
            <section class="content">
                <div class="container-fluid">
                    <div>
                        <form action="<?= base_url('absensi/update') ?>" method="POST">
                            <input type="hidden" name="id_absensi" value="<?= $absensi['id_absensi'] ?>">
                    
                            <div class="mb-3">
                                <label for="nisn" class="form-label">NISN</label>
                                <input type="text" class="form-control" id="nisn" value="<?= esc($absensi['nisn']) ?>" readonly>
                            </div>
                    
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Siswa</label>
                                <input type="text" class="form-control" id="nama" value="<?= esc($absensi['nama_siswa']) ?>" readonly>
                            </div>
                    
                            <div class="mb-3">
                                <label for="id_keterangan" class="form-label">Keterangan</label>
                                <select name="id_keterangan" id="id_keterangan" class="form-control">
                                    <?php foreach ($keterangan as $ket): ?>
                                        <option value="<?= $ket['id'] ?>" <?= $ket['id'] == $absensi['id_keterangan'] ? 'selected' : '' ?>>
                                            <?= esc($ket['keterangan']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div> <br>
                    
                    
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            <a href="<?= base_url('absensi') ?>" class="btn btn-secondary">Batal</a>
                        </form>
                
                    </div>
                </div>
            </section>
        </div>
        <?= $this->include('layout/footer')?>
    </div>
    
    <!-- jQuery -->
    <script src="<?= base_url()?>/templates/plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="<?= base_url()?>/templates/plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
    $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url()?>/templates/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- ChartJS -->
    <script src="<?= base_url()?>/templates/plugins/chart.js/Chart.min.js"></script>
    <!-- Sparkline -->
    <script src="<?= base_url()?>/templates/plugins/sparklines/sparkline.js"></script>
    <!-- JQVMap -->
    <script src="<?= base_url()?>/templates/plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="<?= base_url()?>/templates/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="<?= base_url()?>/templates/plugins/jquery-knob/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="<?= base_url()?>/templates/plugins/moment/moment.min.js"></script>
    <script src="<?= base_url()?>/templates/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="<?= base_url()?>/templates/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Summernote -->
    <script src="<?= base_url()?>/templates/plugins/summernote/summernote-bs4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="<?= base_url()?>/templates/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url()?>/templates/dist/js/adminlte.js"></script>
</body>
</html>

