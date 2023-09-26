<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::get('/admin', function () {

    dd("admin");
    //return view('admin_dashboard');

})->middleware(['auth', 'verified'])->name('admin_dashboard');

