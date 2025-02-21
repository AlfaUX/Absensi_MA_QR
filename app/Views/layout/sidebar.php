<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= base_url('/pages/dashboard')?>" class="brand-link">
      <img src="<?= base_url()?>/templates/dist/img/logo_MA.png" alt="Logo MA Trisula" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-bold" style="font-size: 17px;">Madrasah Aliyah Trisula</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
              <i class="fas fa-user-circle fa-2x"></i> <!-- Icon Font Awesome -->
          </div>
          <div class="info">
              <a href="#" class="d-block"><?= session('nama') ?? 'Guest' ?></a>
          </div>
      </div>


      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="<?= base_url('/pages/dashboard')?>" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Data Guru & Siswa
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url('#')?>" class="nav-link">
                  <i class="fas fa-chevron-right nav-icon"></i>
                  <p>Data Guru</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('/siswa/index')?>" class="nav-link">
                  <i class="fas fa-chevron-right nav-icon"></i>
                  <p>Data Siswa</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link">
              <i class="nav-icon fas fa-clipboard-list"></i>
              <p>
                Data Absensi
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url('#')?>" class="nav-link">
                  <i class="fas fa-chevron-right nav-icon"></i>
                  <p>Absensi Guru</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('absensi/index')?>" class="nav-link">
                  <i class="fas fa-chevron-right nav-icon"></i>
                  <p>Absensi Siswa</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a class="nav-link">
              <i class="nav-icon fas fa-download"></i>
              <p>
                Download
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url('laporan/index')?>" class="nav-link">
                  <i class="fas fa-chevron-right nav-icon"></i>
                  <p>Download Laporan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('/pages/absensi_siswa')?>" class="nav-link">
                  <i class="nav-icon fas fa-qrcode"></i>
                  <p>Download QR Code</p>
                </a>
              </li>
            </ul>
          </li>


          <li class="nav-header">Manajemen Admin</li>
          <li class="nav-item">
            <a href="<?= base_url('admin/index')?>" class="nav-link">
              <i class="nav-icon far fa-user"></i>
              <p>
                Data Admin
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url()?>/templates/kanban.html" class="nav-link">
              <i class="nav-icon fas fa-school"></i>
              <p>
                Profil Sekolah
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('absensi/scan') ?>" class="nav-link">
              <i class="nav-icon fas fa-clipboard-user"></i>
              <p>
                Presensi
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('logout') ?>" class="nav-link" style="color: white; background-color: red;">
                <i class="nav-icon fas fa-sign-out-alt"></i>
                <p>Logout</p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>