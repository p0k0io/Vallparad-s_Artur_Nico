<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CenterController;
use App\Http\Controllers\CvController;
use App\Http\Controllers\ProfessionalController;
use App\Http\Controllers\ProjectComisionController;


Route::get('/', function () {
    return view('welcome');
});

Route::resource('center',CenterController::class);
Route::resource('professional',ProfessionalController::class);
Route::resource('cv',CvController::class);
Route::resource('projects_comisions',ProjectComisionController::class);