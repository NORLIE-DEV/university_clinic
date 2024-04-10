<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\NurseAdminController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\ExcelImportController;
use App\Http\Controllers\AdminPatientController;
use App\Http\Controllers\PatientLoginController;
use App\Http\Controllers\MedicineStockController;
use App\Http\Controllers\MedicalConsultaionController;
use App\Http\Controllers\TimingController;

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

Route::get('/patient_login', [AuthController::class, 'patient_login'])->name('login');
Route::post('/login/process', [AuthController::class, 'login']);



///////////////////////////// SUPERADMIN  ///////////////////////////////
Route::get('/superadmin', [SuperAdminController::class, 'superadmin_index']);

Route::get('/superadmin/student', [SuperAdminController::class, 'superadmin_student']);
Route::get('/superadmin/addstudent', [SuperAdminController::class, 'addStudent']);
Route::post('/studentID_available/student', [SuperAdminController::class, 'checkStudentID']);
Route::post('/email_available/student', [SuperAdminController::class, 'StudentcheckEmail']);
Route::post('/store_student', [SuperAdminController::class, 'store_student']);
Route::get('/update_student/{id}', [SuperAdminController::class, "edit_student"]);
Route::put('/student/{student}', [SuperAdminController::class, 'update_student']);

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




Route::middleware(['auth:patient'])->group(function () {
    Route::get('/patient_index', [PatientController::class, 'patient_index'])->name('patient.index');

    // department
    Route::get('/patient/department', [PatientController::class, 'department']);
    Route::get('/patient/department/dental', [PatientController::class, 'dental']);
    Route::get('/patient/department/medical', [PatientController::class, 'medical']);

    // booked
    Route::get('/patient/finddoctor', [PatientController::class, 'finddoctor']);
    Route::get('/patient/booked/{id}', [PatientController::class, 'bookedAppointment'])->name('patient.booked');
    Route::post('/check-availability', [PatientController::class, "checkAvailability"]);
    Route::post('/make-appointment', [PatientController::class, "makeAppointment"])->name('make.appointment');

    Route::post('/student_logout', [AuthController::class, "studentLogout"]);
});




///////////////////////////// NURSE ///////////////////////////////////
Route::get('/admin_index', [NurseAdminController::class, 'admin_index']);
Route::get('/admin_inventory_index', [NurseAdminController::class, 'index_inventory']);


Route::get('/admin/supplier', [SupplierController::class, 'supplier'])->name('admin.supplier');
Route::get('/admin/add_supplier', [SupplierController::class, 'add_supplier']);
Route::post('/store_supplier', [SupplierController::class, 'store_supplier']);
Route::get('/updatesupplier/{id}', [SupplierController::class, "edit_supplier"]);
Route::put('/supplier/{supplier}', [SupplierController::class, 'update_supplier']);

Route::get('/admin/medicine_inventory', [MedicineController::class, 'medicine_index'])->name('admin.medicine');
Route::get('/admin/add_medicine', [MedicineController::class, 'add_medicine']);
Route::get('/getsupplier', [MedicineController::class, 'getSuppliers'])->name('getsupplier.page');
Route::post('/store_medicine', [MedicineController::class, 'store_medicine']);
Route::get('/updatemedicine/{id}', [MedicineController::class, "edit_medicine"]);
Route::put('/medicine/{medicine}', [MedicineController::class, 'update_medicines']);

Route::get('/admin/medicine_stocks', [MedicineStockController::class, 'medicine_stock_index'])->name('admin.medicine_stock');
Route::get('/admin/add_medicine_stocks', [MedicineStockController::class, 'add_medicine_stock']);
Route::get('/getmedicine', [MedicineStockController::class, 'getMedicine'])->name('getMedicine');
Route::post('/store_medicine_stock', [MedicineStockController::class, 'store_medicineStocks']);
Route::get('/updatemedicineStocks/{id}', [MedicineStockController::class, "edit_medicineStock"]);
Route::put('/medicineStocks/{medicineStocks}', [MedicineStockController::class, 'update_medicineStocks']);

Route::get('/admin_patient_index', [AdminPatientController::class, 'adminPatientIndex']);
Route::get('/admin/patient/student', [AdminPatientController::class, 'student_patient']);
Route::get('/admin_patient_info/{id}', [AdminPatientController::class, "patient_info"]);
// Route::get('/admin_patient_medicalHistory_info/{id}', [AdminPatientController::class, "patient_medicalHistory"]);
Route::get('/admin_patient_medicalInformation/{id}', [AdminPatientController::class, "patient_medicaInformation"]);

Route::post('/add_medicalinformation', [AdminPatientController::class, 'add_medicalinfo']);
Route::put('/medicalinfo/{medicalinfo}', [AdminPatientController::class, 'update_medicalInfo']);

// medical consultaion
Route::get('/admin_medical_consultation/{id}', [MedicalConsultaionController::class, 'medical_consultation']);
//



Route::middleware(['auth:doctor'])->group(function () {
    // DOCTOR
    Route::get('/doctor_index', [DoctorController::class, 'doctor_index'])->name('doctor.index');
    Route::post('/doctor_logout', [AuthController::class, "doctorLogout"]);

    // TIming
    Route::get('/doctor_timing', [DoctorController::class, 'timing']);
    Route::post('/create_timing', [TimingController::class, 'storeDoctorTiming']);
});
