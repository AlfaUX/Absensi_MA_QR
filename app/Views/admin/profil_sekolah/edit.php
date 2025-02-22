<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Profil Sekolah - MA Trisula</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="<?= base_url()?>/templates/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url()?>/templates/dist/css/adminlte.min.css">
    <style>
        .edit-profile-card {
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            padding: 30px;
        }
        
        .form-group {
            margin-bottom: 25px;
        }
        
        .form-group label {
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 10px;
            display: block;
        }
        
        .form-control {
            border-radius: 8px;
            border: 2px solid #e9ecef;
            padding: 12px;
            transition: all 0.3s ease;
        }
        
        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(0,123,255,.25);
        }
        
        .current-logo {
            margin: 20px 0;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 10px;
            text-align: center;
        }
        
        .current-logo img {
            max-width: 200px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            margin: 10px 0;
        }
        
        .btn-submit {
            background: #007bff;
            color: #fff;
            padding: 12px 25px;
            border-radius: 8px;
            border: none;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .btn-submit:hover {
            background: #0056b3;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }
        
        .btn-back {
            background: #6c757d;
            color: #fff;
            padding: 12px 25px;
            border-radius: 8px;
            border: none;
            font-weight: 500;
            transition: all 0.3s ease;
            margin-left: 10px;
        }
        
        .btn-back:hover {
            background: #5a6268;
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }
        
        .custom-file {
            position: relative;
            display: inline-block;
            width: 100%;
            height: calc(1.5em + .75rem + 2px);
            margin-bottom: 0;
        }
        
        .custom-file-input {
            position: relative;
            z-index: 2;
            width: 100%;
            height: calc(1.5em + .75rem + 2px);
            margin: 0;
            opacity: 0;
        }
        
        .custom-file-label {
            position: absolute;
            top: 0;
            right: 0;
            left: 0;
            z-index: 1;
            height: calc(1.5em + .75rem + 2px);
            padding: .375rem .75rem;
            font-weight: 400;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            border: 1px solid #ced4da;
            border-radius: .25rem;
        }
        
        .custom-file-label::after {
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            z-index: 3;
            display: block;
            height: calc(1.5em + .75rem);
            padding: .375rem .75rem;
            line-height: 1.5;
            color: #495057;
            content: "Browse";
            background-color: #e9ecef;
            border-left: inherit;
            border-radius: 0 .25rem .25rem 0;
        }
    </style>
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
                            <h1 class="m-0 page-header">Edit Profil Sekolah</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Edit Profil Sekolah</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-8 offset-md-2">
                            <div class="edit-profile-card">
                                <form action="<?= base_url('admin/profil_sekolah/update'); ?>" method="post" enctype="multipart/form-data">
                                    <input type="hidden" name="id" value="<?= esc($profil['id']); ?>">
                                    
                                    <div class="form-group">
                                        <label for="nama_sekolah">
                                            <i class="fas fa-school mr-2"></i>Nama Sekolah
                                        </label>
                                        <input type="text" id="nama_sekolah" name="nama_sekolah" 
                                               class="form-control" value="<?= esc($profil['nama_sekolah']); ?>" 
                                               required placeholder="Masukkan nama sekolah">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="alamat">
                                            <i class="fas fa-map-marker-alt mr-2"></i>Alamat
                                        </label>
                                        <input type="text" id="alamat" name="alamat" 
                                               class="form-control" value="<?= esc($profil['alamat']); ?>" 
                                               required placeholder="Masukkan alamat sekolah">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="tahun_pelajaran">
                                            <i class="fas fa-calendar-alt mr-2"></i>Tahun Pelajaran
                                        </label>
                                        <input type="text" id="tahun_pelajaran" name="tahun_pelajaran" 
                                               class="form-control" value="<?= esc($profil['tahun_pelajaran']); ?>" 
                                               required placeholder="Contoh: 2023/2024">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>
                                            <i class="fas fa-image mr-2"></i>Logo Sekolah
                                        </label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="logo" name="logo" accept="image/*">
                                            <label class="custom-file-label" for="logo">Pilih file...</label>
                                        </div>
                                        
                                        <div class="current-logo">
                                            <?php if (!empty($profil['logo'])): ?>
                                                <p class="mb-2">Logo Saat Ini:</p>
                                                <img src="<?= base_url($profil['logo']); ?>" alt="Logo Sekolah">
                                            <?php else: ?>
                                                <p class="text-muted"><em>Belum ada logo diunggah.</em></p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    
                                    <div class="text-center mt-4">
                                        <button type="submit" class="btn btn-submit">
                                            <i class="fas fa-save mr-2"></i>Simpan Perubahan
                                        </button>
                                        <a href="<?= base_url('admin/profil_sekolah/index'); ?>" class="btn btn-back">
                                            <i class="fas fa-arrow-left mr-2"></i>Kembali
                                        </a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        
        <?= $this->include('layout/footer')?>
    </div>

    <script src="<?= base_url()?>/templates/plugins/jquery/jquery.min.js"></script>
    <script src="<?= base_url()?>/templates/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url()?>/templates/dist/js/adminlte.js"></script>
    <script>
        // Update file input label with selected filename
        $('.custom-file-input').on('change', function() {
            let fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').addClass("selected").html(fileName);
        });
    </script>
</body>
</html>