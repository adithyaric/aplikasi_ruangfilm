<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserDetailController;
use Illuminate\Support\Facades\Route;
use Laravolt\Indonesia\Models\Province;

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

// Landing
Route::get('/', function () {
    return view('landing.index');
});
Route::get('/program', function () {
    return view('landing.program');
});
Route::get('/umum', function () {
    return view('landing.kategori.umum');
});
Route::get('/pelajar', function () {
    return view('landing.kategori.pelajar');
});
Route::get('/ekshibisi', function () {
    return view('landing.kategori.ekshibisi');
});
Route::get('/ekshibisi/organisasi', function () {
    return view('landing.kategori.ekshibisis.organisasi');
});
Route::get('/ekshibisi/paud', function () {
    return view('landing.kategori.ekshibisis.paud');
});
Route::get('/download/ekatalog', function () {
    \App\Models\DownloadLog::updateOrCreate(
        ['ip_address' => request()->ip()],
        [
            'file'       => 'ekatalog-2025.pdf',
            'user_agent' => request()->userAgent(),
            'user_id'    => auth()->id() ?? null,
        ]
    );

    $filePath = public_path('landing/pdf/ekatalog-2025.pdf');
    return response()->download($filePath);
})->name('download.ekatalog');
Route::get('/merchandise', function () {
    return view('landing.merchandise');
})->name('merchandise');
Route::get('/merchandise/biodata', function () {
    $provinsi = Province::orderBy('name')->get();
    return view('landing.biodata', compact('provinsi'));
});

//? CRUD Pages :

Route::get('/login', [AuthController::class, 'index'])->name('login')->middleware('guest');
Route::get('/register', [AuthController::class, 'register'])->name('register')->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout']);
Route::post('/authenticate', [AuthController::class, 'authenticate'])->name('authenticate');
Route::post('/regist', [AuthController::class, 'registStore'])->name('registStore');
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');
Route::get('/setting/submission', [DashboardController::class, 'settingIndex'])->name('settingIndex');
Route::post('/setting/submission', [DashboardController::class, 'settingStore'])->name('settingStore');
Route::delete('/setting/submission', [DashboardController::class, 'settingDestroy'])->name('settingDestroy');

// User
Route::resource('/users', UserController::class)->middleware('auth');
Route::get('/users/index/author', [UserController::class, 'indexAuth'])->name('users.index.author');
Route::get('/users/index/kurator', [UserController::class, 'indexKur'])->name('users.index.kurator');
Route::get('/changepass', [UserController::class, 'changePass'])->name('user.changepass');
Route::post('/updatepass', [UserController::class, 'updatePassword'])->name('user.changepass.update');

// User Detail
Route::get('/biodata', [UserDetailController::class, 'index'])->name('user-detail.index')->middleware('auth');
Route::post('/biodata', [UserDetailController::class, 'save'])->name('user-detail.save')->middleware('auth');

// Film
Route::resource('film', FilmController::class)->middleware('auth');
Route::get('/film/{id}/gsm/download', [FilmController::class, 'downloadGsm'])->name('film.gsm.download');

// Category
Route::resource('/categories', CategoryController::class)->middleware('auth');
