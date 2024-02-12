<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\SuperAdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

///////////////////////////// SUPERADMIN  ///////////////////////////////
Route::get('/superadmin',[SuperAdminController::class, 'superadmin_index']);
Route::get('/superadmin/student',[SuperAdminController::class, 'superadmin_student']);

Route::get('/superadmin/doctor',[SuperAdminController::class, 'superadmin_doctor']);
Route::get('/superadmin/doctor/createDoctor',[SuperAdminController::class, 'add_doctor']);
Route::post('/email_available/doctor', [SuperAdminController::class, 'checkEmail']);
Route::post('/store_doctor', [SuperAdminController::class, 'store']);
Route::get('/updatedoctor/{id}', [SuperAdminController::class, "updatedoctor"]);
Route::put('/doctor/{doctor}', [SuperAdminController::class, 'update']);




///////////////////////////// PATIENT //////////////////////////////////'
Route::get('/patient_index',[PatientController::class, 'patient_index']);


