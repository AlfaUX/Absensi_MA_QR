<?php

namespace Config;

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');

// // Manajemen Data
// $routes->get('/pages/data_guru', 'Data_guru::index');
// $routes->get('/pages/data_siswa', 'Data_siswa::index');
// // $routes->get('/pages/absensi_guru', 'Absensi_guru::index');
// $routes->get('/pages/absensi_siswa', 'Absensi_siswa::index');
// $routes->get('/pages/dashboard','Dashboard::index');

// Fitur Lain
$routes->get('pages/scan_qr', 'QRController::index');
$routes->post('pages/scan_qr', 'QRController::absen'); // Perbaiki typo "QrController"

// Login & Logout
$routes->get('/pages/admin_login', 'Admin_login::index'); // Halaman login
$routes->post('/pages/admin_login/prosesLogin', 'Admin_login::prosesLogin');
$routes->get('/logout', 'Admin_login::logout');


// Dashboard (Proteksi dengan Filter Auth)
$routes->get('/pages/dashboard', 'Dashboard::index', ['filter' => 'auth']); 
$routes->get('/pages/data_guru', 'Data_guru::index', ['filter' => 'auth']); 
$routes->get('/pages/data_siswa', 'Data_siswa::index', ['filter' => 'auth']); 
$routes->get('/pages/absensi_guru', 'Absensi_guru::index', ['filter' => 'auth']); 
$routes->get('/pages/absensi_siswa', 'Absensi_siswa::index', ['filter' => 'auth']); 

//kelola data siswa
$routes->get('/siswa', 'Data_siswa::index');
$routes->get('/siswa/tambah', 'Data_siswa::tambah');
$routes->post('/siswa/simpan', 'Data_siswa::simpan');
$routes->post('/siswa/import_csv', 'Data_siswa::import_csv');
$routes->get('/siswa/edit/(:num)', 'Data_siswa::edit/$1'); 
$routes->post('/siswa/update', 'Data_siswa::update');
$routes->get('siswa/delete/(:num)', 'Data_siswa::delete/$1');
$routes->get('/siswa/download_template', 'Data_siswa::download_template');
$routes->post('/siswa/import_csv', 'Data_siswa::import_csv');

//download qr siswa
$routes->get('siswa/generate_qr/(:num)', 'Data_siswa::generateQR/$1');
$routes->get('siswa/download_qr/(:num)', 'Data_siswa::downloadQR/$1');

//data absensi siswa
$routes->get('/absensi_siswa', 'Absensi_siswa::index');
$routes->post('/absensi_siswa/scanQR', 'Absensi_siswa::scanQR');
$routes->post('/absensi_siswa/update_keterangan', 'Absensi_siswa::updateKeterangan');
$routes->post('/qr/absen', 'QrController::absen');

//kelola data guru
$routes->get('/guru', 'Data_guru::index');
$routes->get('/guru/tambah', 'Data_guru::tambah');
$routes->post('/guru/simpan', 'Data_guru::simpan');
$routes->post('/guru/import_csv', 'Data_guru::import_csv');
$routes->get('/guru/edit/(:num)', 'Data_guru::edit/$1'); 
$routes->post('/guru/update', 'Data_guru::update');
$routes->get('guru/delete/(:num)', 'Data_guru::delete/$1');
$routes->get('/guru/download_template', 'Data_guru::download_template');
$routes->post('/guru/import_csv', 'Data_guru::import_csv');


