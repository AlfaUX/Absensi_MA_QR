<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Laporan Absensi - MA Trisula</title>

  <!-- Google Font & Icons -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?= base_url()?>/templates/dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
    
    <?= $this->include('layout/navbar')?>

    <?= $this->include('layout/sidebar')?>
    
    <?= $this->extend('layout/main') ?>
    
    <?= $this->section('content') ?>
    
    <div class="content-wrapper">
        <div class="container-fluid py-4">
            <div class="content">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0"><i class="fas fa-file-alt"></i> Laporan Absensi</h4>
                    </div>
                    <div class="card-body">
                        <form action="<?= base_url('laporan/generate') ?>" method="post" class="row g-3">
                            <div class="col-md-4">
                                <label for="bulan" class="form-label">Pilih Bulan:</label>
                                <select name="bulan" class="form-select" required>
                                    <?php for ($i = 1; $i <= 12; $i++): ?>
                                        <option value="<?= $i ?>"><?= date('F', mktime(0, 0, 0, $i, 1)) ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="tahun" class="form-label">Pilih Tahun:</label>
                                <select name="tahun" class="form-select" required>
                                    <?php for ($i = date('Y') - 5; $i <= date('Y'); $i++): ?>
                                        <option value="<?= $i ?>"><?= $i ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="format" class="form-label">Format:</label>
                                <select name="format" class="form-select" required>
                                    <option value="excel">Excel</option>
                                    <option value="pdf">PDF</option>
                                </select>
                            </div>
                            <div class="col-12 text-end">
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-download"></i> Download Laporan
                                </button>
                            </div>
                            <a href="<?= base_url('laporan/exportPdf') ?>" class="btn btn-danger">Export PDF</a>
                            <a href="<?= base_url('laporan/exportExcel') ?>" class="btn btn-success">Export Excel</a>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?= $this->endSection() ?>

    <?= $this->include('layout/footer')?>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
