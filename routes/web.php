<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController as loginuser;
use App\Http\Controllers\LandingpageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

require __DIR__ . '/admin.php';

// Route::get('/', function () {
//     return view('/user/landingpage/home');
// });

Route::get('/', [LandingpageController::class, 'index'])->name('landingPage.index');
Route::get('showMading/{slug}', [LandingpageController::class, 'showMadingLandingPageHome'])->name('landingPage.showMading');
Route::get('/mading', [LandingpageController::class, 'mading'])->name('landingPage.mading');
Route::get('/ebook', [LandingpageController::class, 'ebookLandingPage'])->name('landingPage.ebook');
Route::get('showEbook/{slug}', [LandingpageController::class, 'showEbookLandingPageHome'])->name('landingPage.showEbook');
Route::get('/about', [LandingpageController::class, 'about'])->name('landingPage.about');
Route::get('/footer', [LandingpageController::class, 'indexfooter'])->name('landingPage.footer');
// Route::get('/ebook-story/{ebook_story}', [LandingpageController::class, 'ebookStory'])->name('landingPage.ebookStory');
Route::get('/ebook-story/{slug}', [LandingpageController::class, 'ebookStory'])->name('landingPage.ebookStory');

Route::get('buku-isi/{id}/pdf', [LandingpageController::class, 'showPdf'])->name('buku-isi.show-pdf');
Route::get('/artikel', [LandingpageController::class, 'artikel'])->name('landingPage.artikel');
Route::get('/riwayat/ebook', [LandingpageController::class, 'riwayatEbook'])->name('landingPage.riwayatEbook');


// Route::get('/about', function () {
//     return view('/user/landingpage/about');
// });

// Route::get('/mading', function () {
//     return view('/user/landingpage/mading');
// });

// Route::get('/ebook', function () {
//     return view('/user/landingpage/ebook');
// });



Route::get('/d_mading', function () {
    return view('/user/landingpage/d_mading');
});

Route::get('/d_ebook', function () {
    return view('/user/landingpage/d_ebook');
});

Route::get('/view_login', function () {
    return view('/admin/loginadmin/view_login');
});

Route::get('/landingpage', function () {
    return view('/user/anggota/landingpage');
});



Route::get("/v_index", function () {
    return view('/admin/buku/v_index');
});



// Route::group(['middleware' => ['guest']], function() {
    Route::controller(loginuser::class)->group(function(){
        Route::get('login', 'index')->name('login');
        Route::post('login/proses', 'proses');
    });
// });

Route::group(['middleware' => ['cekUserLogin']], function() {
    // Route::resource('landingpage', AnggotaController::class);
    Route::prefix("user")->group(function() {
        Route::prefix("anggota")->group(function() {
            Route::controller(LandingpageController::class)->group(function() {
                Route::get("/landingpage", "index");
                Route::prefix("tampilan")->group(function() {
                    Route::get("/about", "about");
                    Route::get("/ebook", "ebook");
                    Route::get("/artikel", "artikel");
                    Route::get("/detail_ebook", "detailebook");
                    Route::get("/mading", "mading");
                    Route::get("/detail_mading", "detailmading");
                    Route::get("/riwayat", "riwayat");
                });
            });
        });
    });
});


