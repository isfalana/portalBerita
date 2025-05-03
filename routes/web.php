<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PageController;
use App\Models\Kategori;
use App\Models\Page;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Auth\Middleware\RedirectIfAuthenticated;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'index'])->name('home');

// Route detail berita
Route::get('/berita/{id}', [BeritaController::class, 'show'])->name('berita.show');
// Route page
Route::get('/{id}', [PageController::class, 'show'])->where('id', '[0-9]+')->name('page.show');


Route::get('/contact', function () {
    return view('contact', ['title' => 'Contact']);
});
Route::get('/about', function () {
    return view('about', ['title' => 'About']);
});

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::post('/login', [AuthController::class, 'verify'])->name('verify');
});


Route::group(['middleware' => 'auth'], function(){
    Route::prefix('admin')-> group(function(){
        Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');


        Route::get('profile', [AuthController::class, 'profile'])->name('admin.profile');

        Route::get('reset-password', [AuthController::class, 'formResetPassword'])->name('admin.resetPassword');
        Route::post('reset-password', [AuthController::class, 'resetPassword'])->name('admin.resetPassword.proses');


        Route::get('/kategori', [KategoriController::class, 'index'])-> name('kategori.index');
        Route::get('/kategori/tambah', [KategoriController::class, 'tambah'])-> name('kategori.tambah');
        Route::post('/kategori/prosesTambah', [KategoriController::class, 'prosesTambah'])-> name('kategori.prosesTambah');
        Route::get('/kategori/ubah/{id}', [KategoriController::class, 'ubah'])-> name('kategori.ubah');
        Route::put('/kategori/prosesUbah/{id}', [KategoriController::class, 'prosesUbah'])-> name('kategori.prosesUbah');
        Route::delete   ('/kategori/hapus/{id}', [KategoriController::class, 'hapus'])-> name('kategori.hapus');
       
        Route::get('/berita', [BeritaController::class, 'index'])-> name('berita.index');
        Route::get('/berita/tambah', [BeritaController::class, 'tambah'])-> name('berita.tambah');
        Route::post('/berita/prosesTambah', [BeritaController::class, 'prosesTambah'])-> name('berita.prosesTambah');
        Route::get('/berita/ubah/{id}', [BeritaController::class, 'ubah'])-> name('berita.ubah');
        Route::put('/berita/prosesUbah/{id}', [BeritaController::class, 'prosesUbah'])-> name('berita.prosesUbah');
        Route::delete   ('/berita/hapus/{id}', [BeritaController::class, 'hapus'])-> name('berita.hapus');


        Route::get('/page', [PageController::class, 'index'])-> name('page.index');
        Route::get('/page/tambah', [PageController::class, 'tambah'])-> name('page.tambah');
        Route::post('/page/prosesTambah', [PageController::class, 'prosesTambah'])-> name('page.prosesTambah');
        Route::get('/page/ubah/{id}', [PageController::class, 'ubah'])-> name('page.ubah');
        Route::put('/page/prosesUbah/{id}', [PageController::class, 'prosesUbah'])-> name('page.prosesUbah');
        Route::delete   ('/page/hapus/{id}', [PageController::class, 'hapus'])-> name('page.hapus');
       
        Route::get('/menu', [MenuController::class, 'index'])->name('menu.index');
        Route::get('/menu/tambah', [MenuController::class, 'tambah'])->name('menu.tambah');
        Route::post('/menu/tambah', [MenuController::class, 'prosesTambah'])->name('menu.prosesTambah');
        Route::get('/menu/ubah/{id}', [MenuController::class, 'ubah'])->name('menu.ubah');
        Route::put('/menu/ubah/{id}', [MenuController::class, 'prosesUbah'])->name('menu.prosesUbah');
        Route::delete('/menu/hapus/{id}', [MenuController::class, 'hapus'])->name('menu.hapus');
        Route::put('/menu/toggle-status/{id}', [MenuController::class, 'toggleStatus'])->name('menu.toggleStatus');
        Route::post('/menu/naik/{id}', [MenuController::class, 'naik'])->name('menu.naik');
        Route::post('/menu/turun/{id}', [MenuController::class, 'turun'])->name('menu.turun');

    });
    Route::get('/logout', [AuthController::class, 'logout']) -> name('logout');
});


Route::get('files/{filename}', function($filename){
    $path = storage_path('app/public/' . $filename);
    if (!File::exists($path)) {
        abort(404);
    }
    $file = File::get($path);
    $type = File::mimeType($path);
    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);
    return $response;
})->name('storage');
