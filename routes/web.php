<?php

use App\Http\Controllers\ListaController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\RemediosController;
use Illuminate\Support\Facades\Route;

Route::get('/', [MainController::class, 'index'])->name('home');
Route::get('/remedios', [RemediosController::class, 'index'])->name('remedios.home');

Route::get('/remedios/create', [RemediosController::class, 'create'])->name('remedios.create');
Route::post('/remedios/store', [RemediosController::class, 'store'])->name('remedios.store');

Route::get('/remedios/update/{id}', [RemediosController::class, 'update'])->name('remedios.update');
Route::post('/remedios/edit', [RemediosController::class, 'edit'])->name('remedios.edit');

Route::get('/remedios/delete/{id}',[RemediosController::class, 'delete'])->name('remedios.delete');
Route::get('/remedios/destroy/{id}',[RemediosController::class, 'destroy'])->name('remedios.destroy');

Route::get('/remedios/fim_de_estoque', [RemediosController::class, 'fimDeEstoque'])->name('remedios.fimDeEstoque');

Route::get('/remedios/medicamento/{id}', [RemediosController::class, 'medicamento'])->name('remedios.medicamento');

// marcar dose tomada
Route::post('/remedios/{id}/take', [RemediosController::class, 'take'])->name('remedios.take');

// lista de medicamentos diarios
Route::get('/lista', [ListaController::class, 'index'])->name('lista.index');