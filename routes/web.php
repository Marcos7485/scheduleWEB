<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('index');

Route::view('/registro', 'session.register')->name('registro');
Route::view('/login', 'session.login')->name('login');

Route::middleware(['auth'])->group(function () {
    Route::view('/schedule', 'schedule.main')->name('schedule');
});




Route::post('/validar-registro', [UserController::class, 'registro'])->name('validar-registro');
Route::post('/inicia-sesion', [UserController::class, 'login'])->name('inicia-sesion');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');