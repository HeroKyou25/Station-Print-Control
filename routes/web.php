<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PrintController;

Route::get('/', [PrintController::class, 'index']);
Route::get('/upload', [PrintController::class, 'uploadPage']);
Route::post('/upload', [PrintController::class, 'store']);
Route::get('/paid/{id}', [PrintController::class, 'markPaid']);
Route::post('/reset', [PrintController::class, 'reset']);
Route::get('/done/{id}', [PrintController::class, 'markDone']);
// Pastikan ada ->name('print.done') di ujungnya
Route::post('/done/{id}', [PrintController::class, 'markDone'])->name('print.done');