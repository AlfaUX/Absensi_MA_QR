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

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <div class="content-header">
          <div class="container-fluid">
              <div class="row mb-2">
                  <div class="col-sm-6">
                      <h1 class="m-0">Data guru</h1>
                  </div>
                  <div class="col-sm-6">
                      <ol class="breadcrumb float-sm-right">
                          <li class="breadcrumb-item"><a href="#">Home</a></li>
                          <li class="breadcrumb-item active">Data guru</li>
                      </ol>
                  </div>
              </div>
          </div>
      </div>

      <!-- Main content -->
      <section class="content">
          <div class="container-fluid">
              <a href="<?= base_url('guru/tambah') ?>" class="btn btn-primary">Tambah guru</a>
              <form action="<?= base_url('guru/import_csv') ?>" method="post" enctype="multipart/form-data" class="mt-3">
                  <input type="file" name="csv_file" accept=".csv" required>
                  <button type="submit" class="btn btn-success">Import CSV</button>
                  <a href="<?= base_url('guru/download_template') ?>" class="btn btn-primary">Download Template CSV</a>
              </form>
              <table class="table mt-4">
                  <thead>
                      <tr>
                          <th>Nama</th>
                          <th>Email</th>
                          <th>NUPTK</th>
                          <th>Created At</th>
                          <th>Updated At</th>
                          <th>Action</th> <!-- Tambahkan Kolom Aksi -->
                      </tr>
                  </thead>
                  <tbody>
                      <?php foreach ($guru as $row): ?>
                      <tr>
                          <td><?= $row['nama'] ?></td>
                          <td><?= $row['email'] ?></td>
                          <td><?= $row['nuptk'] ?></td>
                          <td><?= $row['created_at'] ?></td>
                          <td><?= $row['updated_at'] ?></td>
                          <td>
                              <a href="<?= base_url('guru/edit/'.$row['id']) ?>" class="btn btn-warning btn-sm">
                                  <i class="fas fa-edit"></i>
                              </a>
                              <a href="<?= base_url('guru/delete/'.$row['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">
                                  <i class="fas fa-trash"></i>
                              </a>
                              <a href="<?= base_url('guru/generate_qr/'.$row['id']) ?>" class="btn btn-success btn-sm">
                                  <i class="fas fa-qrcode"></i> Tampilkan QR
                              </a>
                              <a href="<?= base_url('guru/download_qr/'.$row['id']) ?>" class="btn btn-primary btn-sm">
                                  <i class="fas fa-download"></i> Download QR
                              </a>
                          </td>
                      </tr>
                      <?php endforeach; ?>
                  </tbody>
              </table>

          </div>
      </section>
  </div>
  <!-- /.content-wrapper -->
  <?= $this->include('layout/footer')?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

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
