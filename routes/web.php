<?php

use App\Http\Controllers\AccesosController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\ConfigurationController;
use App\Http\Controllers\DisponibilidadController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\EmpresaDisponibilidad;
use App\Http\Controllers\Main;
use App\Http\Controllers\MercadoPagoController;
use App\Http\Controllers\PlanesController;
use App\Http\Controllers\TrabajadoresController;
use App\Http\Controllers\TurnosController;
use App\Http\Controllers\UserController;
use App\Models\Accesos;
use App\Models\Disponibilidad;
use App\Models\EmpresaDispo;
use Illuminate\Support\Facades\Route;



Route::get('/secretline', [TurnosController::class, 'secretline']);


Route::get('/', [Main::class, 'welcome'])->name('welcome');
Route::get('/registro', [Main::class, 'registro'])->name('registro');
Route::get('/login', [Main::class, 'login'])->name('login');

Route::post('/validar-registro', [UserController::class, 'registro'])->name('validar-registro');
Route::get('/user/validar-email', [UserController::class, 'emailvalidateview'])->name('emailvalidateview');
Route::get('/emailverification/{token}', [UserController::class, 'EmailVerificationUser'])->name('emailverification');
Route::get('/recuperarcuenta', [UserController::class, 'RecuperarPasswordView'])->name('recuperar.password');
Route::post('/recovery', [UserController::class, 'recovery'])->name('recovery');
Route::get('/accountrecovery/{token}', [UserController::class, 'accountrecovery'])->name('accountrecovery');
Route::get('/emailvalidated', [UserController::class, 'EmailValidated'])->name('validated.email');
Route::post('/passwordreset', [UserController::class, 'passwordreset'])->name('update-password');

Route::post('/inicia-sesion', [UserController::class, 'login'])->name('inicia-sesion');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');
Route::get('/registrarTurno/{token}', [TurnosController::class, 'registrarTurno'])->name('registrar-turno');
Route::get('/api/horarioscliente/', [TurnosController::class, 'getHorariosDisponiblesCliente']);
Route::post('/createTurnoCliente', [TurnosController::class, 'createTurnoCliente'])->name('turnos-createCliente');

Route::get('/registrarTurnoEmpresa/{empresa}/{id}', [EmpresaController::class, 'registrarTurnoEmpresa'])->name('registrarTurnoEmpresa');
Route::get('/api/horariosclienteEmpresa/', [TurnosController::class, 'getHorariosDisponiblesClienteEmpresa']);
Route::post('/createTurnoClienteEmpresa', [TurnosController::class, 'createTurnoClienteEmpresa'])->name('turnos-createClienteEmpresa');

Route::get('/trabajadoresDashboard/{token}', [AccesosController::class, 'dashboard'])->name('TrabajadorDashboard');
Route::post('/dashboardLogin', [AccesosController::class, 'dashboardTrabajador'])->name('dashboardLogin.Access');

Route::get('/MenudeTurnosTrabajador/{id}/{hash}', [AccesosController::class, 'MenuTurnosTrabajador'])->name('TurnosMenuTrabajador');
Route::get('/turnosHoyTrabajador/{id}/{hash}', [TurnosController::class, 'TurnosHoyTrabajador'])->name('turnosHoyTrabajador');
Route::get('/turnosWeekTrabajador/{id}/{hash}', [TurnosController::class, 'TurnosWeekTrabajador'])->name('turnosWeekTrabajador');
Route::get('/turnosNextWeekTrabajador/{id}/{hash}', [TurnosController::class, 'TurnosNextWeekTrabajador'])->name('turnosNextWeekTrabajador');
Route::get('/turnosMonthTrabajador/{id}/{hash}', [TurnosController::class, 'TurnosMonthTrabajador'])->name('turnosMonthTrabajador');
Route::get('/turnosAllTrabajador/{id}/{hash}', [TurnosController::class, 'TurnosAllTrabajador'])->name('turnosAllTrabajador');


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

    // Premium

    Route::get('/empresa', [EmpresaController::class, 'empresa'])->name('empresa');
    Route::get('/crear', function () {return view('empresa.form');})->name('empresaForm');
    Route::post('/crearEmpresa', [EmpresaController::class, 'crearEmpresa'])->name('crearEmpresa');
    Route::get('/deleteEmpresa', [EmpresaController::class, 'destroy'])->name('Empresa.destroy');
    Route::post('/empresa/update-image', [EmpresaController::class, 'updateImage'])->name('empresa.updateImage');

    Route::get('/trabajadores', [TrabajadoresController::class, 'menu'])->name('trabajadores');
    Route::get('/create', function () {return view('trabajadores.form');})->name('formTrabajador');
    Route::post('/crearTrabajador', [TrabajadoresController::class, 'crearTrabajador'])->name('crearTrabajador');
    Route::get('/details/{id}', [TrabajadoresController::class, 'details'])->name('trabajador.details');
    Route::post('/trabajador/update-image', [TrabajadoresController::class, 'updateImage'])->name('trabajador.updateImage');
    Route::post('/trabajador/update-background', [TrabajadoresController::class, 'updateBackground'])->name('trabajador.updateBackground');
    Route::get('/deleteTrabajador/{id}', [TrabajadoresController::class, 'destroy'])->name('trabajador.destroy');
    Route::get('/trabajador/disponibilidad', [TrabajadoresController::class, 'DispTrabajador'])->name('trabajador.disp');

    Route::get('/TabajadorDispo/{id}', [EmpresaDisponibilidad::class, 'TrabajadorDispo'])->name('trabajador.disponibilidad');
    Route::get('/trabajador/edicion-horario/{id}', [EmpresaDisponibilidad::class, 'dispoedit'])->name('trabajador.disp-horaria-edit');
    Route::post('/trabajador/update-disp', [EmpresaDisponibilidad::class, 'update'])->name('trabajador.update-disp');
    Route::post('/trabajador/update-disp-todas', [EmpresaDisponibilidad::class, 'updateTodas'])->name('trabajador.update-disp-todas');
    Route::post('/trabajador/update-lapsos', [EmpresaDisponibilidad::class, 'updateLapsos'])->name('trabajador.update-lapsos');
    Route::get('/empresa/linkEmpresa', [EmpresaDisponibilidad::class, 'linkEmpresa'])->name('linkEmpresa');
    Route::post('/update-lapsos-turnosEmpresa', [EmpresaDisponibilidad::class, 'updateLapsosTurnosEmpresa'])->name('update-lapsos-turnosEmpresa');

    Route::view('/turnosEmpresa', 'empresa.turnosMenu')->name('TurnosMenuEmpresa');
    Route::get('/turnosHoyEmpresa', [TurnosController::class, 'TurnosHoyEmpresa'])->name('turnosHoyEmpresa');
    Route::get('/turnosWeekEmpresa', [TurnosController::class, 'TurnosWeekEmpresa'])->name('turnosWeekEmpresa');
    Route::get('/turnosNextWeekEmpresa', [TurnosController::class, 'TurnosNextWeekEmpresa'])->name('turnosNextWeekEmpresa');
    Route::get('/turnosMonthEmpresa', [TurnosController::class, 'TurnosMonthEmpresa'])->name('turnosMonthEmpresa');
    Route::get('/turnosAllEmpresa', [TurnosController::class, 'TurnosAllEmpresa'])->name('turnosAllEmpresa');

    Route::get('/turnosReciclados', [TurnosController::class, 'turnosRecicladosEmpresa'])->name('turnosReciclados');

    Route::get('/modificarTurnosEmpresa', [TurnosController::class, 'modificarTurnosEmpresa'])->name('modificar-turnosEmpresa');
    Route::delete('/turnosdel/{id}', [TurnosController::class, 'destroyEmpresa'])->name('turnos.destroyEmpresa');

    Route::get('/accesos', [AccesosController::class, 'accesos'])->name('accesos');
    Route::get('/trabajadorAcceso/{id}', [AccesosController::class, 'TrabajadorAcceso'])->name('trabajador.acceso');

    // suscripcion
   Route::get('/suscripcion', [PlanesController::class, 'suscripcion'])->name('suscripcion');
   Route::get('/suscribirse/{id}', [PlanesController::class, 'suscripcionSelected'])->name('suscripcion-selected');

   // configuration
   Route::get('/config', [ConfigurationController::class, 'UserConfiguration'])->name('config');
   Route::post('/configuracion/updatePerfil', [ConfigurationController::class, 'UpdatePerfil'])->name('configPerfilUpdate');
   Route::post('/configuracion/password', [ConfigurationController::class, 'UpdatePassword'])->name('configPasswordUpdate');

   // MercadoPago
   Route::get('/createPreapprovalPlan', [MercadoPagoController::class, 'createPreapprovalPlan'])->name('crearSuscripcion');
   Route::get('/searchPreapprovalPlan', [MercadoPagoController::class, 'searchPreapprovalPlan'])->name('buscaSuscripcion');
   Route::get('/preapprovalIdPlan/{id}', [MercadoPagoController::class, 'obtenerPreapprovalPlan'])->name('obtenerSuscripcion');
   Route::get('/actualizarPlan/{id}', [MercadoPagoController::class, 'actualizarPlan'])->name('actualizarSuscripcion');
   Route::get('/suscriptionExport', [MercadoPagoController::class, 'suscriptionExport'])->name('exportarSuscripciones');
});
