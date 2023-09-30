<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\GeralController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [UsuarioController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [UsuarioController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [UsuarioController::class, 'destroy'])->name('profile.destroy');
});

Route::controller(GeralController::class)
    ->group(function (){
        Route::get('autocomplete/cidades', 'autocomplete')->name('cidades.autocomplete');
        Route::get('autocomplete/escolas', 'autocomplete_escola')->name('escolas.autocomplete');
    });

require __DIR__.'/auth.php';
