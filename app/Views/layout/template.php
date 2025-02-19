<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title ?? 'Admin Dashboard' ?></title>

    <!-- Include CSS -->
    <?= $this->include('layout/css') ?>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Navbar -->
        <?= $this->include('layout/navbar') ?>
        
        <!-- Main Sidebar Container -->
        <?= $this->include('layout/sidebar') ?>

        <!-- Content Wrapper -->
        <div class="content-wrapper">
            <!-- Content Header -->

            <!-- Main content -->
            <?= $this->renderSection('content') ?>
        </div>

        <!-- Footer -->
        <?= $this->include('layout/footer') ?>
    </div>

    <!-- Include JavaScript -->
    <?= $this->include('layout/js') ?>
</body>
</html>
