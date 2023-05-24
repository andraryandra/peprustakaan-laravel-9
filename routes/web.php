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

Route::get('/', function () {
    return view('/user/landingpage/home');
});

Route::get('/about', function () {
    return view('/user/landingpage/about');
});

Route::get('/mading', function () {
    return view('/user/landingpage/mading');
});

Route::get('/ebook', function () {
    return view('/user/landingpage/ebook');
});



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



Route::group(['middleware' => ['guest']], function() {
    Route::controller(loginuser::class)->group(function(){
        Route::get('login', 'index')->name('login');
        Route::post('login/proses', 'proses');
    });
});

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


