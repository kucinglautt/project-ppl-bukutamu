<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// =========================
// AUTHENTICATION ROUTES
// =========================
$routes->get('/', 'Auth::index');
$routes->get('/login', 'Auth::login');
$routes->post('/login', 'Auth::login');
$routes->get('/logout', 'Auth::logout');
$routes->get('/lupa-password', 'Auth::lupaPassword');

// =========================
// ADMIN ROUTES
// =========================
$routes->group('', ['filter' => 'adminfilter'], function ($routes) {
    // Dashboard
    $routes->get('/dashboard-admin', 'AdminController::index');

    // Kelola Petugas
    $routes->get('/kelola-petugas', 'KelolaPetugasController::index');
    $routes->get('/kelola-petugas/add', 'KelolaPetugasController::add');
    $routes->post('/kelola-petugas/create', 'KelolaPetugasController::create');
    $routes->get('/kelola-petugas/edit/(:segment)', 'KelolaPetugasController::edit/$1');
    $routes->post('/kelola-petugas/update/(:segment)', 'KelolaPetugasController::update/$1');
    $routes->post('/kelola-petugas/delete/(:segment)', 'KelolaPetugasController::delete/$1');

    // Riwayat Tamu & Ekspor
    $routes->get('/riwayat-tamu', 'RiwayatTamuController::index');
    $routes->get('/riwayat-tamu/export-pdf', 'RiwayatTamuController::exportPdf');
    $routes->get('/riwayat-tamu/export-excel', 'RiwayatTamuController::exportExcel');

    // Statistik
    $routes->get('/statistik', 'AdminStatistikController::index');

    // Ganti Password
    $routes->get('/ganti-password-admin', 'GantiPasswordAdminController::index');
    $routes->post('/ganti-password-admin/change', 'GantiPasswordAdminController::update');

    // Log Aktivitas
    $routes->get('/log-aktivitas', 'AdminController::activityLog');
});

// =========================
// PETUGAS ROUTES
// =========================
$routes->group('', ['filter' => 'petugasfilter'], function ($routes) {
    // Dashboard
    $routes->get('/dashboard-petugas', 'PetugasController::index');

    // Input Tamu
    $routes->get('/input-tamu', 'PetugasController::inputTamu');
    $routes->post('/input-tamu/create', 'GuestController::store');

    // Statistik
    $routes->get('/statistik-tamu', 'StatistikTamuController::index');

    // Kunjungan Aktif
    $routes->get('/kunjungan-aktif', 'KunjunganAktifController::index');
    $routes->post('/kunjungan-aktif/checkout/(:num)', 'KunjunganAktifController::checkOut/$1');
    $routes->post('/kunjungan-aktif/batal/(:num)', 'KunjunganAktifController::batal/$1');
    $routes->post('/kunjungan-aktif/update-status/(:num)', 'KunjunganAktifController::updateStatus/$1');

    // Ganti Password
    $routes->get('/ganti-password-petugas', 'GantiPasswordPetugasController::index');
    $routes->post('/ganti-password-petugas/change', 'GantiPasswordPetugasController::update');
});

// =========================
// TAMU / GUEST SELF-SERVICE
// =========================
$routes->get('/form', 'GuestController::index');
$routes->post('/form/save', 'GuestController::store');
$routes->get('/thankyou', 'GuestController::thankYou');
