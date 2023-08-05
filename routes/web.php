<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

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
//Route Admin
Route::get('/beranda',[AdminController::class,'Beranda']);
Route::get('/data-buku',[AdminController::class,'DataBuku']);
Route::get('/data-anggota',[AdminController::class,'DataAnggota']);
Route::get('/data-pengunjung',[AdminController::class,'DataPengunjung']);




Route::get('/laporan',[AdminController::class,'Laporan']);

/* Admin - Data Buku  */
Route::get('/data-buku',[AdminController::class,'DataBuku'])->name('data-buku');

//create
Route::post('/data-buku/tambah',[AdminController::class,'TambahDataBuku']);
//Update
Route::post('/data-buku/{id}',[AdminController::class,'UpdateDataBuku']);
//Delete
Route::get('/data-buku/delete/{id}',[AdminController::class,'DeleteDataBuku']);
//stok
// input validation
// Route::get('/data-buku/search',[AdminController::class,'search']);

/* ----------------------------------------------------------------------------------------------------------------------------- */

/* Admin - Data Anggota */
Route::get('/data-anggota',[AdminController::class,'DataAnggota'])->name('data-anggota');
//create
Route::post('/data-anggota',[AdminController::class,'TambahDataAnggota']);
//Update
Route::post('/data-anggota/{id}',[AdminController::class,'UpdateDataAnggota']);
//Delete
Route::get('/data-anggota/delete/{id}',[AdminController::class,'DeleteDataAnggota']);
/* ----------------------------------------------------------------------------------------------------------------------------- */

/* Admin - Data Pengunjung */
Route::get('/data-pengunjung',[AdminController::class,'DataPengunjung'])->name('data-pengunjung');
//create
Route::post('/data-pengunjung',[AdminController::class,'TambahDataPengunjung']);
//Update
Route::post('/data-pengunjung/{id}',[AdminController::class,'UpdateDataPengunjung']);
//Delete
Route::get('/data-pengunjung/delete/{id}',[AdminController::class,'DeleteDataPengunjung']);
/* ----------------------------------------------------------------------------------------------------------------------------- */

/* Admin - Peminjaman dan Pengembalian Mandiri  */
Route::get('/peminjamandanpengembalian-mandiri',[AdminController::class,'PeminjamandanPengembalianMandiri'])->name('pinjam-mandiri');
//Create
Route::post('/peminjamandanpengembalian-mandiri',[AdminController::class,'TambahPeminjamanMandiri'])->name('pinjam-mandiri.create');
//Delete
Route::get('/peminjamandanpengembalian-mandiri/delete/{id}',[AdminController::class,'DeletePeminjamanMandiri'])->name('pinjam-mandiri.delete');
//Kembali
Route::get('/peminjamandanpengembalian-mandiri/update/{id}',[AdminController::class,'KembalikanMandiri'])->name('pinjam-mandiri.update');
//Perpanjang
Route::get('/peminjamandanpengembalian-mandiri/perpanjang/{id}', [AdminController::class, 'PerpanjangMandiri'])->name('pinjam-mandiri.perpanjang');
/* ----------------------------------------------------------------------------------------------------------------------------- */

/* Admin - Peminjaman dan Pengembalian Kolektif  */
Route::get('/peminjamandanpengembalian-kolektif',[AdminController::class,'PeminjamandanPengembalianKolektif'])->name('pinjam-kolektif');
//Create
Route::post('/peminjamandanpengembalian-kolektif',[AdminController::class,'TambahPeminjamanKolektif'])->name('pinjam-kolektif.create');
//Kembali
Route::get('/peminjamandanpengembalian-kolektif/update/{id}',[AdminController::class,'KembalikanKolektif'])->name('pinjam-kolektif.update');
//Delete
Route::get('/peminjamandanpengembalian-kolektif/delete/{id}',[AdminController::class,'DeletePeminjamanKolektif'])->name('pinjam-kolektif.delete');


//Rooute Siswa
//Route Kepala Sekolah

