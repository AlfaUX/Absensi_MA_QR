<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    
    <!-- Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    
    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    
    <style>
        body {
            background-color: #f8f9fa;
        }
        .login-container {
            max-width: 450px;
            margin: 50px auto;
            padding: 30px;
            background: white;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        .logo-text {
            font-family: "Playfair Display", serif;
            font-weight: 700;
            text-align: center;
            margin-bottom: 20px;
        }
        button{
            gap: 10px;
            margin: 5px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="login-container">
        <div class="text-center">
            <img src="<?= base_url()?>/templates/dist/img/logo_MA.png" alt="Logo MA" width="150">
            <h4 class="logo-text">Absensi Madrasah Aliyah Trisula</h4>
        </div>

        <!-- Menampilkan pesan error jika login gagal -->
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>

        <form action="<?= base_url('/pages/admin_login/prosesLogin') ?>" method="POST">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" name="username" id="username" placeholder="Masukkan username" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Masukkan password" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Login</button>
            <button class="btn btn-primary mt-3" onclick="window.location.href='<?= base_url('/') ?>'">
            Absensi
            </button>        
        </form>
    </div>
</div>

</body>
</html>
