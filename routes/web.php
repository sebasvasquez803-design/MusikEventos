<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\GrupoMusicalController;
use App\Http\Middleware\EnsureTeamMembership;
use Illuminate\Support\Facades\Route;

Route::get('/', [GrupoMusicalController::class, 'home'])->name('home');
Route::view('/welcome', 'welcome')->name('welcome');
Route::view('/grupo-musical', 'sesion.registro_grp')->name('grupo.musical');
Route::view('/reserva', 'formularios.reserva')->name('reserva');
Route::view('/registro-clientes', 'formularios.registro_clientes')->name('registro.clientes');
Route::post('/grupo-musical', [GrupoMusicalController::class, 'storeFromForm'])->name('grupo-musical.store');


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

