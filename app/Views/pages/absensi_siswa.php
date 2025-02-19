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
                    <h1 class="m-0">Data Absensi Siswa</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Data Absensi</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <h4>Scan QR Code</h4>
            <form id="scanForm" class="mt-3">
                <input type="text" id="nisn" name="nisn" class="form-control" placeholder="Scan QR Code..." required>
                <button type="submit" class="btn btn-primary mt-2">Absen</button>
            </form>

            <table class="table mt-4">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>NISN</th>
                        <th>Absen Masuk</th>
                        <th>Absen Pulang</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($absensi as $row): ?>
                    <tr>
                        <td><?= esc($row['nama']) ?></td>
                        <td><?= esc($row['nisn']) ?></td>
                        <td><?= esc($row['absen_masuk']) ?: '-' ?></td>
                        <td><?= isset($row['absen_pulang']) ? esc($row['absen_pulang']) : '-' ?></td>
                        <td><?= esc($row['keterangan']) ?></td>
                        <td>
                            <button class="btn btn-warning btn-sm edit-keterangan" data-id="<?= esc($row['id']) ?>" data-keterangan="<?= esc($row['keterangan']) ?>">
                                <i class="fas fa-edit"></i> Edit
                            </button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

        </div>
    </section>
    </div>

    <!-- Modal Edit Keterangan -->
    <div class="modal fade" id="editKeteranganModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Keterangan</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form id="editKeteranganForm">
                        <input type="hidden" id="absensi_id">
                        <select id="keterangan" class="form-control">
                            <option value="Masuk">Masuk</option>
                            <option value="Terlambat">Terlambat</option>
                            <option value="Izin">Izin</option>
                            <option value="Alpha">Alpha</option>
                            <option value="Tanpa Keterangan">Tanpa Keterangan</option>
                        </select>
                        <button type="submit" class="btn btn-primary mt-2">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

  <!-- /.content-wrapper -->
  <?= $this->include('layout/footer')?>
</div>
<!-- ./wrapper -->

<!-- Tambahkan ini di bawah form scan QR -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function () {
        // Scan QR Code (AJAX)
        $('#scanForm').submit(function (e) {
            e.preventDefault();
            let nisn = $('#nisn').val().trim();

            $.ajax({
                url: '<?= base_url("absensi_siswa/scanQR") ?>',
                type: 'POST',
                data: { nisn: nisn },
                dataType: 'json',
                success: function (response) {
                    if (response.status === 'success') {
                        Swal.fire('Berhasil!', response.message, 'success').then(() => {
                            location.reload(); // Reload untuk update tabel
                        });
                    } else {
                        Swal.fire('Gagal!', response.message, 'error');
                    }
                },
                error: function () {
                    Swal.fire('Error!', 'Terjadi kesalahan saat memproses data.', 'error');
                }
            });
        });

        // Buka Modal Edit Keterangan
        $(document).ready(function() {
        $('.edit-keterangan').click(function() {
            let id = $(this).data('id');
            let keterangan = $(this).data('keterangan');

            $('#absensi_id').val(id);
            $('#keterangan').val(keterangan);
            $('#editKeteranganModal').modal('show');
        });

        $('#editKeteranganForm').submit(function(e) {
            e.preventDefault();
            let id = $('#absensi_id').val();
            let keterangan = $('#keterangan').val();

            $.ajax({
                url: '<?= site_url("absensi_siswa/updateKeterangan") ?>',
                type: 'POST',
                data: { id: id, keterangan: keterangan },
                success: function(response) {
                    location.reload(); // Refresh halaman setelah update
                },
                error: function() {
                    alert('Gagal mengupdate keterangan');
                }
            });
        });
    });
    });
</script>

<script>
    var base_url = "<?= base_url() ?>";
</script>
<script src="<?= base_url('public/js/absensi_siswa.js') ?>"></script>

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
