<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\ExcelImportController;
use App\Http\Controllers\PatientLoginController;


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


// Patient Login
Route::get('/patient_login', [AuthController::class, 'patient_login']);

///////////////////////////// SUPERADMIN  ///////////////////////////////
Route::get('/superadmin', [SuperAdminController::class, 'superadmin_index']);

Route::get('/superadmin/student', [SuperAdminController::class, 'superadmin_student']);
Route::get('/superadmin/addstudent', [SuperAdminController::class, 'addStudent']);
Route::post('/studentID_available/student', [SuperAdminController::class, 'checkStudentID']);
Route::post('/email_available/student', [SuperAdminController::class, 'StudentcheckEmail']);
Route::post('/store_student', [SuperAdminController::class, 'store_student']);

Route::get('/superadmin/employee', [SuperAdminController::class, 'superadmin_employee']);

Route::get('/superadmin/patient', [SuperAdminController::class, 'superadmin_patient']);
Route::get('/superadmin/patient/student', [SuperAdminController::class, 'student_patient']);
Route::get('/superadmin/patient/employee', [SuperAdminController::class, 'employee_patient']);
Route::post('/superadmin/patient_import_data', [SuperAdminController::class, 'importData']);


Route::get('/superadmin/doctor', [SuperAdminController::class, 'superadmin_doctor']);
Route::get('/superadmin/doctor/createDoctor', [SuperAdminController::class, 'add_doctor']);
Route::post('/email_available/doctor', [SuperAdminController::class, 'checkEmail']);
Route::post('/store_doctor', [SuperAdminController::class, 'store']);
Route::get('/updatedoctor/{id}', [SuperAdminController::class, "updatedoctor"]);
Route::put('/doctor/{doctor}', [SuperAdminController::class, 'update']);
Route::delete('/delete/{model}/{id}', [SuperAdminController::class, 'destroy']);

Route::post('/import-excel/student', [ExcelImportController::class, 'import_student']);
Route::post('/import-excel/employee', [ExcelImportController::class, 'import_employee']);




///////////////////////////// PATIENT //////////////////////////////////'
Route::get('/patient_index', [PatientController::class, 'patient_index']);
