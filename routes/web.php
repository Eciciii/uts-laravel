<?php

use Illuminate\Support\Facades\Route;

//route resource
Route::resource('/keranjangs', \App\Http\Controllers\KeranjangController::class);
Route::resource('/penggunas', \App\Http\Controllers\PenggunaController::class);