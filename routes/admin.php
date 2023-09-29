<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;

Route::group(['prefix' => '/admin', 'where'=>['id'=>'[0-9]+']], function () {

    Route::controller(AdminController::class)
        ->name('admin.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
        });

})->middleware(['auth','admin', 'verified']);
