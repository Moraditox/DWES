<?php

use App\Http\Controllers\CentroCivicoController;
use Illuminate\Support\Facades\Route;

Route::get('/centros', [CentroCivicoController::class, 'index'])->name('centros.index');
Route::get('/centros/create', [CentroCivicoController::class, 'create'])->name('centros.create');
Route::post('/centros', [CentroCivicoController::class, 'store'])->name('centros.store');
Route::get('/centros/{id}/edit', [CentroCivicoController::class, 'edit'])->name('centros.edit');
Route::put('/centros/{id}', [CentroCivicoController::class, 'update'])->name('centros.update');
Route::delete('/centros/{id}', [CentroCivicoController::class, 'destroy'])->name('centros.destroy');

