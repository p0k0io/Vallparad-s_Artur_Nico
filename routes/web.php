<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CenterController;
use App\Http\Controllers\ProfessionalController;
use App\Http\Controllers\CvController;
use App\Http\Controllers\ProjectComisionController;
use App\Http\Controllers\UniformController;
use App\Http\Controllers\CourseController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EnrolledInController;


// Página principal
Route::get('/', function () {
    return view('welcome');
});

// Rutas de exportación de Uniforms (antes del resource para evitar conflictos)
Route::prefix('uniforms')->group(function () {
    Route::get('export', [UniformController::class, 'export'])->name('uniforms.export');
    Route::get('export-test', [UniformController::class, 'exportTest']);
});


Route::put('/uniforms/{uniform}/confirm', [UniformController::class, 'changeState'])
    ->name('uniforms.changeState');

Route::get('/exportar-inscritos', [EnrolledInController::class, 'export'])->name('inscritos.export');

Route::post('/enrolled-in', [\App\Http\Controllers\EnrolledInController::class, 'store']);
Route::resource('enrolled-in', EnrolledInController::class);



Route::post('/course', [CourseController::class, 'store']);


Route::resource('course', CourseController::class );

Route::resource('center', CenterController::class);

// Rutas de recursos
Route::resource('projects_comisions', ProjectComisionController::class);

//--------------------------------------------------------------------------------------------------------------------------
Route::resource('professional', ProfessionalController::class);

//Avaluacio
Route::get('/assessView/{professional}', [ProfessionalController::class, 'assessView'])->name('assessView.professional');
Route::put('/assess/{professional}',[ProfessionalController::class,'assess'])->name('assess.professional');


//Buscar Professionals Javascript
//Get no serveix de res?
Route::get('/search', function () {return view('index.professional');});
Route::post('/search', [ProfessionalController::class, 'search']);
//--------------------------------------------------------------------------------------------------------------------------

Route::resource('cv', CvController::class);
Route::resource('uniforms', UniformController::class);


//--------------------------------------------------------------------------------------------------------------------------
// Rutas para cambiar estado
Route::put('/changeStateP/{professional}', [ProfessionalController::class, 'changeStateP'])
    ->name('changeStateProfessional');

Route::put('/changeStateC/{center}', [CenterController::class, 'changeStateC'])
    ->name('changeStateCenter');

// Dashboard protegido
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Perfil protegido
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// Rutas de autenticación
require __DIR__.'/auth.php';
