<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CenterController;
use App\Http\Controllers\CvController;
use App\Http\Controllers\ProfessionalController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/formularioAlta', [CenterController::class, 'create']);
Route::post('/insertCenter',[CenterController::class, 'store'])->name('insertCenter');

Route::get('/altaCv', [CvController::class, 'create']);
Route::post('/insertCv',[CvController::class, 'store'])->name('insertCv');

//Route::get('/altaProfessional', [ProfessionalController::class,'create']);
//Route::post('/insertProfessional',[ProfessionalController::class, 'store'])->name('insertProfesional');


Route::get('/indexCenter', [CenterController::class, 'index']);

Route::get('/indexProfessional', [ProfessionalController::class,'index']);