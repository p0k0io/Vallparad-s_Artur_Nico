<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CenterController;
use App\Http\Controllers\ProfessionalController;
use App\Http\Controllers\CvController;
use App\Http\Controllers\ProjectComisionController;
use App\Models\Professional;
use App\Http\Controllers\UniformController;




use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('center',CenterController::class);
Route::resource('professional',ProfessionalController::class);
Route::resource('cv',CvController::class);
Route::resource('uniforms',UniformController::class);
Route::get('uniforms/export', [UniformController::class, 'export'])->name('uniforms.export');

//changeState pasa un objecto professional con todos los datos de el professional el cual se quiere canviar el estado
Route::put('/changeStateP/{professional}',[ProfessionalController::class,'changeStateP'])->name('changeStateProfessional');

Route::put('/changeStateC/{center}',[CenterController::class,'changeStateC'])->name('changeStateCenter');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
