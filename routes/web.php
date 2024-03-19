<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function (){
//     return view('home')
// });
//route resource
Route::resource('/keranjangs', \App\Http\Controllers\KeranjangController::class);
Route::resource('/penggunas', \App\Http\Controllers\PenggunaController::class);
Route::resource('/kategoris', \App\Http\Controllers\KategoriController::class);
Route::resource('/barangs', \App\Http\Controllers\BarangController::class);