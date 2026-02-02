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
Route::resource('maintenance', MaintenanceController::class)->middleware('role:Equip Directiu,Administracio');
Route::post('/changeStateM', [MaintenanceController::class, 'changeStateM'])->middleware('role:Equip Directiu,Administracio')->name('changeStateM.maintenance');
Route::post('/createMaintenanceTracking', [MaintenanceController::class, 'createMaintenanceTracking'])->middleware('role:Equip Directiu,Administracio')->name('createMaintenanceTracking.maintenance');

Route::get('/maintenance/{document}/download',[MaintenanceDocumentController::class, 'download'])->middleware('role:Equip Directiu,Administracio')->name('maintenanceDocument.download');
Route::get('/maintenanceDelete/{id}', [MaintenanceController::class, 'maintenanceDelete'])->middleware('role:Equip Directiu,Administracio')->name('maintenance.delete');

Route::post('/searchMaintenances', [MaintenanceController::class, 'searchMaintenances'])->middleware('role:Equip Directiu,Administracio')->name('searchMaintenances.maintenance');

//--------------------------------------------------Accidentability--------------------------------------------------------------
Route::resource('accidentability', AccidentabilityController::class)->middleware('role:Equip Directiu,Administracio,Responsable i Equip Tecnic');
Route::post('/changeStateBaixa', [AccidentabilityController::class, 'changeStateBaixa'])->name('changeStateBaixa.maintenance')->middleware('role:Equip Directiu,Administracio,Responsable i Equip Tecnic');

Route::get('/downloadAccident/{accident}', [AccidentabilityController::class, 'downloadAccident'])
    ->middleware('role:Equip Directiu,Administracio,Responsable i Equip Tecnic')
    ->name('accidentability.downloadAccident');

Route::get('/indexPerProfessional/professional/{professional}', [AccidentabilityController::class, 'indexPerProfessional'])->name('accidentability.indexPerProfessional')->middleware('role:Equip Directiu,Administracio,Responsable i Equip Tecnic');
Route::get('/accidentDelete/{id}/{professional}', [AccidentabilityController::class, 'accidentDelete'])->name('accident.delete')->middleware('role:Equip Directiu,Administracio,Responsable i Equip Tecnic');

Route::post('/searchMaintenances/{professional}', [AccidentabilityController::class, 'searchAccidents'])->name('searchAccidents.accidents')->middleware('role:Equip Directiu,Administracio,Responsable i Equip Tecnic');

//--------------------------------------------------RRHH--------------------------------------------------------------
Route::resource('rrhh', RrhhController::class)->middleware('role:Equip Directiu');
Route::post('/changeStateRrhh', [RrhhController::class, 'changeStateRrhh'])->name('changeStateRrhh.rrhh')->middleware('role:Equip Directiu');
Route::post('/createRrhhTracking', [RrhhController::class, 'createRrhhTracking'])->name('createRrhhTracking.rrhh')->middleware('role:Equip Directiu');

Route::get('/rrhh/{document}/download',[RrhhDocumentController::class, 'download'])->name('rrhhDocument.download')->middleware('role:Equip Directiu');

Route::get('/rrhhDelete/{id}', [RrhhController::class, 'rrhhDelete'])->name('rrhh.delete')->middleware('role:Equip Directiu');

Route::post('/searchRrhh', [RrhhController::class, 'searchRrhh'])->name('searchRrh.rrhh')->middleware('role:Equip Directiu');


//--------------------------------------------------Uniformes------------------------------------------------------------------------

// Rutas de exportación de Uniforms (antes del resource para evitar conflictos)
Route::resource('uniforms', UniformController::class)->middleware('role:Equip Directiu,Administracio,Responsable i Equip Tecnic');

Route::prefix('uniforms')->group(function () {
    Route::get('export', [UniformController::class, 'export'])->middleware('role:Equip Directiu,Administracio,Responsable i Equip Tecnic')->name('uniforms.export');
    Route::get('export-test', [UniformController::class, 'exportTest'])->middleware('role:Equip Directiu,Administracio,Responsable i Equip Tecnic');
});

Route::put('/uniforms/{uniform}/confirm', [UniformController::class, 'changeState'])
    ->middleware('role:Equip Directiu,Administracio,Responsable i Equip Tecnic')
    ->name('uniforms.changeState');


//--------------------------------------------------Cursos------------------------------------------------------------------------

Route::get('/exportar-inscritos', [EnrolledInController::class, 'export'])->middleware('role:Equip Directiu,Administracio,Responsable i Equip Tecnic')->name('inscritos.export');

Route::post('/enrolled-in', [EnrolledInController::class, 'store'])->middleware('role:Equip Directiu,Administracio,Responsable i Equip Tecnic');
Route::resource('enrolled-in', EnrolledInController::class)->middleware('role:Equip Directiu,Administracio,Responsable i Equip Tecnic');



Route::post('/course', [CourseController::class, 'store'])->middleware('role:Equip Directiu,Administracio,Responsable i Equip Tecnic');


Route::resource('course', CourseController::class )->middleware('role:Equip Directiu,Administracio,Responsable i Equip Tecnic');

Route::resource('center', CenterController::class)->middleware('role:Equip Directiu,Administracio,Responsable i Equip Tecnic');

//--------------------------------------------------Projectes i Comisions------------------------------------------------------------------------

Route::resource('projects_comisions', ProjectComisionController::class)->middleware('role:Equip Directiu,Administracio,Responsable i Equip Tecnic');

Route::post('/storeProj', [ProjectComissionAssignedController::class, 'store'])->middleware('role:Equip Directiu,Administracio,Responsable i Equip Tecnic');
Route::resource('project_comision_assignment', ProjectComissionAssignedController::class)->middleware('role:Equip Directiu,Administracio,Responsable i Equip Tecnic');

Route::get('/exportar-assignats', [ProjectComissionAssignedController::class, 'exportAssigned'])->name('assigned.export')->middleware('role:Equip Directiu,Administracio,Responsable i Equip Tecnic');

Route::get('/removeAssignation/{idPC}/{idProf}', [ProjectComissionAssignedController::class, 'removeAssignation'])->middleware('role:Equip Directiu,Administracio,Responsable i Equip Tecnic')->name('removeAssignation.projectComissionAssignment');

Route::get('/projectComisionDelete/{id}', [ProjectComisionController::class, 'projectComisionDelete'])->middleware('role:Equip Directiu,Administracio,Responsable i Equip Tecnic')->name('projectComision.delete');


//--------------------------------------------------Professionals------------------------------------------------------------------------


Route::resource('professional', ProfessionalController::class)->middleware('role:Equip Directiu,Administracio,Responsable i Equip Tecnic');

//Seguiment
Route::get('/trackingViewProfessional/{professional}', [ProfessionalController::class, 'trackingViewProfessional'])->middleware('role:Equip Directiu,Administracio,Responsable i Equip Tecnic')->name('trackingViewProfessional.professional');

Route::get('/trackingView/{professional}', [ProfessionalController::class, 'trackingView'])->middleware('role:Equip Directiu,Administracio,Responsable i Equip Tecnic')->name('trackingView.professional');
Route::post('/track/{professional}', [ProfessionalController::class, 'track'])->middleware('role:Equip Directiu,Administracio,Responsable i Equip Tecnic')->name('track.professional');


//Avaluacio
Route::get('/assessViewProfessional/{professional}', [ProfessionalController::class, 'assessViewProfessional'])->middleware('role:Equip Directiu,Administracio,Responsable i Equip Tecnic')->name('assessViewProfessional.professional');
Route::get('/assessView/{professional}', [ProfessionalController::class, 'assessView'])->middleware('role:Equip Directiu,Administracio,Responsable i Equip Tecnic')->name('assessView.professional');
Route::put('/assess/{professional}',[ProfessionalController::class,'assess'])->middleware('role:Equip Directiu,Administracio,Responsable i Equip Tecnic')->name('assess.professional');

//Route::get('/getAssessment',[ProfessionalController::class,'getAssessment'])->name('getAssessment.professional');
Route::post('/getAssessment', [ProfessionalController::class, 'getAssessment'])->middleware('role:Equip Directiu,Administracio,Responsable i Equip Tecnic')->name('getAssessment.professional');

//Buscar Professionals Javascript
//Get no serveix de res?
Route::get('/search', function () {return view('index.professional');})->middleware('role:Equip Directiu,Administracio,Responsable i Equip Tecnic');
Route::post('/search', [ProfessionalController::class, 'search'])->middleware('role:Equip Directiu,Administracio,Responsable i Equip Tecnic');


Route::resource('cv', CvController::class)->middleware('role:Equip Directiu,Administracio,Responsable i Equip Tecnic');

// Rutas para cambiar estado
Route::put('/changeStateP/{professional}', [ProfessionalController::class, 'changeStateP'])
    ->middleware('role:Equip Directiu,Administracio,Responsable i Equip Tecnic')
    ->name('changeStateProfessional');


//--------------------------------------------------Centres------------------------------------------------------------------------

Route::put('/changeStateC/{center}', [CenterController::class, 'changeStateC'])
    ->middleware('role:Equip Directiu,Administracio,Responsable i Equip Tecnic')
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



Route::post('/documents', [CenterManagementDocumentController::class, 'store'])->name('documents.store');

// Rutas para los documentos
Route::prefix('documents')->group(function () {
    Route::get('/', [CenterManagementDocumentController::class, 'index'])->middleware('role:Equip Directiu')->name('documents.index');
    Route::get('/{id}', [CenterManagementDocumentController::class, 'show'])->middleware('role:Equip Directiu')->name('documents.show');
    Route::get('/create', [CenterManagementDocumentController::class, 'create'])->middleware('role:Equip Directiu')->name('documents.create'); // opcional si haces formulario
    Route::post('/', [CenterManagementDocumentController::class, 'store'])->middleware('role:Equip Directiu')->name('documents.store');
    Route::get('/{id}/edit', [CenterManagementDocumentController::class, 'edit'])->middleware('role:Equip Directiu')->name('documents.edit'); // opcional
    Route::put('/{id}', [CenterManagementDocumentController::class, 'update'])->middleware('role:Equip Directiu')->name('documents.update');
    Route::delete('/{id}', [CenterManagementDocumentController::class, 'destroy'])->middleware('role:Equip Directiu')->name('documents.destroy');
});
Route::get('/documents/{id}/download', [CenterManagementDocumentController::class, 'download'])
    ->name('documents.download');

//Rutas contactos externos
Route::get('/externalContact', [ExternalContactController::class, 'index'])
    ->middleware('role:Equip Directiu,Administracio,Responsable i Equip Tecnic')
    ->name('externalContact.indexExternalContacts');

Route::post('/externalContact', [ExternalContactController::class, 'store'])
    ->middleware('role:Equip Directiu,Administracio,Responsable i Equip Tecnic')
    ->name('externalContact.store');


//Rutas servicios generales

Route::resource('serveisGenerals', ServeiGeneralController::class)->middleware('role:Equip Directiu,Administracio');

Route::get('/admin', [AdminController::class, 'index'])
    ->middleware('role:Equip Directiu,Administracio')
    ->name('admin.index');
Route::post('/admin/users', [AdminController::class, 'store'])
    ->middleware('role:Equip Directiu,Administracio')
    ->name('admin.store');
Route::delete('/admin/users/{user}', [AdminController::class, 'destroy'])
    ->middleware('role:Equip Directiu,Administracio')
    ->name('admin.destroy');


//---------------------------------------------------------------------------------------------Rutas servicios complementarios
Route::resource('complementaryService', ComplementaryServiceController::class)->middleware('role:Equip Directiu,Administracio,Responsable i Equip Tecnic');
Route::get('/complementary-service-documents/{document}/download',[ComplementaryServiceDocumentController::class, 'download'])->middleware('role:Equip Directiu,Administracio,Responsable i Equip Tecnic')->name('complementaryServiceDocument.download');

Route::post('/searchComplementaryService', [ComplementaryServiceController::class, 'searchComplementaryService'])->middleware('role:Equip Directiu,Administracio,Responsable i Equip Tecnic')->name('search.complementaryService');


// Rutas de autenticación
require __DIR__.'/auth.php';
