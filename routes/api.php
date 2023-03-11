<?php

use App\Http\Controllers\EventoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('evento', [EventoController::class, 'store'])->name('evento.add');
Route::post('evento/search', [EventoController::class, 'search'])->name('evento.search');
Route::get('evento', [EventoController::class, 'index'])->name('evento.index');
Route::get('evento/{id}', [EventoController::class, 'show'])->name('evento.show');
Route::put('evento/{id}', [EventoController::class, 'update'])->name('evento.update');
Route::delete('evento/{id}', [EventoController::class, 'delete'])->name('evento.delete');
