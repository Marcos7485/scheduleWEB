<?php

use App\Http\Controllers\DisponibilidadController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\Main;
use App\Http\Controllers\TrabajadoresController;
use App\Http\Controllers\TurnosController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;



Route::get('/secretline', [TurnosController::class, 'secretline']);


Route::get('/', [Main::class, 'welcome'])->name('welcome');
Route::get('/registro', [Main::class, 'registro'])->name('registro');
Route::get('/login', [Main::class, 'login'])->name('login');


Route::post('/validar-registro', [UserController::class, 'registro'])->name('validar-registro');
Route::post('/inicia-sesion', [UserController::class, 'login'])->name('inicia-sesion');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');
Route::get('/registrarTurno/{token}', [TurnosController::class, 'registrarTurno'])->name('registrar-turno');
Route::get('/api/horarioscliente/', [TurnosController::class, 'getHorariosDisponiblesCliente']);
Route::post('/createTurnoCliente', [TurnosController::class, 'createTurnoCliente'])->name('turnos-createCliente');



Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [Main::class, 'dashboard'])->name('dashboard');
    Route::get('/geral-link', [TurnosController::class, 'geralLink'])->name('geral-link');

    Route::view('/turnos', 'turnos.turnosMenu')->name('TurnosMenu');
    Route::get('/turnosHoy', [TurnosController::class, 'TurnosHoy'])->name('turnosHoy');
    Route::get('/turnosWeek', [TurnosController::class, 'TurnosWeek'])->name('turnosWeek');
    Route::get('/turnosNextWeek', [TurnosController::class, 'TurnosNextWeek'])->name('turnosNextWeek');
    Route::get('/turnosMonth', [TurnosController::class, 'TurnosMonth'])->name('turnosMonth');
    Route::get('/turnosAll', [TurnosController::class, 'TurnosAll'])->name('turnosAll');
    Route::get('/darTurnos', [TurnosController::class, 'darTurnos'])->name('darTurnos');

    Route::get('/crearTurnos', [TurnosController::class, 'crearTurnos'])->name('create-turno');
    Route::get('/modificarTurnos', [TurnosController::class, 'modificarTurnos'])->name('modificar-turnos');

    Route::post('/createup', [TurnosController::class, 'create'])->name('turnos-create');
    Route::get('/api/horarios', [TurnosController::class, 'getHorariosDisponibles']);
    Route::post('/api/hash', [TurnosController::class, 'generateTurnosHash']);

    Route::delete('/turnos/{id}', [TurnosController::class, 'destroy'])->name('turnos.destroy');

    Route::get('/disponibilidad', [DisponibilidadController::class, 'disp'])->name('disponibilidad');
    Route::get('/edicion-horario', [DisponibilidadController::class, 'dispoedit'])->name('disp-horaria-edit');
    Route::post('/update-disp', [DisponibilidadController::class, 'update'])->name('update-disp');
    Route::post('/update-disp-todas', [DisponibilidadController::class, 'updateTodas'])->name('update-disp-todas');
    Route::post('/update-lapsos', [DisponibilidadController::class, 'updateLapsos'])->name('update-lapsos');
    Route::post('/update-lapsos-turnos', [DisponibilidadController::class, 'updateLapsosTurnos'])->name('update-lapsos-turnos');
    Route::post('/update-lapsos-global', [DisponibilidadController::class, 'updateLapsoGlobalHash'])->name('update-lapsos-global');

    Route::get('/empresa', [EmpresaController::class, 'empresa'])->name('empresa');
    Route::get('/crear', function () {return view('empresa.form');})->name('empresaForm');
    Route::post('/crearEmpresa', [EmpresaController::class, 'crearEmpresa'])->name('crearEmpresa');
    Route::get('/deleteEmpresa', [EmpresaController::class, 'destroy'])->name('Empresa.destroy');
    Route::post('/empresa/update-image', [EmpresaController::class, 'updateImage'])->name('empresa.updateImage');


    Route::get('/trabajadores', [TrabajadoresController::class, 'menu'])->name('trabajadores');
    Route::get('/create', function () {return view('trabajadores.form');})->name('formTrabajador');
    Route::post('/crearTrabajador', [TrabajadoresController::class, 'crearTrabajador'])->name('crearTrabajador');
    Route::get('/details/{id}', [TrabajadoresController::class, 'details'])->name('trabajador.details');
});
