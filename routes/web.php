<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// relasi 1 - one to one
Route::get('relasi-1', function () {
    # Temukan mahasiswa dengan NIM 1015015072
    $mahasiswa = App\Models\Mahasiswa::where('nim', '=', '1015015088')->first();

    # Tampilkan nama wali mahasiswa
    return $mahasiswa->wali->nama;
});

// relasi one to Many
Route::get('relasi-2', function () {
    # Temukan mahasiswa dengan NIM 1015015072
    $mahasiswa = App\Models\Mahasiswa::where('nim', '=', '1015015072')->first();

    # Tampilkan nama dosen dari mahasiswa yang dipilih
    return $mahasiswa->dosen->nama;
});

Route::get('relasi-3', function () {
    # Temukan dosen yang bernama Yulianto
    $dosen = App\Models\Dosen::where('nama', '=', 'Yulianto')->first();

    # Tampilkan seluruh data mahasiswa dari dosen yang dipilih
    foreach ($dosen->mahasiswa as $data) {
        echo "<li>Nama : <strong>" . $data->nama . "</strong> - " . $data->nim . "</li>";
    }
});

// Relasi Many To Many
Route::get('relasi-4', function () {
    # Bila kita ingin melihat hobi saya
    $novay = App\Models\Mahasiswa::where('nama', '=', 'Noviyanto Rachmadi')->first();

    # Tampilkan seluruh hobi si novay
    foreach ($novay->hobi as $data) {
        echo '<li>' . $data->hobi . '</li>';
    }
});

Route::get('relasi-5', function () {
    # Temukan hobi Mandi Hujan
    $mandi_hujan = App\Models\Hobi::where('hobi', '=', 'Mandi Hujan')->first();

    # Tampilkan semua mahasiswa yang punya hobi mandi hujan
    foreach ($mandi_hujan->mahasiswa as $data) {
        echo '<li> Nama : ' . $data->nama . ' <strong>' . $data->nim . '</strong></li>';
    }
});

// latihan
Route::get('eloquent', function () {
    # Ambil semua data mahasiswa (lengkap dengan semua relasi yang ada)
    $mahasiswa = App\Models\Mahasiswa::with('wali', 'dosen', 'hobi')->get();
    // dd($mahasiswa);
    # Kirim variabel ke View
    return view('eloquent', compact('mahasiswa'));
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('produk', App\Http\Controllers\ProdukController::class)->middleware('auth');
Route::post('produk/export-produk', [App\Http\Controllers\ProdukController::class, 'exportPdf'])->name('produk.export-pdf');
Route::resource('merk', App\Http\Controllers\MerkController::class)->middleware('auth');
