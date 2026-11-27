<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// =========================================================================
// 1. AUTENTIKASI PANITIA / ADMIN
// =========================================================================
$routes->get('login', 'AuthController::login');
$routes->post('login/submit', 'AuthController::submitLogin');
$routes->get('logout', 'AuthController::logout');

// =========================================================================
// 2. AKSES PUBLIK & KIOSK HARI-H (BEBAS TANPA LOGIN)
// =========================================================================
// Tampilan Publik Daftar Kehadiran (Live Attendance Board TV / Proyektor)
$routes->get('daftar-hadir', 'AttendanceController::liveBoard');
$routes->get('daftar-hadir/api', 'AttendanceController::liveBoardApi');

// Meja Absensi Tamu Terundang (Pen Tablet / Touch Screen)
$routes->get('absensi', 'AttendanceController::index');
$routes->post('absensi/checkin', 'AttendanceController::checkIn');
$routes->get('absensi/undo/(:num)', 'AttendanceController::undoCheckIn/$1');

// Form Registrasi Mandiri Tamu Dadakan (Walk-in)
$routes->get('tamu-baru', 'AttendanceController::walkIn');
$routes->post('tamu-baru/submit', 'AttendanceController::submitWalkIn');

// Preview PDF Undangan Per Tamu
$routes->get('undangan/preview/(:num)', 'PdfController::previewSingle/$1');

// =========================================================================
// 3. AREA TERPROTEKSI ADMIN (WAJIB LOGIN PANITIA)
// =========================================================================
$routes->group('', ['filter' => 'adminAuth'], function ($routes) {
    // Dashboard Utama
    $routes->get('/', 'DashboardController::index');
    $routes->get('dashboard', 'DashboardController::index');

    // Manajemen Tamu Undangan
    $routes->get('tamu', 'GuestController::index');
    $routes->post('tamu/store', 'GuestController::store');
    $routes->post('tamu/update/(:num)', 'GuestController::update/$1');
    $routes->get('tamu/delete/(:num)', 'GuestController::delete/$1');
    $routes->post('tamu/import', 'GuestController::import');
    $routes->get('tamu/template', 'GuestController::downloadTemplate');
    $routes->get('tamu/export', 'GuestController::exportExcel');
    $routes->get('tamu/unduh-pdf-lembaga', 'GuestController::downloadPdfByInstitution');
    $routes->get('tamu/unduh-zip-lembaga', 'GuestController::downloadZipByInstitution');

    // Bulk PDF Generator & ZIP Exporter
    $routes->get('undangan/massal', 'PdfController::batchManager');
    $routes->get('undangan/unduh/(:num)', 'PdfController::generateSingle/$1');
    $routes->post('undangan/batch-process', 'PdfController::batchProcess');
    $routes->get('undangan/download-zip', 'PdfController::downloadZip');

    // Pengaturan Acara Sidang & TTD
    $routes->get('pengaturan', 'SettingsController::index');
    $routes->post('pengaturan/update', 'SettingsController::update');

    // Ekspor Berita Acara & Buku Daftar Hadir Resmi (PDF & Excel)
    $routes->get('export/pdf-kehadiran', 'ExportController::pdfAttendance');
    $routes->get('export/excel-kehadiran', 'ExportController::excelAttendance');
});
