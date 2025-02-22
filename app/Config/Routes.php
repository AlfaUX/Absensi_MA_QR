<?php

namespace Config;

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');


// Fitur Lain
$routes->get('pages/scan_qr', 'QRController::index');
$routes->post('pages/scan_qr', 'QRController::absen'); // Perbaiki typo "QrController"

// Login & Logout
$routes->get('/pages/admin_login', 'Admin_login::index'); // Halaman login
$routes->post('/pages/admin_login/prosesLogin', 'Admin_login::prosesLogin');
$routes->get('/logout', 'Admin_login::logout');


// Dashboard (Proteksi dengan Filter Auth)
$routes->get('/pages/dashboard', 'Dashboard::index', ['filter' => 'auth']); 
$routes->get('/siswa/index', 'Siswa::index', ['filter' => 'auth']); 
$routes->get('/pages/absensi_siswa', 'Absensi_siswa::index', ['filter' => 'auth']); 

/// Kelola Data Siswa
$routes->get('siswa/index', 'Siswa::index', ['filter' => 'auth']);
$routes->get('/siswa', 'Siswa::index'); // Menampilkan daftar siswa
$routes->get('/siswa/tambah', 'Siswa::tambah'); // Form tambah siswa
$routes->post('/siswa/simpan', 'Siswa::simpan'); // Proses simpan siswa
$routes->get('/siswa/edit/(:num)', 'Siswa::edit/$1'); // Form edit siswa
$routes->post('/siswa/update/(:num)', 'Siswa::update/$1'); // Proses update siswa
$routes->get('/siswa/hapus/(:num)', 'Siswa::hapus/$1'); // Hapus siswa

// qr code siswa
$routes->get('siswa/generate/(:num)', 'Siswa::generate/$1', ['filter' => 'auth']);
$routes->get('qrcode/generate/(:num)', 'QRCodeController::generate/$1');

//data absensi siswa
$routes->get('/absensi/index', 'Absensi::index', ['filter' => 'auth']);
$routes->get('/absensi', 'Absensi::index');
$routes->get('/absensi/scan', 'Absensi::scan');
$routes->post('absensi/prosesScan', 'Absensi::prosesScan');
$routes->post('/absensi/saveScan', 'Absensi::saveScan');
$routes->get('absensi/edit/(:num)', 'Absensi::edit/$1');
$routes->post('absensi/update', 'Absensi::update');
$routes->get('absensi/hapus/(:num)', 'Absensi::hapus/$1');

//download laporan
$routes->get('/laporan/index', 'LaporanController::index', ['filter' => 'auth']);
$routes->post('/laporan/generate', 'LaporanController::generate');
$routes->get('laporan/exportPdf', 'LaporanController::exportPdf');
$routes->get('laporan/exportExcel', 'LaporanController::exportExcel');
$routes->post('laporan/exportPdf', 'LaporanController::exportPdf');
$routes->post('laporan/exportExcel', 'LaporanController::exportExcel');

//data admin
$routes->get('admin/index', 'AdminController::index', ['filter' => 'auth']);               // List admin
$routes->get('admin/create', 'AdminController::create');         // Form tambah admin
$routes->post('admin/store', 'AdminController::store');          // Proses tambah admin
$routes->get('admin/edit/(:num)', 'AdminController::edit/$1');   // Form edit admin
$routes->post('admin/update/(:num)', 'AdminController::update/$1'); // Proses update admin
$routes->get('admin/delete/(:num)', 'AdminController::delete/$1');  // Hapus admin

//profil sekolah
$routes->get('admin/profil_sekolah/index', 'ProfilSekolahController::index', ['filter' => 'auth']);
$routes->get('admin/profil_sekolah/edit', 'ProfilSekolahController::edit');
$routes->post('admin/profil_sekolah/update', 'ProfilSekolahController::update');



