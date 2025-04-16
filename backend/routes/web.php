<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AgendamentoController;
// Route default
Route::get('/', function () {
    return view('welcome');
});

// Routes of login
Route::get(
    'signin',
    [AuthController::class, 'signin'])->name('signin'
);
Route::post(
    'signin',
    [AuthController::class, 'signin']
);

// Routes of signup
Route::get(
    '/signup',
    [AuthController::class, 'signup'])->name('signup'
);
Route::post(
    '/signup',
    [AuthController::class, 'signup']
);

// Route of logout
Route::get('/logout', function () {
    session()->flush();
    return redirect()->route('dashboard');
});

// Route of dashboard
Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

// Routes of new schedules
Route::get('/dashboard/novo-agendamento', [AgendamentoController::class, 'novo_agendamento'])->name('novo_agendamento');
Route::post('/dashboard/novo-agendamento', [AgendamentoController::class, 'novo_agendamento'])->name('dashboard/novo-agendamento');
Route::get('/dashboard/novo-agendamento/{data}', [AgendamentoController::class, 'getAgendamentos']);
Route::get('/dashboard/novo-agendamento/{data}/{hora}', [AgendamentoController::class, 'getQuadrasIndisponiveis']);

Route::get('/dashboard/meus-agendamentos', [AgendamentoController::class, 'meus_agendamentos'])->name('meus_agendamentos');

Route::get('/dashboard/delete-agendamentos', [AgendamentoController::class, 'meus_agendamentos'])->name('meus_agendamentos');
Route::get('/dashboard/delete-agendamentos/{id}', [AgendamentoController::class, 'meus_agendamentos'])->name('meus_agendamentos');
Route::delete('/dashboard/delete-agendamentos/{id}', [AgendamentoController::class, 'delete_agendamentos'])->name('delete_agendamentos');

Route::get('/dashboard/admin/agendamentos', [DashboardController::class, 'todosAgendamentos'])->name('todos_agendamentos');

