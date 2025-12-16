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
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EnrolledInController;
use App\Http\Controllers\CenterManagementDocumentController;
use App\Http\Controllers\ExternalContactController;
use App\Http\Controllers\ServeiGeneralController;

Route::get("/api/professionals",[ProfessionalController::class,'data']);


?>