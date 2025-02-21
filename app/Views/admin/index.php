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
    
    <?= $this->extend('layout/main') ?>
    <?= $this->section('content') ?>

    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="content">
                <div >
                    <h2 class="mb-4">Manajemen Data Admin</h2>
            
                    <!-- Button Tambah Admin -->
                    <a href="<?= base_url('admin/create') ?>" class="btn btn-primary mb-3">Tambah Admin</a>
            
                    <!-- Tabel Admin -->
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Username</th>
                                <th>Nama</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($admins)) : ?>
                                <?php foreach ($admins as $admin) : ?>
                                    <tr>
                                        <td><?= esc($admin['id_admin']) ?></td>
                                        <td><?= esc($admin['username']) ?></td>
                                        <td><?= esc($admin['nama']) ?></td>
                                        <td>
                                            <a href="<?= base_url('admin/edit/' . $admin['id_admin']) ?>" class="btn btn-warning btn-sm">Edit</a>
                                            <a href="<?= base_url('admin/delete/' . $admin['id_admin']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus admin ini?');">Hapus</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="4" class="text-center">Tidak ada data admin.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>



    <?php echo $this->endSection(); ?>
    <!-- Footer -->
    <?= $this->include('layout/footer')?>
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

