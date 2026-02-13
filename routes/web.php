<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecetteController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test-email', [RecetteController::class, 'testEmail']);

Route::resource('recettes', RecetteController::class);
