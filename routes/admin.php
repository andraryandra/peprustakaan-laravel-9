<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\Admin\Akun\AnggotaController;
use App\Http\Controllers\Admin\Akun\PetugasController;
use App\Http\Controllers\Admin\Laporan\AnggotaController as LaporanAnggotaController;
use App\Http\Controllers\Admin\Laporan\EbookController as LaporanEbookController;
use App\Http\Controllers\Admin\Laporan\MadingController as LaporanMadingController;
use App\Http\Controllers\Admin\Master\EbookController;
use App\Http\Controllers\Admin\Verifikasi\EbookController as verebook;
use App\Http\Controllers\Admin\Master\LoginController;
use App\Http\Controllers\Admin\Master\MadingController;
use App\Http\Controllers\Admin\Master\KategoriController;
use App\Http\Controllers\Admin\Master\SubKategoriController;
use App\Http\Controllers\Admin\Pengaturan\ProfileController;
use App\Http\Controllers\Admin\Pengaturan\UbahPasswordController;
use App\Http\Controllers\Admin\Tampilan\AboutController;
use App\Http\Controllers\Admin\Tampilan\FooterController;
use App\Http\Controllers\Admin\Tampilan\TampilanHomeController;
use App\Http\Controllers\Admin\Verifikasi\MadingController as VerifikasiMadingController;

Route::group(['middleware' => ['guest']], function() {
    Route::controller(LoginController::class)->group(function(){
        Route::get('admin/login', 'index')->name('login');
        Route::post('admin/login/proses', 'proses');
    });
});

Route::group(['middleware' => ['cekUserLogin']], function() {
    Route::resource('dashboard', BerandaController::class);
    Route::get('logout', [LoginController::class, 'logout']);

    Route::prefix("admin")->group(function() {
        Route::prefix("autentikasi")->group(function() {
            Route::prefix("petugas")->group(function() {
                Route::get("/edit", [PetugasController::class, "edit"]);
                Route::put("/simpan", [PetugasController::class, "update"]);
                Route::resource("/", PetugasController::class);
            });
            Route::prefix("anggota")->group(function() {
                Route::get("/edit", [AnggotaController::class, "edit"]);
                Route::put("/simpan", [AnggotaController::class, "update"]);
                Route::resource("/", AnggotaController::class);
            });
        });

        Route::prefix("pengaturan")->group(function() {
            Route::prefix("ubahpassword")->group(function() {
                Route::resource("/", UbahPasswordController::class);
            });
        });

        Route::prefix("tampilan")->group(function() {
            Route::prefix("landingpage")->group(function() {
                Route::get("/edit", [TampilanHomeController::class, "edit"]);
                Route::put("/simpan", [TampilanHomeController::class, "update"]);
                Route::resource("/", TampilanHomeController::class);
            });
            Route::prefix("footer")->group(function() {
                Route::resource("/", FooterController::class);
            });
            Route::prefix("about")->group(function() {
                Route::resource("/", AboutController::class);
            });
        });

        Route::prefix("verifikasi")->group(function() {
            Route::prefix("v_ebook")->group(function() {
                Route::resource("/", verebook::class);
            });
            Route::prefix("v_mading")->group(function() {
                Route::resource("/", VerifikasiMadingController::class);
            });
        });

        Route::prefix("laporan")->group(function() {
            Route::prefix("dataanggota")->group(function() {
                Route::resource("/", LaporanAnggotaController::class);
            });
            Route::prefix("dataebook")->group(function() {
                Route::resource("/", LaporanEbookController::class);
            });
            Route::prefix("datamading")->group(function() {
                Route::resource("/", LaporanMadingController::class);
            });
        });

        Route::prefix("kategori")->group(function() {
            Route::get("/edit", [KategoriController::class, "edit"]);
            Route::put("/simpan", [KategoriController::class, "update"]);
            Route::resource("/kategori", KategoriController::class);
        });

        Route::prefix("sub-kategori")->group(function() {
            Route::get("/edit", [SubKategoriController::class, "edit"]);
            Route::put("/simpan", [SubKategoriController::class, "update"]);
            Route::resource("/sub-kategori", SubKategoriController::class);
        });

        Route::prefix("majding")->group(function() {
            Route::get("/edit", [MadingController::class, "edit"]);
            Route::put("/simpan", [MadingController::class, "update"]);
            Route::resource("/", MadingController::class);
        });

        Route::prefix("buku")->group(function() {
            Route::get("/edit", [EbookController::class, "edit"]);
            Route::put("/simpan", [EbookController::class, "update"]);
            Route::resource("/buku", EbookController::class);
        });
    });
});


Route::controller(profileController::class)->group(function(){
    Route::get('/admin/pengaturan/profile','index');
    Route::patch('/profile/index/{id}','update')->name('profile.update');
});

// Route::get('/contohs', [ContohController::class, 'index'])->name('contohs.index');
// Route::get('/contohs/create', [ContohController::class, 'create'])->name('contohs.create');
// Route::post('/contohs', [ContohController::class, 'store'])->name('contohs.store');
// Route::get('/contohs/{kategori}/edit', [ContohController::class, 'edit'])->name('contohs.edit');
// Route::put('/contohs/{kategori}', [ContohController::class, 'update'])->name('contohs.update');
// Route::delete('/contohs/{kategori}', [ContohController::class, 'destroy'])->name('contohs.destroy');
