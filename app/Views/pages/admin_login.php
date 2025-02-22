<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <style>
        html, body {
            height: 100%;
            margin: 0;
            overflow: hidden;
        }
        
        .gradient-background {
            min-height: 100vh;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            padding: 20px;
            display: flex;
            align-items: center;
        }

        .container {
            max-width: 1600px;
            margin: auto;
        }

        .logo_MA {
            font-family: "Playfair Display", serif;
            font-weight: 700;
            font-size: 1.5rem;
        }
        
        .card {
            margin: 0 auto;
            max-height: 90vh;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
        }
        
        .logo-img {
            width: 200px;
            height: auto;
        }

        .img-container {
            max-height: 95vh;
            overflow: hidden;
        }
        
        .form-container {
            max-height: 90vh;
            overflow-y: auto;
        }
    </style>
</head>
<body>
    <div class="gradient-background">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-xxl-11">
                    <div class="card border-light-subtle">
                        <div class="row g-0">
                            <div class="col-12 col-md-7 img-container">
                                <img class="img-fluid rounded-start w-100 h-100 object-fit-cover" loading="lazy" src="<?= base_url()?>/templates/dist/img/fotogtk.jpg">
                            </div>
                            <div class="col-12 col-md-5 d-flex align-items-center justify-content-center form-container">
                                <div class="col-12 col-lg-11 col-xl-10">
                                    <div class="card-body p-3 p-md-4">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="mb-4">
                                                    <div class="text-center mb-3">
                                                        <a href="#!">
                                                            <img src="<?= base_url()?>/templates/dist/img/logo_MA.png" class="logo-img" alt="Logo MA">
                                                        </a>
                                                    </div>
                                                    <h4 class="text-center logo_MA">Presensi Madrasah Aliyah Trisula</h4>
                                                </div>
                                            </div>
                                        </div>

                                        <?php if (session()->getFlashdata('error')): ?>
                                            <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                                        <?php endif; ?>

                                        <form action="<?= base_url('/pages/admin_login/prosesLogin') ?>" method="POST">
                                            <div class="row gy-3">
                                                <div class="col-12">
                                                    <div class="form-floating mb-3">
                                                        <input type="text" class="form-control" name="username" id="username" placeholder="Masukkan username" required>
                                                        <label for="username" class="form-label">Username</label>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-floating mb-3">
                                                        <input type="password" class="form-control" name="password" id="password" placeholder="Masukkan password" required>
                                                        <label for="password" class="form-label">Password</label>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="d-grid gap-2">
                                                        <button class="btn btn-dark btn-lg" type="submit">Login</button>
                                                        <a href="<?= base_url('/') ?>" class="btn btn-outline-dark btn-lg">Absensi</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>