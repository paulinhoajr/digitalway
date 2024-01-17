<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UsuarioController;
use App\Http\Controllers\Admin\EsperaController;
use App\Http\Controllers\Admin\EscolaController;
use App\Http\Controllers\Admin\TreinamentoController;
use App\Http\Controllers\Admin\CertificadoController;
use App\Http\Controllers\Admin\VideoController;
use App\Http\Controllers\Admin\DocumentoController;

Route::group(['prefix' => '/admin', 'where'=>['id'=>'[0-9]+']], function () {

    Route::controller(AdminController::class)
        ->name('admin.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
        });

    Route::group(['prefix' => '/usuarios'], function () {
        Route::controller(UsuarioController::class)
            ->name('admin.')
            ->group(function () {
                Route::get('/', 'index')->name('usuarios.index');
                Route::get('/create', 'create')->name('usuarios.create');
                Route::post('/store', 'store')->name('usuarios.store');
                Route::get('/show/{id}', 'show')->name('usuarios.show');
                Route::get('/edit/{id}', 'edit')->name('usuarios.edit');
                Route::post('/update', 'update')->name('usuarios.update');
                Route::get('/delete/{id}', 'delete')->name('usuarios.delete');
                Route::get('/destroy/{id}', 'destroy')->name('usuarios.destroy');
                Route::post('/escola', 'escola')->name('usuarios.escola');
                Route::get('/escola/delete/{escola_id}/{usuario_id}', 'escola_delete')->name('usuarios.escola.delete');
            });
    });

    Route::group(['prefix' => '/esperas'], function () {
        Route::controller(EsperaController::class)
            ->name('admin.')
            ->group(function () {
                Route::get('/', 'index')->name('esperas.index');
                Route::get('/importar', 'importar')->name('esperas.importar');
                Route::post('/store', 'store')->name('esperas.store');
            });
    });

    Route::group(['prefix' => '/escolas'], function () {
        Route::controller(EscolaController::class)
            ->name('admin.')
            ->group(function () {
                Route::get('/cidades', 'cidades')->name('escolas.cidades');
                Route::get('/{id?}', 'index')->name('escolas.index');
                Route::get('/create', 'create')->name('escolas.create');
                Route::post('/store', 'store')->name('escolas.store');
                Route::get('/show/{id}', 'show')->name('escolas.show');
                Route::get('/edit/{id}', 'edit')->name('escolas.edit');
                Route::post('/update', 'update')->name('escolas.update');
                Route::get('/delete/{id}', 'delete')->name('escolas.delete');
                Route::get('/destroy/{id}', 'destroy')->name('escolas.destroy');
                Route::get('/usuarios/csv/{id}', 'csv_usuario')->name('escolas.usuarios.csv');
                Route::post('/usuarios/gerar', 'gerar_usuario')->name('escolas.usuarios.gerar');
                Route::get('/csv', 'csv_escola')->name('escolas.csv');
                Route::post('/gerar', 'gerar_escola')->name('escolas.gerar');
                Route::post('/importar', 'importar_escola')->name('escolas.importar');
            });
    });

    Route::group(['prefix' => '/treinamentos'], function () {
        Route::controller(TreinamentoController::class)
            ->name('admin.')
            ->group(function () {
                Route::get('/', 'index')->name('treinamentos.index');
                Route::get('/create', 'create')->name('treinamentos.create');
                Route::post('/store', 'store')->name('treinamentos.store');
                Route::get('/show/{id}', 'show')->name('treinamentos.show');
                Route::get('/edit/{id}', 'edit')->name('treinamentos.edit');
                Route::post('/update', 'update')->name('treinamentos.update');
                Route::get('/delete/{id}', 'delete')->name('treinamentos.delete');
                Route::get('/destroy/{id}', 'destroy')->name('treinamentos.destroy');
                Route::get('/qrcode/{id}', 'qrcode')->name('treinamentos.qrcode');
                Route::get('/topico/delete/{id}', 'topico_delete')->name('treinamentos.topico_delete');
            });
    });

    Route::group(['prefix' => '/certificados'], function () {
        Route::controller(CertificadoController::class)
            ->name('admin.')
            ->group(function () {
                Route::get('/', 'index')->name('certificados.index');
            });
    });

    Route::group(['prefix' => '/videos'], function () {
        Route::controller(VideoController::class)
            ->name('admin.')
            ->group(function () {
                Route::get('/', 'index')->name('videos.index');
                Route::get('/create', 'create')->name('videos.create');
                Route::post('/store', 'store')->name('videos.store');
                Route::get('/show/{id}', 'show')->name('videos.show');
                Route::get('/edit/{id}', 'edit')->name('videos.edit');
                Route::post('/update', 'update')->name('videos.update');
                Route::get('/delete/{id}', 'delete')->name('videos.delete');
                Route::get('/destroy/{id}', 'destroy')->name('videos.destroy');
            });
    });

    Route::group(['prefix' => '/documentos'], function () {
        Route::controller(DocumentoController::class)
            ->name('admin.')
            ->group(function () {
                Route::get('/', 'index')->name('documentos.index');
                Route::get('/create', 'create')->name('documentos.create');
                Route::post('/store', 'store')->name('documentos.store');
                Route::get('/show/{id}', 'show')->name('documentos.show');
                Route::get('/edit/{id}', 'edit')->name('documentos.edit');
                Route::post('/update', 'update')->name('documentos.update');
                Route::get('/delete/{id}', 'delete')->name('documentos.delete');
                Route::get('/destroy/{id}', 'destroy')->name('documentos.destroy');
            });
    });

})->middleware(['auth','admin', 'verified']);
