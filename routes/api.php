<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BrandController;

Route::get('/brands', [BrandController::class, 'index'])->name('brand.index');
