<?php

use App\Http\Controllers\CarController;
use App\Http\Controllers\CarmodelController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BrandController;

Route::prefix('brands')->group(function () {
    Route::get('/', [BrandController::class, 'index'])->name('brand.index');
    Route::post('/store', [BrandController::class, 'store'])->name('brand.store');
    Route::get('/{id}', [BrandController::class, 'show'])->name('brand.show');
    Route::put('/{id}', [BrandController::class, 'update'])->name('brand.update');
    Route::delete('/{id}', [BrandController::class, 'destroy'])->name('brand.destroy');
});

Route::prefix('cars')->group(function () {
    Route::get('/', [CarController::class, 'index'])->name('car.index');
    Route::post('/store', [CarController::class, 'store'])->name('car.store');
    Route::get('/{id}', [CarController::class, 'show'])->name('car.show');
    Route::put('/{id}', [CarController::class, 'update'])->name('car.update');
    Route::delete('/{id}', [CarController::class, 'destroy'])->name('car.destroy');
});

Route::prefix('carmodels')->group(function () {
    Route::get('/', [CarmodelController::class, 'index'])->name('carmodel.index');
    Route::post('/store', [CarmodelController::class, 'store'])->name('carmodel.store');
    Route::get('/{id}', [CarmodelController::class, 'show'])->name('carmodel.show');
    Route::put('/{id}', [CarmodelController::class, 'update'])->name('carmodel.update');
    Route::delete('/{id}', [CarmodelController::class, 'destroy'])->name('carmodel.destroy');
});
