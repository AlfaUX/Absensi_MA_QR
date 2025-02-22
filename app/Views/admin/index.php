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
        
        <!-- Admin List View -->
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 page-header">Manajemen Data Admin</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Data Admin</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            
            <section class="content">
                <div class="container-fluid">
                    <div class="content-card">
                        <a href="<?= base_url('admin/create') ?>" class="btn btn-primary btn-add">
                            <i class="fas fa-user-plus"></i>Tambah Admin
                        </a>
                        
                        <div class="table-container">
                            <table class="table custom-table">
                                <thead>
                                    <tr>
                                        <th width="10%">ID</th>
                                        <th width="30%">Username</th>
                                        <th width="35%">Nama</th>
                                        <th width="25%">Aksi</th>
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
                                                    <a href="<?= base_url('admin/edit/' . $admin['id_admin']) ?>" 
                                                       class="btn btn-warning btn-action">
                                                        <i class="fas fa-edit"></i> Edit
                                                    </a>
                                                    <a href="<?= base_url('admin/delete/' . $admin['id_admin']) ?>" 
                                                       class="btn btn-danger btn-action"
                                                       onclick="return confirm('Yakin ingin menghapus admin ini?');">
                                                        <i class="fas fa-trash"></i> Hapus
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <tr>
                                            <td colspan="4">
                                                <div class="empty-state">
                                                    <i class="fas fa-users"></i>
                                                    <p>Tidak ada data admin.</p>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
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