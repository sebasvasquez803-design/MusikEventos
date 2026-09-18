<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\GrupoMusicalController;
use App\Http\Controllers\ResenaController;
use App\Http\Middleware\EnsureTeamMembership;
use Illuminate\Support\Facades\Route;

// Página principal con grupos musicales.
Route::get('/', [GrupoMusicalController::class, 'home'])->name('home');
Route::view('/welcome', 'welcome')->name('welcome');
Route::view('/grupo-musical', 'sesion.registro_grp')->name('grupo.musical');
Route::view('/reserva', 'formularios.reserva')->name('reserva');
Route::view('/registro-clientes', 'formularios.registro_clientes')->name('registro.clientes');
Route::view('/sesion-rep_leg', 'formularios.sesion_rep_leg')->name('sesion.rep.leg');
Route::view('/dash-rep', 'dash_rep')
    ->middleware('auth')
    ->name('dash.rep');
// Rutas web para crear, editar y eliminar grupos musicales.
Route::post('/grupo-musical', [GrupoMusicalController::class, 'storeFromForm'])->name('grupo-musical.store');
Route::get('/grupo-musical/{grupoMusical}/editar', [GrupoMusicalController::class, 'edit'])
    ->middleware('auth')
    ->name('grupo-musical.edit');
Route::put('/grupo-musical/{grupoMusical}', [GrupoMusicalController::class, 'updateFromForm'])
    ->middleware('auth')
    ->name('grupo-musical.update');
Route::delete('/grupo-musical/{grupoMusical}', [GrupoMusicalController::class, 'destroyFromForm'])
    ->middleware('auth')
    ->name('grupo-musical.destroy');
Route::post('/resenas', [ResenaController::class, 'storeFromForm'])
    ->name('resenas.store');
Route::put('/resenas/{resena}', [ResenaController::class, 'updateFromForm'])
    ->middleware('auth')
    ->name('resenas.update');
Route::delete('/resenas/{resena}', [ResenaController::class, 'destroyFromForm'])
    ->middleware('auth')
    ->name('resenas.destroy');
Route::view('/mas-info', 'formularios.mas_info')->name('mas_info');
Route::view('/regGrupMusc','sesion.regGrupSig')->name('siguiente');


Route::middleware('auth')->group(function () {
    Route::apiResource('users', UserController::class);
});

Route::prefix('{current_team}')
    ->middleware(['auth', 'verified', EnsureTeamMembership::class])
    ->group(function () {
        Route::view('dashboard', 'dashboard')->name('dashboard');
    });

    // Route::Get('/', function () {
    //     return view('');
    // });

require __DIR__.'/settings.php';

