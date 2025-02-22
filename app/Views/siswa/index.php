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
                            <h1 class="m-0">Data Siswa</h1>
                        </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Data Siswa</li>
                        </ol>
                    </div>
                    </div>
                </div>
            </div>
            <section class="content">
                <div class="container-fluid">
                    <!-- Pesan Flashdata -->
                    <?php if (session()->getFlashdata('pesan')) : ?>
                        <div class="alert alert-success">
                            <?= session()->getFlashdata('pesan'); ?>
                        </div>
                    <?php endif; ?>
            
                    <!-- Tombol Tambah Siswa -->
                    <a href="<?= base_url('siswa/tambah') ?>" class="btn btn-primary mb-3">
                        <i class="fas fa-plus"></i> Tambah Data Siswa
                    </a>
            
                    <!-- Filter Data -->
                    <div class="card p-3 bg-purple text-white">
                        <h4>Filter</h4>
                        <div class="mb-2">
                            <label>Kelas:</label>
                            <div class="btn-group">
                                <a href="<?= base_url('siswa') ?>" class="btn btn-light <?= empty($_GET['kelas']) ? 'active' : '' ?>">Semua</a>
                                <?php foreach ($kelas as $k): ?>
                                    <a href="<?= base_url('siswa?kelas=' . urlencode($k['kelas'])) ?>" 
                                    class="btn btn-light <?= (isset($_GET['kelas']) && $_GET['kelas'] == $k['kelas']) ? 'active' : '' ?>">
                                        <?= $k['kelas'] ?>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
            
                    <!-- Tabel Data Siswa -->
                    <table class="table mt-4 table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th>No</th>
                                <th>NISN</th>
                                <th>Nama Siswa</th>
                                <th>Kelas</th>
                                <th>Jenis Kelamin</th>
                                <th>No HP</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($siswa) && is_array($siswa)) :?>
                                <?php $no = 1 ;?>
                                <?php foreach ($siswa as $s) :?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= esc($s['nisn']); ?></td>
                                    <td><?= esc($s['nama_siswa']); ?></td>
                                    <td><?= esc($s['kelas']); ?></td>
                                    <td><?= esc($s['jenis_kelamin']); ?></td>
                                    <td><?= esc($s['no_hp']); ?></td>
                                    <td>
                                        <a href="<?= base_url('siswa/edit/' . ($s['id_siswa'] ?? '')) ?>" class="btn btn-warning btn-sm">Edit</a>
                                        <a href="<?= base_url('siswa/hapus/' .($s['id_siswa'] ?? '')) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus data ini?')">Hapus</a>
                                        <a href="<?= base_url('qrcode/generate/' . $s['id_siswa']) ?>" class="btn btn-sm btn-info">
                                            <i class="fas fa-qrcode"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else:?>
                            <tr>
                                <td colspan="7">Data siswa tidak tersedia.</td>
                            </tr>
                        <?php endif;?>
                        </tbody>
                    </table>
                </div>
            </section>
        </div>

        <!-- Footer -->
        <?= $this->include('layout/footer')?>
        <!-- ./wrapper -->
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
