<?php
use App\Http\Controllers\AdminViewController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\AnggotaViewController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PengembalianController;
use App\Http\Controllers\PustakawanController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [AnggotaViewController::class, 'homepage']);
Route::get('/buku', [AnggotaViewController::class, 'buku']);
Route::get('/buku/{id}', [AnggotaViewController::class, 'bukuDetail'])->name('buku.detail');

Route::prefix('/auth')->group(function () {
    Route::get('/anggota', [AuthController::class, 'anggotaView'])->name('login.anggota');
    Route::post('/anggota', [AuthController::class, 'anggotaProcess'])->name('login.anggotaProcess');

    Route::get('/admin', [AuthController::class, 'adminView'])->name('login.admin');
    Route::post('/admin', [AuthController::class, 'adminProcess'])->name('login.adminProcess');
});


Route::middleware('logSuccess')->group(function () {
    Route::post('/auth/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/histori-peminjaman', [AnggotaController::class, 'historiPeminjaman']);
    Route::get('/histori-pengembalian', [AnggotaController::class, 'historiPengembalian']);


    Route::prefix('/admin')->middleware('notAnggota')->group(function () {
        // VIEW || VIEW || VIEW || VIEW || VIEW
        Route::get('/dashboard', [AdminViewController::class, 'dashboard']);
        Route::get('/peminjaman', [AdminViewController::class, 'peminjaman']);
        Route::get('/pengembalian', [AdminViewController::class, 'pengembalian']);


        // ENTRI PEMINJAMAN || ENTRI PEMINJAMAN || ENTRI PEMINJAMAN || ENTRI PEMINJAMAN
        Route::post('/peminjaman', [PeminjamanController::class, 'store'])->name('peminjaman.store');
        Route::put('/peminjaman/{id}', [PeminjamanController::class, 'update'])->name('peminjaman.update');
        Route::delete('/peminjaman/{id}', [PeminjamanController::class, 'destroy'])->name('peminjaman.destroy');
        Route::put('/peminjaman-dikembalikan/{id}', [PeminjamanController::class, 'dikembalikan'])->name('peminjaman.dikembalikan');
        Route::post('/peminjaman-pdf-stream', [PeminjamanController::class, 'streamPdf'])->name('peminjaman.streamPdf');
        Route::post('/peminjaman-pdf-download', [PeminjamanController::class, 'downloadPdf'])->name('peminjaman.downloadPdf');


        // ENTRI PENGEMBALIAN || ENTRI PENGEMBALIAN || ENTRI PENGEMBALIAN || ENTRI PENGEMBALIAN
        // Route::post('/pengembalian', [PengembalianController::class, 'store'])->name('pengembalian.store');
        Route::put('/pengembalian/{id}', [PengembalianController::class, 'update'])->name('pengembalian.update');
        Route::delete('/pengembalian/{id}', [PengembalianController::class, 'destroy'])->name('pengembalian.destroy');
        Route::put('/pengembalian-rollback/{id}', [PengembalianController::class, 'rollback'])->name('pengembalian.rollback');
        Route::post('/pengembalian-pdf-stream', [PengembalianController::class, 'streamPdf'])->name('pengembalian.streamPdf');
        Route::post('/pengembalian-pdf-download', [PengembalianController::class, 'downloadPdf'])->name('pengembalian.downloadPdf');


        Route::middleware('onlyAdmin')->group(function() {
            // VIEW || VIEW || VIEW || VIEW || VIEW
            Route::get('/kategori', [AdminViewController::class, 'kategori']);
            Route::get('/buku', [AdminViewController::class, 'buku']);
            Route::get('/buku/{id}', [AdminViewController::class, 'bukuDetail']);
            Route::get('/anggota', [AdminViewController::class, 'anggota']);
            Route::get('/anggota/{id}', [AdminViewController::class, 'anggotaDetail']);
            Route::get('/pustakawan', [AdminViewController::class, 'pustakawan']);
            Route::get('/pustakawan/{id}', [AdminViewController::class, 'pustakawanDetail']);
            

            // KATEGORI || KATEGORI || KATEGORI || KATEGORI
            Route::post('/kategori', [KategoriController::class, 'store'])->name('kategori.store');
            Route::put('/kategori/{id}', [KategoriController::class, 'update'])->name('kategori.update');
            Route::delete('/kategori/{id}', [KategoriController::class, 'destroy'])->name('kategori.destroy');

            // BUKU || BUKU || BUKU || BUKU 
            Route::post('/buku', [BukuController::class, 'store'])->name('buku.store');
            Route::put('/buku/{id}', [BukuController::class, 'update'])->name('buku.update');
            Route::delete('/buku/{id}', [BukuController::class, 'destroy'])->name('buku.destroy');

            // ANGGOTA || ANGGOTA || ANGGOTA || ANGGOTA
            Route::post('/anggota', [AnggotaController::class, 'store'])->name('anggota.store');
            Route::put('/anggota/{id}', [AnggotaController::class, 'update'])->name('anggota.update');
            Route::delete('/anggota/{id}', [AnggotaController::class, 'destroy'])->name('anggota.destroy');

            // PUSTAKAWAN || PUSTAKAWAN || PUSTAKAWAN || PUSTAKAWAN
            Route::post('/pustakawan', [PustakawanController::class, 'store'])->name('pustakawan.store');
            Route::put('/pustakawan/{id}', [PustakawanController::class, 'update'])->name('pustakawan.update');
            Route::delete('/pustakawan/{id}', [PustakawanController::class, 'destroy'])->name('pustakawan.destroy');
        });
    });
});
