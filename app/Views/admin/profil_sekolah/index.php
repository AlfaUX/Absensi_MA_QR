<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Sekolah</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="<?= base_url()?>/templates/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url()?>/templates/dist/css/adminlte.min.css">
    <style>
        .profile-card {
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            /* margin: 20px 0; */
            padding: 30px;
        }
        
        .school-logo {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .school-logo img {
            max-width: 170px;
            border-radius: 10px;
            padding: 10px;
            background: #fff;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }
        
        .school-logo img:hover {
            transform: scale(1.05);
        }
        
        .profile-info {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 25px;
        }
        
        .profile-info p {
            margin: 15px 0;
            padding: 10px;
            border-bottom: 1px solid #e9ecef;
            font-size: 16px;
        }
        
        .profile-info strong {
            color: #2c3e50;
            min-width: 150px;
            display: inline-block;
        }
        
        .btn-edit {
            background: #007bff;
            color: #fff;
            padding: 12px 25px;
            border-radius: 8px;
            text-decoration: none;
            display: inline-block;
            margin-top: 20px;
            transition: all 0.3s ease;
            border: none;
            font-weight: 500;
        }
        
        .btn-edit:hover {
            background: #0056b3;
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }
        
        .empty-placeholder {
            color: #6c757d;
            font-style: italic;
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
                            <h1 class="m-0 page-header">Profil Sekolah</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Profil Sekolah</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-8 offset-md-2">
                            <div class="profile-card">
                                <div class="school-logo">
                                    <?php if (!empty($profil['logo'])): ?>
                                        <img src="<?= base_url($profil['logo']); ?>" alt="Logo Sekolah">
                                    <?php else: ?>
                                        <div class="empty-placeholder text-center">
                                            <i class="fas fa-school fa-5x mb-3"></i>
                                            <p>Logo belum diunggah</p>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                
                                <div class="profile-info">
                                    <p>
                                        <strong><i class="fas fa-school mr-2"></i>Nama Sekolah:</strong>
                                        <?= !empty($profil['nama_sekolah']) ? esc($profil['nama_sekolah']) : '<span class="empty-placeholder">Belum diisi</span>'; ?>
                                    </p>
                                    <p>
                                        <strong><i class="fas fa-map-marker-alt mr-2"></i>Alamat:</strong>
                                        <?= !empty($profil['alamat']) ? esc($profil['alamat']) : '<span class="empty-placeholder">Belum diisi</span>'; ?>
                                    </p>
                                    <p>
                                        <strong><i class="fas fa-calendar-alt mr-2"></i>Tahun Pelajaran:</strong>
                                        <?= !empty($profil['tahun_pelajaran']) ? esc($profil['tahun_pelajaran']) : '<span class="empty-placeholder">Belum diisi</span>'; ?>
                                    </p>
                                </div>
                                
                                <div class="text-center">
                                    <a href="<?= base_url('admin/profil_sekolah/edit'); ?>" class="btn-edit">
                                        <i class="fas fa-edit mr-2"></i>Edit Profil
                                    </a>
                                </div>
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
</body>
</html>