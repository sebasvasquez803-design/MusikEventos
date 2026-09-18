<?php

use App\Http\Controllers\UserController;
use App\Http\Middleware\EnsureTeamMembership;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CalendarioController;
use App\Http\Controllers\EventController;

Route::view('/', 'welcome')->name('home');



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
        
        // ----------------------
        // ----------------------
        // ----------------------
Route::view('/calendario', 'calendario')->name('calendario');
Route::get('/calendar', function () {
    return view('calendar');
})->name('calendar.view');

Route::get('/api/events', function () {
    return response()->json([
        [
            'id' => 1,
            'title' => 'Reunión de Laravel 13',
            'start' => now()->format('Y-m-d') . 'T10:00:00',
            'end' => now()->format('Y-m-d') . 'T12:00:00',
            'color' => '#3b82f6'
        ],
        [
            'id' => 2,
            'title' => 'Despliegue de Producción',
            'start' => now()->addDay()->format('Y-m-d'),
            'allDay' => true,
            'color' => '#ef4444'
        ]
    ]);
})->name('calendar.events');
