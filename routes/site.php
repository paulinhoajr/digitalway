<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UsuarioController;

Route::controller(HomeController::class)
    ->name('site.')
    ->middleware(['auth', 'verified'])
    ->group(function () {
        Route::get('/', function() {
            return redirect('/home');
        });

        Route::get('/home', 'index')->name('index');
        Route::get('/videos', 'videos')->name('videos');
        Route::get('/documentos', 'documentos')->name('documentos');
        Route::get('/certificados', 'certificados')->name('certificados');
        Route::get('/escolas', 'escolas')->name('escolas');
    });


Route::group(['prefix' => '/usuarios', 'where'=>['id'=>'[0-9]+']], function () {

    Route::controller(UsuarioController::class)
        ->middleware(['auth', 'verified'])
        ->name('site.usuarios.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
        });

    Route::controller(UsuarioController::class)
        ->name('site.usuarios.')
        ->group(function () {

            Route::get('/create/{id}', 'create')->name('create');
            Route::post('/store', 'store')->name('store');

            Route::get('/edit', 'edit')->name('edit');
            Route::post('/update', 'update')->name('update');

            Route::get('/avancar', 'avancar')->name('avancar');
            Route::post('/avancar', 'avancar_post')->name('avancar.post');


        });

});
