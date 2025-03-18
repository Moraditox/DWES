<?php
use App\Http\Controllers\CentroCivicoController;
use Illuminate\Support\Facades\Route;

Route::get('/centros', [CentroCivicoController::class, 'index']);
Route::post('/centros', [CentroCivicoController::class, 'store']);
Route::get('/centros/{id}', [CentroCivicoController::class, 'show']);
Route::put('/centros/{id}', [CentroCivicoController::class, 'update']);
Route::delete('/centros/{id}', [CentroCivicoController::class, 'destroy']);

