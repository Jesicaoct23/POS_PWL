<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\POSController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\StokController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\BarangController;
use Illuminate\Support\Facades\Route;


// Route::get('/', function () {
//     return view('welcome');});

Route::get('/',[WelcomeController::class,'index']);

Route::group(['prefix' => 'user'], function () {
    Route::get('/', [UserController::class, 'index']);                                // Menampilkan data user
    Route::post('/list', [UserController::class, 'list']);                       // menampilkan data user dalam bentukjson untuk datatables
    Route::get('/create', [UserController::class, 'create']);                  // menampilkan form tambah user
    Route::post('/', [UserController::class, 'store']);                         // menyimpan data user
    Route::get('/{id}', [UserController::class, 'show']);                        // menampilkan detail user
    Route::get('/{id}/edit', [UserController::class, 'edit']);                   // menampilkan form edit user
    Route::put('/{id}', [UserController::class, 'update']);                    // mengupdate data user
    Route::delete('/{id}', [UserController::class, 'destroy']);               // menghapus data user
});   

Route::group(['prefix' => 'kategori'],function () {
    Route::get('/', [KategoriController::class, 'index']);
    Route::post('/list', [KategoriController::class, 'list']);
    Route::get('/create', [KategoriController::class, 'create']);
    Route::post('/', [KategoriController::class, 'store']);
    Route::get('/{id}', [KategoriController::class, 'show']);
    Route::get('/{id}/edit', [KategoriController::class, 'edit']);
    Route::put('/{id}', [KategoriController::class, 'update']);
    Route::delete('/{id}', [KategoriController::class, 'destroy']);
});

Route::group(['prefix' => 'level'],function () {
    Route::get('/', [LevelController::class, 'index']);
    Route::post('/list', [LevelController::class, 'list']);
    Route::get('/create', [LevelController::class, 'create']);
    Route::post('/', [LevelController::class, 'store']);
    Route::get('/{id}', [LevelController::class, 'show']);
    Route::get('/{id}/edit', [LevelController::class, 'edit']);
    Route::put('/{id}', [LevelController::class, 'update']);
    Route::delete('/{id}', [LevelController::class, 'destroy']);
});

Route::group(['prefix' => 'barang'],function () {
    Route::get('/', [BarangController::class, 'index']);
    Route::post('/list', [BarangController::class, 'list']);
    Route::get('/create', [BarangController::class, 'create']);
    Route::post('/', [BarangController::class, 'store']);
    Route::get('/{id}', [BarangController::class, 'show']);
    Route::get('/{id}/edit', [BarangController::class, 'edit']);
    Route::put('/{id}', [BarangController::class, 'update']);
    Route::delete('/{id}', [BarangController::class, 'destroy']);
});

Route::group(['prefix' => 'stok'],function () {
    Route::get('/', [StokController::class, 'index']);
    Route::post('/list', [StokController::class, 'list']);
    Route::get('/create', [StokController::class, 'create']);
    Route::post('/', [StokController::class, 'store']);
    Route::get('/{id}', [StokController::class, 'show']);
    Route::get('/{id}/edit', [StokController::class, 'edit']);
    Route::put('/{id}', [StokController::class, 'update']);
    Route::delete('/{id}', [StokController::class, 'destroy']);
});

Route::group(['prefix' => 'transaksi'],function () {
    Route::get('/', [TransaksiController::class, 'index']);
    Route::post('/list', [TransaksiController::class, 'list']);
    Route::get('/create', [TransaksiController::class, 'create']);
    Route::post('/', [TransaksiController::class, 'store']);
    Route::get('/{id}', [TransaksiController::class, 'show']);
    Route::get('/{id}/edit', [TransaksiController::class, 'edit']);
    Route::put('/{id}', [TransaksiController::class, 'update']);
    Route::delete('/{id}', [TransaksiController::class, 'destroy']);
});


// Route::get('/Home', [HomeController::class, 'index']);

// Route::get('/Products', [ProductsController::class, 'index']);

// Route::prefix('kategori')->group(function () {
//     Route::get('/food-beverage', [ProductsController::class, 'foodBeverage']);
//     Route::get('/beauty-health ', [ProductsController::class, 'beautyHealth']);
//     Route::get('/home-care  ', [ProductsController::class, 'homeCare']);
//     Route::get('/baby-kid   ', [ProductsController::class, 'babyKid']);
// });


// Route::get('/user', [UserController::class, 'index']);

// Route::get('/Penjualan', [PenjualanController::class, 'index']);

// Route::get('level', [LevelController::class,'index']);
// // Route::get('/kategori', [KategoriController::class,'index']);
// Route::get('/user/tambah', [UserController::class,'tambah']);

// Route::post('/user/tambah_simpan', [UserController::class,'tambah_simpan']);
// Route::get('/user/ubah{id}', [UserController::class,'ubah']);
// Route::put('/user/ubah_simpan/{id}', [UserController::class,'ubah_simpan']);
// Route::get('/user/hapus/{id}', [UserController::class,'hapus']);


// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Route::get('/kategori', [KategoriController::class, 'index']);

// Route::get('/kategori/create', [KategoriController::class, 'create']);
// Route::post('/kategori', [KategoriController::class, 'store']);
// Route::resource('m_user', POSController::class);

// Route::get('/kategori/edit/{id}',[KategoriController::class, 'edit'])->name('kategori.edit');
// Route::put('/kategori/update/{id}',[KategoriController::class, 'update'])->name('kategori.update');
// Route::get('/kategori/delete/{id}',[KategoriController::class, 'delete'])->name('kategori.delete');
// Route::get('/kategori/create',[KategoriController::class, 'create'])->name('kategori.create');
