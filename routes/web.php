<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\NyanyianController as PublicNyanyianController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\NyanyianController as AdminNyanyianController;
use App\Http\Controllers\Admin\PengaturanController as AdminPengaturanController;
use Illuminate\Support\Facades\Route;

// Public pages
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/galeri', [PageController::class, 'galeri'])->name('galeri');
Route::get('/video', [PageController::class, 'video'])->name('video');
Route::get('/warta', [PageController::class, 'warta'])->name('warta');
Route::get('/warta/{slug}', [PageController::class, 'wartaDetail'])->name('warta.detail');
Route::get('/kontak', [ContactController::class, 'index'])->name('kontak');
Route::post('/kontak', [ContactController::class, 'store'])->name('kontak.store');

// Public NHYK
Route::get('/nyanyian', [PublicNyanyianController::class, 'index'])->name('nyanyian.index');
Route::get('/nyanyian/{nyanyian}', [PublicNyanyianController::class, 'show'])->name('nyanyian.show');

// Auth (simple)
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin routes
Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');

    Route::get('/nyanyian', [AdminNyanyianController::class, 'index'])->name('nyanyian.index');
    Route::get('/nyanyian/create', [AdminNyanyianController::class, 'create'])->name('nyanyian.create');
    Route::post('/nyanyian', [AdminNyanyianController::class, 'store'])->name('nyanyian.store');
    Route::get('/nyanyian/{nyanyian}/edit', [AdminNyanyianController::class, 'edit'])->name('nyanyian.edit');
    Route::put('/nyanyian/{nyanyian}', [AdminNyanyianController::class, 'update'])->name('nyanyian.update');
    Route::delete('/nyanyian/{nyanyian}', [AdminNyanyianController::class, 'destroy'])->name('nyanyian.destroy');

    // Placeholder routes for other modules
    // Data Jemaat CRUD
    Route::get('/jemaat', [\App\Http\Controllers\Admin\JemaatController::class, 'index'])->name('jemaat.index');
    Route::get('/jemaat/create', [\App\Http\Controllers\Admin\JemaatController::class, 'create'])->name('jemaat.create');
    Route::post('/jemaat', [\App\Http\Controllers\Admin\JemaatController::class, 'store'])->name('jemaat.store');
    Route::get('/jemaat/{jemaat}/edit', [\App\Http\Controllers\Admin\JemaatController::class, 'edit'])->name('jemaat.edit');
    Route::put('/jemaat/{jemaat}', [\App\Http\Controllers\Admin\JemaatController::class, 'update'])->name('jemaat.update');
    Route::delete('/jemaat/{jemaat}', [\App\Http\Controllers\Admin\JemaatController::class, 'destroy'])->name('jemaat.destroy');

    // Jadwal Ibadah & Rapat CRUD
    Route::get('/jadwal-ibadah', [\App\Http\Controllers\Admin\JadwalController::class, 'index'])->name('jadwal.index');
    Route::get('/jadwal-ibadah/create', [\App\Http\Controllers\Admin\JadwalController::class, 'create'])->name('jadwal.create');
    Route::post('/jadwal-ibadah', [\App\Http\Controllers\Admin\JadwalController::class, 'store'])->name('jadwal.store');
    Route::get('/jadwal-ibadah/{jadwal}/edit', [\App\Http\Controllers\Admin\JadwalController::class, 'edit'])->name('jadwal.edit');
    Route::put('/jadwal-ibadah/{jadwal}', [\App\Http\Controllers\Admin\JadwalController::class, 'update'])->name('jadwal.update');
    Route::delete('/jadwal-ibadah/{jadwal}', [\App\Http\Controllers\Admin\JadwalController::class, 'destroy'])->name('jadwal.destroy');
    Route::get('/jadwal-ibadah/export-pdf', [\App\Http\Controllers\Admin\JadwalController::class, 'exportPdf'])->name('jadwal.exportPdf');

    // Keuangan Gereja CRUD
    Route::get('/keuangan-gereja', [\App\Http\Controllers\Admin\KeuanganController::class, 'index'])->name('keuangan.index');
    Route::get('/keuangan-gereja/create/{jenis}', [\App\Http\Controllers\Admin\KeuanganController::class, 'create'])->name('keuangan.create');
    Route::post('/keuangan-gereja', [\App\Http\Controllers\Admin\KeuanganController::class, 'store'])->name('keuangan.store');
    Route::get('/keuangan-gereja/{transaksi}/edit', [\App\Http\Controllers\Admin\KeuanganController::class, 'edit'])->name('keuangan.edit');
    Route::put('/keuangan-gereja/{transaksi}', [\App\Http\Controllers\Admin\KeuanganController::class, 'update'])->name('keuangan.update');
    Route::delete('/keuangan-gereja/{transaksi}', [\App\Http\Controllers\Admin\KeuanganController::class, 'destroy'])->name('keuangan.destroy');

    // CRUD for Homepage Content (replaces Church Profile)
    Route::resource('homepage-content', \App\Http\Controllers\Admin\HomePageContentController::class)
        ->parameters(['homepage-content' => 'homepageContent'])
        ->names('homepage_content');

    // Backward-compatible alias (old path)
    Route::get('/data-jemaat', function () {
        return redirect()->route('admin.jemaat.index');
    })->name('data_jemaat');

    // Laporan Keuangan
    Route::get('/laporan-keuangan', [\App\Http\Controllers\FinanceReportController::class, 'index'])->name('finance_reports.index');
    Route::get('/laporan-keuangan/download', [\App\Http\Controllers\FinanceReportController::class, 'downloadPDF'])->name('finance_reports.downloadPDF');
    // Admin simple pages wired to controllers
    // Inventaris resource
    Route::resource('inventaris_aset', \App\Http\Controllers\Admin\InventarisController::class)->parameters(['inventaris_aset' => 'inventari'])->names([
        'index' => 'inventaris_aset',
        'create' => 'inventaris_aset.create',
        'store' => 'inventaris_aset.store',
        'edit' => 'inventaris_aset.edit',
        'update' => 'inventaris_aset.update',
        'destroy' => 'inventaris_aset.destroy',
    ]);
    Route::get('/inventaris-aset/export-pdf', [\App\Http\Controllers\Admin\InventarisController::class, 'exportPdf'])->name('inventaris_aset.exportPdf');
    // Warta (news) CRUD routes
    Route::resource('warta', \App\Http\Controllers\Admin\WartaController::class)
        ->parameters(['warta' => 'warta'])
        ->names('warta');
    // keep sidebar compatibility: admin.warta_news -> admin.warta.index
    Route::get('/warta-news', function () { return redirect()->route('admin.warta.index'); })->name('warta_news');
    // Gallery resource (galeri_foto)
    Route::resource('galeri_foto', \App\Http\Controllers\Admin\GalleryController::class)->parameters(['galeri_foto' => 'gallery'])->names([
        'index' => 'galeri_foto',
        'create' => 'galeri_foto.create',
        'store' => 'galeri_foto.store',
        'show' => 'galeri_foto.show',
        'edit' => 'galeri_foto.edit',
        'update' => 'galeri_foto.update',
        'destroy' => 'galeri_foto.destroy',
    ]);
    
    // Contact Messages (Pesan Masuk)
    Route::get('/pesan-masuk', [\App\Http\Controllers\Admin\ContactMessageController::class, 'index'])->name('contact_messages.index');
    Route::get('/pesan-masuk/{contactMessage}', [\App\Http\Controllers\Admin\ContactMessageController::class, 'show'])->name('contact_messages.show');
    Route::delete('/pesan-masuk/{contactMessage}', [\App\Http\Controllers\Admin\ContactMessageController::class, 'destroy'])->name('contact_messages.destroy');
    Route::post('/pesan-masuk/{contactMessage}/mark-read', [\App\Http\Controllers\Admin\ContactMessageController::class, 'markAsRead'])->name('contact_messages.mark_read');
    Route::post('/pesan-masuk/{contactMessage}/mark-replied', [\App\Http\Controllers\Admin\ContactMessageController::class, 'markAsReplied'])->name('contact_messages.mark_replied');
    
    // Manajemen Admin (users)
    Route::get('/manajemen-admin', [\App\Http\Controllers\Admin\AdminUserController::class, 'index'])->name('manajemen_admin');
    Route::get('/manajemen-admin/create', [\App\Http\Controllers\Admin\AdminUserController::class, 'create'])->name('manajemen_admin.create');
    Route::post('/manajemen-admin', [\App\Http\Controllers\Admin\AdminUserController::class, 'store'])->name('manajemen_admin.store');
    Route::get('/manajemen-admin/{user}/edit', [\App\Http\Controllers\Admin\AdminUserController::class, 'edit'])->name('manajemen_admin.edit');
    Route::put('/manajemen-admin/{user}', [\App\Http\Controllers\Admin\AdminUserController::class, 'update'])->name('manajemen_admin.update');
    Route::delete('/manajemen-admin/{user}', [\App\Http\Controllers\Admin\AdminUserController::class, 'destroy'])->name('manajemen_admin.destroy');
    
    // Pengaturan Umum (Settings)
    Route::get('/pengaturan-umum', [\App\Http\Controllers\Admin\PengaturanUmumController::class, 'index'])->name('pengaturan_umum');
    Route::put('/pengaturan-umum', [\App\Http\Controllers\Admin\PengaturanUmumController::class, 'update'])->name('pengaturan_umum.update');
});
