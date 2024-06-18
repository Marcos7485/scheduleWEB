<?php

use App\Http\Controllers\Main;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;



Route::get('/', [Main::class, 'welcome'])->name('welcome');
Route::get('/registro', [Main::class, 'registro'])->name('registro');
Route::get('/login', [Main::class, 'login'])->name('login');


Route::post('/validar-registro', [UserController::class, 'registro'])->name('validar-registro');
Route::post('/inicia-sesion', [UserController::class, 'login'])->name('inicia-sesion');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');


Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [Main::class, 'dashboard'])->name('dashboard');
});
