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

        //Route::get('/certificados', 'certificados')->name('certificados');
        //Route::get('/escolas', 'escolas')->name('escolas');
    });

Route::controller(HomeController::class)
    ->name('site.')
    ->group(function () {

        Route::get('/confirma/{id}', 'confirma')->name('confirma');
        Route::get('/teste', 'teste')->name('teste');

    });

Route::group(['prefix' => '/usuarios', 'where'=>['id'=>'[0-9]+']], function () {

    Route::controller(UsuarioController::class)
        ->middleware(['auth', 'verified'])
        ->name('site.usuarios.')
        ->group(function () {
            Route::get('/', 'index')->name('index');

            Route::get('/edit', 'edit')->name('edit');
            Route::post('/update', 'update')->name('update');

            Route::get('/certificados', 'certificados')->name('certificados');
            Route::get('/certificados/gerar/{id}', 'gerar')->name('certificados.gerar');
            Route::get('/escolas', 'escolas')->name('escolas');
            Route::get('/videos', 'videos')->name('videos');
            Route::get('/documentos', 'documentos')->name('documentos');
        });

    Route::controller(UsuarioController::class)
        ->name('site.usuarios.')
        ->group(function () {

            Route::get('/create/{id}', 'create')->name('create');
            Route::post('/store', 'store')->name('store');

            Route::get('/avancar', 'avancar')->name('avancar');
            Route::post('/avancar', 'avancar_post')->name('avancar.post');

            Route::get('/qrcode/{id}', 'qrcode')->name('qrcode');
            Route::post('/qrcode', 'qrcode_post')->name('qrcode.post');

        });

});
