<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\Admin\Akun\AnggotaController;
use App\Http\Controllers\Admin\Akun\PetugasController;
use App\Http\Controllers\Admin\Master\EbookController;
use App\Http\Controllers\Admin\Master\LoginController;
use App\Http\Controllers\Admin\Master\MadingController;
use App\Http\Controllers\Admin\Tampilan\AboutController;
use App\Http\Controllers\Admin\Master\KategoriController;
use App\Http\Controllers\Admin\Tampilan\FooterController;
use App\Http\Controllers\Admin\Master\EbookItemController;
use App\Http\Controllers\Admin\Master\SubKategoriController;
use App\Http\Controllers\Admin\Pengaturan\ProfileController;
use App\Http\Controllers\Admin\Tampilan\TampilanHomeController;
use App\Http\Controllers\Admin\Pengaturan\UbahPasswordController;
use App\Http\Controllers\Admin\Verifikasi\VerifikasiEbookController;
use App\Http\Controllers\Admin\Verifikasi\VerifikasiMadingController;
use App\Http\Controllers\Admin\Laporan\EbookController as LaporanEbookController;
use App\Http\Controllers\Admin\Laporan\MadingController as LaporanMadingController;
use App\Http\Controllers\Admin\Laporan\AnggotaController as LaporanAnggotaController;
use App\Http\Controllers\Admin\Master\LoginAdminController;

// Route::group(['middleware' => ['guest']], function() {
    // Login Siswa
    Route::controller(LoginAdminController::class)->group(function(){
        Route::get('admin/login', 'index')->name('login.admin');
        Route::post('admin/login/proses', 'proses')->name('login.admin.proses');
    });
// });
Route::get('logout', [LoginController::class, 'logout'])->name('logout');


// Route::group(['middleware' => ['cekUserLogin']], function() {
Route::middleware(['auth', 'user-access:petugas'])->group(function () {

    Route::resource('dashboard', BerandaController::class);

    Route::prefix("admin")->group(function() {
        Route::prefix("autentikasi")->group(function() {
            Route::prefix("petugas")->group(function() {
                Route::resource("petugas", PetugasController::class);
                Route::get('changeStatusAdmin', [PetugasController::class, 'changeStatusAdmin'])->name('petugas.changeStatusAdmin');
            });
                Route::resource("anggota", AnggotaController::class);
                Route::get('changeStatus', [AnggotaController::class, 'changeStatus'])->name('anggota.changeStatus');
        });

        Route::prefix("pengaturan")->group(function() {
            Route::prefix("ubahpassword")->group(function() {
                Route::resource("/", UbahPasswordController::class);
            });
        });

        Route::prefix("tampilan")->group(function() {
            Route::prefix("landingpage")->group(function() {
                Route::resource("/home", TampilanHomeController::class);
            });
                Route::resource("footer", FooterController::class);
                Route::resource("about", AboutController::class);
        });

        Route::prefix("verifikasi")->group(function() {
                Route::resource("verifikasiEbook", VerifikasiEbookController::class);
                Route::resource("verifikasiMading", VerifikasiMadingController::class);
        });

        Route::prefix("laporan")->group(function() {
                Route::resource("data-user", LaporanAnggotaController::class);
                Route::match(['get', 'post'], 'export/historyEbookUser', [LaporanAnggotaController::class, 'export'])->name('export.historyEbookUser');
                Route::get('laporan-historyEbookUser/print', [LaporanAnggotaController::class, 'print'])->name('print.historyEbookUser');
                Route::post('exportCustom/historyEbookUser', [LaporanAnggotaController::class, 'exportCustom'])->name('exportCustom.historyEbookUser');
                Route::post('exportCustomPDF/historyEbookUser', [LaporanAnggotaController::class, 'printCustom'])->name('printCustom.historyEbookUser');

                Route::resource("data-ebook", LaporanEbookController::class);
                Route::match(['get', 'post'], 'export/ebook', [LaporanEbookController::class, 'export'])->name('export.ebook');
                Route::get('laporan-ebook/print', [LaporanEbookController::class, 'print'])->name('print.ebook');
                Route::post('exportCustom/ebook', [LaporanEbookController::class, 'exportCustom'])->name('exportCustom.ebook');
                Route::post('exportCustomPDF/ebook', [LaporanEbookController::class, 'printCustom'])->name('printCustom.ebook');

                Route::resource("data-mading", LaporanMadingController::class);
                Route::match(['get', 'post'], 'export/mading', [LaporanMadingController::class, 'export'])->name('export.mading');
                Route::post('exportCustomCSV/mading', [LaporanMadingController::class, 'exportCustom'])->name('exportCustom.mading');
                Route::post('exportCustomPDF/mading', [LaporanMadingController::class, 'printCustom'])->name('printCustom.mading');
                Route::get('laporan-mading/print', [LaporanMadingController::class, 'print'])->name('print.mading');

        });

            Route::resource("categori", KategoriController::class);

            Route::resource("sub-kategori", SubKategoriController::class);

            Route::resource("madjing", MadingController::class);

            Route::resource("buku", EbookController::class);
            Route::resource("buku-isi", EbookItemController::class)->except(['show']);
            Route::get('buku-show/{buku}/isi', [EbookItemController::class,'showIsiCerita'])->name('isi-buku.showIsiCerita');
            Route::get('buku/{buku}/isi', [EbookItemController::class,'isiCerita'])->name('isi-buku.isiCerita');
            Route::post('buku/bukuisi', [EbookItemController::class,'storeIsiCerita'])->name('isi-buku.storeIsiCerita');

    });
});


Route::controller(profileController::class)->group(function(){
    Route::get('/pengaturan/profile','index')->name('profile.index');
    Route::put('/profile/index/{id}','update')->name('profile.update');
});

