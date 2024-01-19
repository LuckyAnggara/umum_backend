<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\PermintaanPersediaanController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::get('/show-image/{id}', [InventoryController::class, 'showImage']);

Route::get('/inventory/get', [InventoryController::class, 'index']);
Route::resource('permintaan-persediaan', PermintaanPersediaanController::class)->only([
    'index', 'store', 'show', 'update'
]);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/auth/user', [AuthController::class, 'user'])->name('user');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::resource('inventory', InventoryController::class);

    Route::get('/persediaan/cek-nama', [InventoryController::class, 'cekNama']);
    Route::post(
        'persediaan/upload-image',
        [InventoryController::class, 'imageUpload']
    );
});