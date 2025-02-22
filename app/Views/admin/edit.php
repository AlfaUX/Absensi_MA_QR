<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Management - MA Trisula</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="<?= base_url()?>/templates/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url()?>/templates/dist/css/adminlte.min.css">
    <style>
        .content-card {
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            margin: 20px 0;
            padding: 25px;
        }
        
        .table-container {
            margin-top: 20px;
            border-radius: 10px;
            overflow: hidden;
        }
        
        .custom-table {
            width: 100%;
            margin-bottom: 0;
        }
        
        .custom-table thead th {
            background-color: #f4f6f9;
            border-bottom: 2px solid #dee2e6;
            color: #495057;
            font-weight: 600;
            padding: 15px;
        }
        
        .custom-table tbody tr:hover {
            background-color: #f8f9fa;
        }
        
        .custom-table td {
            padding: 15px;
            vertical-align: middle;
        }
        
        .btn-add {
            padding: 10px 20px;
            font-weight: 500;
            border-radius: 8px;
            transition: all 0.3s ease;
        }
        
        .btn-add i {
            margin-right: 8px;
        }
        
        .btn-action {
            padding: 6px 12px;
            margin: 0 3px;
            border-radius: 6px;
            transition: all 0.3s ease;
        }
        
        .btn-action:hover {
            transform: translateY(-2px);
        }
        
        .form-card {
            max-width: 700px;
            margin: 20px auto;
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
        
        .btn-form {
            padding: 12px 25px;
            font-weight: 500;
            border-radius: 8px;
            transition: all 0.3s ease;
        }
        
        .btn-form:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }
       
        
        .password-hint {
            color: #6c757d;
            font-size: 0.9em;
            margin-top: 5px;
        }
        
        .empty-state {
            text-align: center;
            padding: 40px;
            color: #6c757d;
        }
        
        .empty-state i {
            font-size: 48px;
            margin-bottom: 20px;
            color: #dee2e6;
        }
    </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <?= $this->include('layout/navbar')?>
        <?= $this->include('layout/sidebar')?>
        
        <!-- Admin Edit View -->
        <div class="content-wrapper" > <!-- Toggle between views -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 page-header">Edit Data Admin</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Edit Data Admin</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            
            <section class="content">
                <div class="container-fluid">
                    <div class="form-card">
                        <form action="<?= site_url('admin/update/' . $admin['id_admin']) ?>" method="post">
                            <div class="form-group">
                                <label for="nama">
                                    <i class="fas fa-user mr-2"></i>Nama
                                </label>
                                <input type="text" id="nama" name="nama" 
                                       class="form-control" value="<?= $admin['nama'] ?>" 
                                       required placeholder="Masukkan nama lengkap">
                            </div>
                            
                            <div class="form-group">
                                <label for="username">
                                    <i class="fas fa-user-tag mr-2"></i>Username
                                </label>
                                <input type="text" id="username" name="username" 
                                       class="form-control" value="<?= $admin['username'] ?>" 
                                       required placeholder="Masukkan username">
                            </div>
                            
                            <div class="form-group">
                                <label for="password">
                                    <i class="fas fa-lock mr-2"></i>Password
                                </label>
                                <input type="password" id="password" name="password" 
                                       class="form-control" placeholder="Masukkan password baru">
                                <p class="password-hint">
                                    <i class="fas fa-info-circle mr-1"></i>
                                    Kosongkan jika tidak ingin mengubah password
                                </p>
                            </div>
                            
                            <div class="text-center mt-4">
                                <button type="submit" class="btn btn-primary btn-form">
                                    <i class="fas fa-save mr-2"></i>Update
                                </button>
                                <a href="<?= site_url('admin/index') ?>" class="btn btn-secondary btn-form ml-2">
                                    <i class="fas fa-times mr-2"></i>Batal
                                </a>
                            </div>
                        </form>
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
