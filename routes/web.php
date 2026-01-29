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
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\AccidentabilityController;
use App\Http\Controllers\RrhhController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EnrolledInController;
use App\Http\Controllers\CenterManagementDocumentController;
use App\Http\Controllers\ExternalContactController;
use App\Http\Controllers\ServeiGeneralController;
use App\Http\Controllers\ComplementaryServiceController;
use App\Http\Controllers\ComplementaryServiceDocumentController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MaintenanceDocumentController;
use App\Http\Controllers\RrhhDocumentController;

// Página principal
Route::get('/', function () {
    return view('welcome');
});



//--------------------------------------------------Manteniment------------------------------------------------------------------
Route::resource('maintenance', MaintenanceController::class);
Route::post('/changeStateM', [MaintenanceController::class, 'changeStateM'])->name('changeStateM.maintenance');
Route::post('/createMaintenanceTracking', [MaintenanceController::class, 'createMaintenanceTracking'])->name('createMaintenanceTracking.maintenance');

Route::get('/maintenance/{document}/download',[MaintenanceDocumentController::class, 'download'])->name('maintenanceDocument.download');


//--------------------------------------------------Accidentability--------------------------------------------------------------
Route::resource('accidentability', AccidentabilityController::class);
Route::post('/changeStateBaixa', [AccidentabilityController::class, 'changeStateBaixa'])->name('changeStateBaixa.maintenance');

Route::get('/downloadAccident/{accident}', [AccidentabilityController::class, 'downloadAccident'])
    ->name('accidentability.downloadAccident');

Route::get('/indexPerProfessional/professional/{professional}', [AccidentabilityController::class, 'indexPerProfessional'])->name('accidentability.indexPerProfessional');




//--------------------------------------------------RRHH--------------------------------------------------------------
Route::resource('rrhh', RrhhController::class);
Route::post('/changeStateRrhh', [RrhhController::class, 'changeStateRrhh'])->name('changeStateRrhh.rrhh');
Route::post('/createRrhhTracking', [RrhhController::class, 'createRrhhTracking'])->name('createRrhhTracking.rrhh');

Route::get('/rrhh/{document}/download',[RrhhDocumentController::class, 'download'])->name('rrhhDocument.download');


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

Route::get('/removeAssignation/{idPC}/{idProf}', [ProjectComissionAssignedController::class, 'removeAssignation'])->name('removeAssignation.projectComissionAssignment');


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
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//Documentacion interna centro
Route::get('/', function () {
    return redirect()->route('documents.index');
});

Route::post('/documents', [CenterManagementDocumentController::class, 'store'])->name('documents.store');

// Rutas para los documentos
Route::prefix('documents')->group(function () {
    Route::get('/', [CenterManagementDocumentController::class, 'index'])->name('documents.index');
    Route::get('/{id}', [CenterManagementDocumentController::class, 'show'])->name('documents.show');
    Route::get('/create', [CenterManagementDocumentController::class, 'create'])->name('documents.create'); // opcional si haces formulario
    Route::post('/', [CenterManagementDocumentController::class, 'store'])->name('documents.store');
    Route::get('/{id}/edit', [CenterManagementDocumentController::class, 'edit'])->name('documents.edit'); // opcional
    Route::put('/{id}', [CenterManagementDocumentController::class, 'update'])->name('documents.update');
    Route::delete('/{id}', [CenterManagementDocumentController::class, 'destroy'])->name('documents.destroy');
});
Route::get('/documents/{id}/download', [CenterManagementDocumentController::class, 'download'])
    ->name('documents.download');

//Rutas contactos externos
Route::get('/externalContact', [ExternalContactController::class, 'index'])
    ->name('externalContact.indexExternalContacts');

Route::post('/externalContact', [ExternalContactController::class, 'store'])
    ->name('externalContact.store');


//Rutas servicios generales

Route::resource('serveisGenerals', ServeiGeneralController::class);

Route::get('/admin', [AdminController::class, 'index'])
    ->middleware('auth')
    ->name('admin.index');
Route::post('/admin/users', [AdminController::class, 'store'])
    ->middleware('auth')
    ->name('admin.store');
Route::delete('/admin/users/{user}', [AdminController::class, 'destroy'])
    ->middleware('auth')
    ->name('admin.destroy');


//Rutas servicios complementarios
Route::resource('complementaryService', ComplementaryServiceController::class);
Route::get('/complementary-service-documents/{document}/download',[ComplementaryServiceDocumentController::class, 'download'])->name('complementaryServiceDocument.download');


// Rutas de autenticación
require __DIR__.'/auth.php';
