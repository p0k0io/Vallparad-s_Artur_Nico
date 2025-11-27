<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CenterController;
use App\Http\Controllers\ProfessionalController;
use App\Http\Controllers\CvController;
use App\Http\Controllers\ProjectComisionController;
use App\Http\Controllers\ProjectComissionAssignedController;
use App\Http\Controllers\UniformController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\IncidentController;
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\AccidentabilityController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EnrolledInController;


// Página principal
Route::get('/', function () {
    return view('welcome');
});


//--------------------------------------------------Incidents--------------------------------------------------------------------
Route::resource('incident', IncidentController::class);

//--------------------------------------------------Manteniment------------------------------------------------------------------
Route::resource('maintenance', MaintenanceController::class);

//--------------------------------------------------Accidentability--------------------------------------------------------------
Route::resource('accidentability', AccidentabilityController::class);


//--------------------------------------------------Uniformes------------------------------------------------------------------------

// Rutas de exportación de Uniforms (antes del resource para evitar conflictos)
Route::resource('uniforms', UniformController::class);

Route::prefix('uniforms')->group(function () {
    Route::get('export', [UniformController::class, 'export'])->name('uniforms.export');
    Route::get('export-test', [UniformController::class, 'exportTest']);
});

Route::put('/uniforms/{uniform}/confirm', [UniformController::class, 'changeState'])
    ->name('uniforms.changeState');


//--------------------------------------------------Cursos------------------------------------------------------------------------

Route::get('/exportar-inscritos', [EnrolledInController::class, 'export'])->name('inscritos.export');

Route::post('/enrolled-in', [EnrolledInController::class, 'store']);
Route::resource('enrolled-in', EnrolledInController::class);



Route::post('/course', [CourseController::class, 'store']);


Route::resource('course', CourseController::class );

Route::resource('center', CenterController::class);

//--------------------------------------------------Projectes i Comisions------------------------------------------------------------------------

Route::resource('projects_comisions', ProjectComisionController::class);

Route::post('/storeProj', [ProjectComissionAssignedController::class, 'store']);
Route::resource('project_comision_assignment', ProjectComissionAssignedController::class);

Route::get('/exportar-assignats', [ProjectComissionAssignedController::class, 'exportAssigned'])->name('assigned.export');


//--------------------------------------------------Professionals------------------------------------------------------------------------


Route::resource('professional', ProfessionalController::class);

//Seguiment
Route::get('/trackingViewProfessional/{professional}', [ProfessionalController::class, 'trackingViewProfessional'])->name('trackingViewProfessional.professional');

Route::get('/trackingView/{professional}', [ProfessionalController::class, 'trackingView'])->name('trackingView.professional');
Route::post('/track/{professional}', [ProfessionalController::class, 'track'])->name('track.professional');


//Avaluacio
Route::get('/assessViewProfessional/{professional}', [ProfessionalController::class, 'assessViewProfessional'])->name('assessViewProfessional.professional');
Route::get('/assessView/{professional}', [ProfessionalController::class, 'assessView'])->name('assessView.professional');
Route::put('/assess/{professional}',[ProfessionalController::class,'assess'])->name('assess.professional');

//Route::get('/getAssessment',[ProfessionalController::class,'getAssessment'])->name('getAssessment.professional');
Route::post('/getAssessment', [ProfessionalController::class, 'getAssessment'])->name('getAssessment.professional');

//Buscar Professionals Javascript
//Get no serveix de res?
Route::get('/search', function () {return view('index.professional');});
Route::post('/search', [ProfessionalController::class, 'search']);


Route::resource('cv', CvController::class);

// Rutas para cambiar estado
Route::put('/changeStateP/{professional}', [ProfessionalController::class, 'changeStateP'])
    ->name('changeStateProfessional');


//--------------------------------------------------Centres------------------------------------------------------------------------

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
