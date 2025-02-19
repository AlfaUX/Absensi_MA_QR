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
                <h2>Data Absensi</h2>

                <!-- Pesan Flashdata -->
                <?php if (session()->getFlashdata('pesan')) : ?>
                    <div class="alert alert-success">
                        <?= session()->getFlashdata('pesan'); ?>
                    </div>
                <?php endif; ?>

                <!-- Tombol Scan QR Code -->
                <a href="<?= base_url('absensi/scan') ?>" class="btn btn-success mb-3">
                    <i class="fas fa-qrcode"></i> Scan QR Code
                </a>

                <!-- Filter Data -->
                <div class="card p-3 bg-purple text-white">
                    <h4>Filter</h4>
                    <form method="GET" action="<?= base_url('absensi') ?>">
                        <div class="row">
                            <!-- Filter Kelas -->
                            <div class="col-md-6">
                                <label for="kelas">Pilih Kelas:</label>
                                <select name="kelas" id="kelas" class="form-control">
                                    <option value="">Semua Kelas</option>
                                    <?php foreach ($kelas as $k): ?>
                                        <option value="<?= esc($k['id_kelas']) ?>" <?= (isset($_GET['kelas']) && $_GET['kelas'] == $k['id_kelas']) ? 'selected' : '' ?>>
                                            <?= esc($k['kelas']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <!-- Filter Tanggal -->
                            <div class="col-md-6">
                                <label for="tanggal">Pilih Tanggal:</label>
                                <input type="date" name="tanggal" id="tanggal" class="form-control" value="<?= isset($_GET['tanggal']) ? esc($_GET['tanggal']) : '' ?>">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-light mt-3">Filter</button>
                    </form>
                </div>

                <!-- Tabel Data Absensi -->
                <table class="table mt-4 table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>No</th>
                            <th>NISN</th>
                            <th>Nama Siswa</th>
                            <th>Kelas</th>
                            <th>Waktu Absensi</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($absensi) && is_array($absensi)) : ?>
                            <?php $no = 1; ?>
                            <?php foreach ($absensi as $a) : ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= esc($a['nisn']); ?></td>
                                <td><?= esc($a['nama_siswa']); ?></td>
                                <td><?= esc($a['kelas']); ?></td>
                                <td><?= esc($a['waktu_absensi']); ?></td>
                                <td><?= esc($a['keterangan']); ?></td>
                                <td>
                                    <!-- Tombol Edit -->
                                    <button type="button" class="btn btn-warning btn-edit" 
                                        data-id="<?= $a['id_absensi'] ?>" 
                                        data-keterangan="<?= $a['id_keterangan'] ?>" 
                                        data-bs-toggle="modal" data-bs-target="#editModal">
                                        Edit
                                    </button>
                                    <!-- Tombol Hapus -->
                                    <a href="<?= base_url('absensi/hapus/' . $a['id_absensi']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus absensi ini?')">
                                        <i class="fas fa-trash"></i> Hapus
                                    </a>
                                </td>
                            </tr>

                            <!-- Modal Edit -->
                            <div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Keterangan</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="<?= base_url('absensi/update') ?>" method="POST">
                                            <div class="modal-body">
                                                <input type="hidden" name="id_absensi" id="id_absensi">
                                                <label for="id_keterangan">Keterangan:</label>
                                                <select name="id_keterangan" id="id_keterangan" class="form-control">
                                                <?php if (!empty($keterangan)): ?>
                                                    <?php foreach ($keterangan as $ket): ?>
                                                        <option value="<?= $ket['id'] ?>" <?= $ket['id'] == $a['id_keterangan'] ? 'selected' : '' ?>>
                                                            <?= esc($ket['keterangan']) ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                <?php else: ?>
                                                    <option value="">Data tidak ditemukan</option>
                                                <?php endif; ?>
                                                </select>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="7">Data absensi tidak tersedia.</td>
                                </tr>
                            <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>



    <?= $this->endSection() ?>

    <!-- Footer -->
    <?= $this->include('layout/footer')?>
    <!-- ./wrapper -->

    <!-- jQuery -->

    <script>
        $(document).ready(function() {
            $('.btn-edit').on('click', function() {
                var id = $(this).data('id');
                var keterangan = $(this).data('keterangan');

                $('#id_absensi').val(id);
                $('#id_keterangan').val(keterangan);
            });
        });
    </script>
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
