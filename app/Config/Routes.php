<?php

use App\Controllers\Dashboard;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Routes validasi akun login & Registrasi
$routes->get('/', 'Auth::index');
$routes->get('auth/create', 'Auth::create');
$routes->post('auth/store', 'Auth::store');
$routes->get('/', 'Dashboard::index');
$routes->post('/login', 'Auth::login');
$routes->post('auth/logout', 'Auth::logout');

// crud akun api nya
$routes->get('akun', 'AkunController::index');
$routes->post('akun/store', 'AkunController::store');
$routes->get('akun/delete/(:num)', 'AkunController::delete/$1');

// Lupa password
$routes->post('auth/validateForgotPassword', 'Auth::validateForgotPassword');
$routes->post('auth/updatePassword', 'Auth::updatePassword');
$routes->get('auth/resetPassword', 'Auth::resetPassword');

// Dashboard
$routes->get('/dashboard', 'Dashboard::index');
$routes->get('/dashboard/data_pegawai', 'Dashboard::data_pegawai');

$routes->get('/karyawan', 'Karyawan::index');
$routes->post('/karyawan/save', 'Karyawan::save');
$routes->get('/karyawan/edit/(:num)', 'Karyawan::edit/$1');
$routes->post('/karyawan/update/(:num)', 'Karyawan::update/$1');
$routes->get('/karyawan/delete/(:num)', 'Karyawan::delete/$1');
$routes->get('karyawan/detail/(:num)', 'Karyawan::detail/$1');

// Routes cuti karyawan
$routes->get('/cuti', 'Cuti::index');
$routes->get('/cuti/error', 'Cuti::error');
$routes->post('cuti/update', 'Cuti::updateCuti');
$routes->get('cuti/view/(:num)', 'Cuti::view/$1');
$routes->get('users/cuti', 'Cuti::index');
$routes->get('cuti/search', 'Cuti::search');
$routes->get('/rangkumancuti', 'Rangkumancuti::index');

// Routes Acara Kepegawaian
$routes->get('acara', 'Acara::index');
$routes->post('acara/create', 'Acara::create');
$routes->get('acara/edit/(:num)', 'Acara::edit/$1');
$routes->post('acara/update/(:num)', 'Acara::update/$1');
$routes->delete('acara/delete/(:num)', 'Acara::delete/$1');

// Routes Upacara
$routes->get('upacara', 'Upacara::index');
$routes->post('upacara/create', 'Upacara::create');
$routes->get('upacara/edit/(:num)', 'Upacara::edit/$1');
$routes->post('upacara/update/(:num)', 'Upacara::update/$1');
$routes->delete('upacara/delete/(:num)', 'Upacara::delete/$1');

// Routes Instruksi
$routes->get('instruksi', 'Instruksi::index');
$routes->post('instruksi/create', 'Instruksi::create');
$routes->get('instruksi/edit/(:num)', 'Instruksi::edit/$1');
$routes->post('instruksi/update/(:num)', 'Instruksi::update/$1');
$routes->delete('instruksi/delete/(:num)', 'Instruksi::delete/$1');

//routes menu jabatan
$routes->get('/jabatan', 'JabatanController::jabatan');
$routes->post('/jabatan/create', 'JabatanController::create');
$routes->post('/jabatan/update', 'JabatanController::update');
$routes->get('/jabatan/edit/(:num)', 'JabatanController::edit/$1');
$routes->get('/jabatan/delete/(:num)', 'JabatanController::delete/$1');

//routes menu golongan
$routes->get('/golongan', 'GolonganController::golongan');
$routes->post('/golongan/create', 'GolonganController::create');
$routes->post('/golongan/update', 'GolonganController::update');
$routes->get('/golongan/edit/(:num)', 'GolonganController::edit/$1');
$routes->get('/golongan/delete/(:num)', 'GolonganController::delete/$1');

//routes menu ubah deskripsi
$routes->get('/deskripsi', 'DeskripsiController::deskripsi');
$routes->post('/deskripsi/save', 'DeskripsiController::save');
$routes->get('/deskripsi/delete/(:num)', 'DeskripsiController::delete/$1');

//routes nomor surat bagian ruangan TURT
$routes->get('/surat', 'SuratController::index'); // Untuk menampilkan daftar surat
$routes->post('/surat/save', 'SuratController::save');  
$routes->post('/surat/batalkan', 'SuratController::batalkan');