<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GeralController;

Route::controller(GeralController::class)
    ->group(function (){
        Route::get('autocomplete/cidades', 'autocomplete')->name('cidades.autocomplete');
        Route::get('autocomplete/escolas', 'autocomplete_escola')->name('escolas.autocomplete');
    });

require __DIR__.'/auth.php';
