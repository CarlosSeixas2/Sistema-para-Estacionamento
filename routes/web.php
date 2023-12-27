<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\VagaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [VagaController::class, 'index'])->name('vagas.index');

Route::get('/vaga/${id}', [VagaController::class, 'show'])->name('vagas.show');

Route::get('/exit/${id}', [VagaController::class, 'exit'])->name('vagas.exit');

Route::get('/confirm/${dono}', [VagaController::class, 'confirm'])->name('vagas.confirm');

Route::get('/estacionar/${id}', [VagaController::class, 'estacionar'])->name('vagas.estacionar');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return redirect('/');
    })->name('dashboard');
});
