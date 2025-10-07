<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CenterController;
use App\Http\Controllers\ProfessionalController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/formularioAlta', [CenterController::class, 'create']);
Route::post('/insertCenter',[CenterController::class, 'store'])->name('insertCenter');

Route::get('/altaProfessional',[ProfessionalController::class, 'create']);
Route::post('/insertProfessional',[ProfessionalController::class, 'store'])->name('insertProfessional');