<?php

namespace App\Http\Controllers;

use App\Models\Nurse;
use App\Models\Doctor;
use App\Models\Timing;
use App\Models\Patient;
use App\Models\Student;
use App\Models\Medicine;
use App\Models\Appointment;
use App\Models\Dentalconsultation;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Medicalconsultation;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DoctorController extends Controller
{
    public function doctor_index()
    {
        $doctorId = Auth::id();
        $doctor = Doctor::find($doctorId);
        $appointmentCount = $doctor->appointments()->count();
        $upcommingappointmentCount = $doctor->appointments()
            ->where('date', '>', now())
            ->count();
        return view('doctor.doctor_index', ["doctor" => $doctor, "appointmentCount" => $appointmentCount, "upcommingappointmentCount" => $upcommingappointmentCount]);
    }

    public function timing()
    {
        $doctorId = Auth::id();
        $timings = Timing::where('doctor_id', $doctorId)->get();
        return view('doctor.timings.timing', compact('timings'));
    }

    // view all appointments
    public function viewAllAppointments()
    {
        date_default_timezone_set('Asia/Manila');
        $doctorId = Auth::id();
        $appointments = Appointment::where('doctor_id', $doctorId)->whereDate('date', '=', now()->toDateString())->get();
        return view('doctor.appointments.allappointments', compact('appointments'));
    }

    public function upcommingAppointments()
    {
        date_default_timezone_set('Asia/Manila');
        $doctorId = Auth::id();
        $appointments = Appointment::where('doctor_id', $doctorId)->whereDate('date', '>', now()->toDateString())->get();
        return view('doctor.appointments.upcommingAppointments', compact('appointments'));
    }


    public function viewAllStudentPatients()
    {
        $patients = Patient::all();
        return view('doctor.patients.search_patient', compact('patients'));
    }

    public function viewCompletedAppointments()
    {
        date_default_timezone_set('Asia/Manila');
        $doctorId = Auth::id();
        $appointments = Appointment::where('doctor_id', $doctorId)
            ->where('appointment_status', 'completed')
            ->get();
        return view('doctor.appointments.completed_appointments', [
            'appointments' => $appointments,
        ]);
    }

    public function viewHistoryAppointments()
    {
        date_default_timezone_set('Asia/Manila');
        $doctorId = Auth::id();
        $historyAppointments = Appointment::where('doctor_id', $doctorId)
            ->whereDate('date', '<', now()->toDateString())
            ->get();
        return view('doctor.appointments.history_appointment', [
            'history_appointments' => $historyAppointments,
        ]);
    }

    public function viewPatientAppointment($id)
    {
        $appointments = Appointment::findOrFail($id);
        return view('doctor.appointments.viewpatientappointment', compact('appointments'));
    }

    public function update_appointment_status(Request $request, $id)
    {
        date_default_timezone_set('Asia/Manila');
        try {
            $appointment = Appointment::findOrFail($id);
            $validated = $request->validate([
                'appointment_status' => ['required', Rule::in(['booked', 'completed', 'cancelled', 'patient not available'])],
                'notes' => 'nullable|string|max:255',
            ]);

            $appointment->fill($validated);
            $appointment->save();
            return redirect()->back()->with('success', 'status updated successfully');
        } catch (\Exception $e) {

            Log::error('Failed to update appointment status: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to update appointment status'], 500);
        }
    }

    public function testPatient($id)
    {
        $doctorId = Auth::id();
        $doctor = Doctor::find(Auth::id());
        $nurses = Nurse::all();
        $appointments = Appointment::findOrFail($id);
        $medicalConsultation = $appointments->medicalConsultation;
        $dentalConsultation = $appointments->dentalConsultation;

        return view('doctor.appointments.patient_test.TestPatient', [
            'doctorId' => $doctorId,
            'appointments' => $appointments,
            'medicalConsultation' => $medicalConsultation,
            'dentalConsultation' => $dentalConsultation,
            'nurses' => $nurses,
            'doctor' => $doctor,
        ]);
    }


    public function getMedicine()
    {
        $medicines = Medicine::select('id', 'name')->get();
        return response()->json(['medicines' => $medicines]);
    }
    public function getNurse()
    {
        $nurses = Nurse::select('id', 'name')->get();
        return response()->json(['nurses' => $nurses]);
    }


    // store consilation

    public function store_medical_consultation(Request $request)
    {
        date_default_timezone_set('Asia/Manila');
        // dd($request);
        $validated = $request->validate([
            'doctor_id' => "required",
            'appointment_id' => "required",
            'patient_id' => "required",
            'nurse_id_1' => "nullable",
            'nurse_id_2' => "nullable",

            'pulse_rate' => "required",
            'respiratory_rate' => "required",
            'blood_pressure' => "required",
            'body_temp' => "required",
            'height' => "required",
            'weight' => "required",

            // JSON fields made nullable
            'chief_complaints' => "nullable",
            'medicine_issuance' => "nullable",
            'medicine_prescription' => "nullable",
            'clinical_diagnosis' => "nullable",
            'treatment_given' => "nullable",
            'injuries' => "nullable",

            'vsud_pulse_rate' => "nullable",
            'vsud_respiratory_rate' => "nullable",
            'vsud_blood_pressure' => "nullable",
            'vsud_body_temp' => "nullable",
            'vsud_conditional_findings' => "nullable",

            'assistedBy' => "required",
            'other_assistant' => "nullable",
            'transfferofcare' => "required",
            'remarks' => "required",
            'timeout' => "required",
            'consultation_method' => "required",
        ]);
        $medicalConsultaion = new Medicalconsultation();
        $medicalConsultaion->fill($validated);

        // Check if the JSON fields exist in the $validated array
        $medicalConsultaion->chief_complaints = isset($validated['chief_complaints']) ? json_encode($validated['chief_complaints']) : null;
        $medicalConsultaion->medicine_issuance = isset($validated['medicine_issuance']) ? json_encode($validated['medicine_issuance']) : null;
        $medicalConsultaion->medicine_prescription = isset($validated['medicine_prescription']) ? json_encode($validated['medicine_prescription']) : null;
        $medicalConsultaion->clinical_diagnosis = isset($validated['clinical_diagnosis']) ? json_encode($validated['clinical_diagnosis']) : null;
        $medicalConsultaion->treatment_given = isset($validated['treatment_given']) ? json_encode($validated['treatment_given']) : null;
        $medicalConsultaion->injuries = isset($validated['injuries']) ? json_encode($validated['injuries']) : null;

        $medicalConsultaion->save();
    }

    public function update_medical_consultation(Request $request, $id)
    {
        date_default_timezone_set('Asia/Manila');
        //dd($request);
        $medicalConsultaion = Medicalconsultation::findOrFail($id);

        $validated = $request->validate([
            // 'doctor_id' => "required",
            // 'appointment_id' => "required",
            // 'patient_id' => "required",
            'nurse_id_1' => "nullable",
            'nurse_id_2' => "nullable",

            'pulse_rate' => "required",
            'respiratory_rate' => "required",
            'blood_pressure' => "required",
            'body_temp' => "required",
            'height' => "required",
            'weight' => "required",

            // JSON fields made nullable
            'chief_complaints' => "nullable",
            'medicine_issuance' => "nullable",
            'medicine_prescription' => "nullable",
            'clinical_diagnosis' => "nullable",
            'treatment_given' => "nullable",
            'injuries' => "nullable",

            'vsud_pulse_rate' => "nullable",
            'vsud_respiratory_rate' => "nullable",
            'vsud_blood_pressure' => "nullable",
            'vsud_body_temp' => "nullable",
            'vsud_conditional_findings' => "nullable",

            'assistedBy' => "required",
            'other_assistant' => "nullable",
            'transfferofcare' => "required",
            'remarks' => "required",
            'timeout' => "required",
        ]);
        $medicalConsultaion->fill($validated);

        // Check if the JSON fields exist in the $validated array and are not empty
        $medicalConsultaion->chief_complaints = isset($validated['chief_complaints']) && !empty($validated['chief_complaints']) ? json_encode($validated['chief_complaints']) : null;
        $medicalConsultaion->medicine_issuance = isset($validated['medicine_issuance']) && !empty($validated['medicine_issuance']) ? json_encode($validated['medicine_issuance']) : null;
        $medicalConsultaion->medicine_prescription = isset($validated['medicine_prescription']) && !empty($validated['medicine_prescription']) ? json_encode($validated['medicine_prescription']) : null;
        $medicalConsultaion->clinical_diagnosis = isset($validated['clinical_diagnosis']) && !empty($validated['clinical_diagnosis']) ? json_encode($validated['clinical_diagnosis']) : null;
        $medicalConsultaion->treatment_given = isset($validated['treatment_given']) && !empty($validated['treatment_given']) ? json_encode($validated['treatment_given']) : null;
        $medicalConsultaion->injuries = isset($validated['injuries']) && !empty($validated['injuries']) ? json_encode($validated['injuries']) : null;

        $medicalConsultaion->save();
        return response()->json(['success' => 'update saved successfully'], 200);
    }


    public function searchStudentPatient(Request $request)
    {
        $studentPatient = Patient::where('student_id', $request->input('patient_key'))
            ->orWhere('employee_id', $request->input('patient_key'))
            ->first();

        $doctor = Doctor::find(Auth::id());

        if ($studentPatient) {
            $medicalInfo = $studentPatient->medicalInfo;
            $medicalconsultationInfo = $studentPatient->medicalconsultationInfo;
            $dentalconsultationInfo = $studentPatient->dentalconsultationInfo;
            $sickleavemedicalcertificate = $studentPatient->sickleavemedicalcertificate;
            $activitiescalcertificate = $studentPatient->activitiescalcertificate;

            return view('doctor.patients.search_result', ["studentPatient" => $studentPatient, "medicalInfo" => $medicalInfo, "medicalconsultationInfo" => $medicalconsultationInfo, "dentalconsultationInfo" => $dentalconsultationInfo, "doctor" => $doctor, "sickleavemedicalcertificate" => $sickleavemedicalcertificate, "activitiescalcertificate" => $activitiescalcertificate]);
        } else {
            $errorMessage = "Patient not found.";
            return view('doctor.patients.search_patient')->with('errorMessage', $errorMessage);
        }
    }


    // walkin test consulation
    public function patientWalkinTest($id)
    {
        $doctor = Doctor::find(Auth::id());
        $doctorId = Auth::id();
        $patientWalkin = Patient::findOrFail($id);
        return view('doctor.appointments.patient_test.TestPatientWalkIn', ["doctorId" => $doctorId, "patientWalkin" => $patientWalkin, "doctor" => $doctor]);
    }
    public function store_medical_consultation_walkin(Request $request)
    {
        date_default_timezone_set('Asia/Manila');
        $validated = $request->validate([
            'doctor_id' => "required",
            'patient_id' => "required",
            'nurse_id_1' => "nullable",
            'nurse_id_2' => "nullable",

            'pulse_rate' => "required",
            'respiratory_rate' => "required",
            'blood_pressure' => "required",
            'body_temp' => "required",
            'height' => "required",
            'weight' => "required",

            // JSON fields made nullable
            'chief_complaints' => "nullable",
            'medicine_issuance' => "nullable",
            'medicine_prescription' => "nullable",
            'clinical_diagnosis' => "nullable",
            'treatment_given' => "nullable",
            'injuries' => "nullable",

            'vsud_pulse_rate' => "nullable",
            'vsud_respiratory_rate' => "nullable",
            'vsud_blood_pressure' => "nullable",
            'vsud_body_temp' => "nullable",
            'vsud_conditional_findings' => "nullable",

            'assistedBy' => "required",
            'other_assistant' => "nullable",
            'transfferofcare' => "required",
            'remarks' => "required",
            'timeout' => "required",
            'consultation_method' => "required",
        ]);
        $medicalConsultaion = new Medicalconsultation();
        $medicalConsultaion->fill($validated);

        // Check if the JSON fields exist in the $validated array
        $medicalConsultaion->chief_complaints = isset($validated['chief_complaints']) ? json_encode($validated['chief_complaints']) : null;
        $medicalConsultaion->medicine_issuance = isset($validated['medicine_issuance']) ? json_encode($validated['medicine_issuance']) : null;
        $medicalConsultaion->medicine_prescription = isset($validated['medicine_prescription']) ? json_encode($validated['medicine_prescription']) : null;
        $medicalConsultaion->clinical_diagnosis = isset($validated['clinical_diagnosis']) ? json_encode($validated['clinical_diagnosis']) : null;
        $medicalConsultaion->treatment_given = isset($validated['treatment_given']) ? json_encode($validated['treatment_given']) : null;
        $medicalConsultaion->injuries = isset($validated['injuries']) ? json_encode($validated['injuries']) : null;

        $medicalConsultaion->save();
    }

    public function UpdatepatientWalkinTest(Request $request, $id)
    {
        $nurses = Nurse::all();
        $consultationWalkin = Medicalconsultation::findOrFail($id);
        return view('doctor.patients.updateConsultationWalkin', ["consultationWalkin" => $consultationWalkin, "nurses" => $nurses]);
    }



    //dental
    public function store_dental_consultation(Request $request)
    {
        date_default_timezone_set('Asia/Manila');
        // dd($request);
        $validated = $request->validate([
            'doctor_id' => "required",
            'appointment_id' => "required",
            'patient_id' => "required",
            'nurse_id_1' => "nullable",
            'nurse_id_2' => "nullable",


            'medicine_issuance' => "nullable",
            'medicine_prescription' => "nullable",

            'services_rendered' => "nullable",
            'oral_health_condition' => "nullable",

            'other_assistant' => "nullable",
            'follow_up' => "nullable",
            'remarks' => "required",
            'consultation_method' => "required",
        ]);
        $dentalConsultaion = new Dentalconsultation();
        $dentalConsultaion->fill($validated);
        $dentalConsultaion->services_rendered = json_encode($validated['services_rendered']);
        $dentalConsultaion->oral_health_condition = json_encode($validated['oral_health_condition']);
        // Check if the JSON fields exist in the $validated array
        $dentalConsultaion->medicine_issuance = isset($validated['medicine_issuance']) ? json_encode($validated['medicine_issuance']) : null;
        $dentalConsultaion->medicine_prescription = isset($validated['medicine_prescription']) ? json_encode($validated['medicine_prescription']) : null;
        $dentalConsultaion->save();
    }

    public function update_dental_consultation(Request $request, $id)
    {

        $dentalConsultaion = Dentalconsultation::findOrFail($id);
        date_default_timezone_set('Asia/Manila');
        // dd($request);
        $validated = $request->validate([
            'nurse_id_1' => "nullable",
            'nurse_id_2' => "nullable",
            'doctor_id' => "required",
            'appointment_id' => "required",
            'patient_id' => "required",

            'medicine_issuance' => "nullable",
            'medicine_prescription' => "nullable",

            'services_rendered' => "nullable",
            'oral_health_condition' => "nullable",

            'other_assistant' => "nullable",
            'follow_up' => "nullable",
            'remarks' => "required",
            'consultation_method' => "required",
        ]);
        $dentalConsultaion->fill($validated);

        $dentalConsultaion->oral_health_condition = isset($validated['oral_health_condition']) ? json_encode($validated['oral_health_condition']) : null;
        $dentalConsultaion->medicine_prescription = isset($validated['medicine_prescription']) ? json_encode($validated['medicine_prescription']) : null;
        // Check if the JSON fields exist in the $validated array
        $dentalConsultaion->medicine_issuance = isset($validated['medicine_issuance']) ? json_encode($validated['medicine_issuance']) : null;
        $dentalConsultaion->medicine_prescription = isset($validated['medicine_prescription']) ? json_encode($validated['medicine_prescription']) : null;
        $dentalConsultaion->save();

        return response()->json(['success' => 'update saved successfully'], 200);
    }


    public function patientWalkinTestDental($id)
    {
        $doctor = Doctor::find(Auth::id());
        $doctorId = Auth::id();
        $patientWalkin = Patient::findOrFail($id);
        return view('doctor.appointments.patient_test.dentalTestWalkin', ["doctorId" => $doctorId, "patientWalkin" => $patientWalkin, "doctor" => $doctor]);
    }

    public function store_dental_consultation_walkin(Request $request)
    {
        date_default_timezone_set('Asia/Manila');
        // dd($request);
        $validated = $request->validate([
            'doctor_id' => "required",
            'patient_id' => "required",
            'nurse_id_1' => "nullable",
            'nurse_id_2' => "nullable",


            'medicine_issuance' => "nullable",
            'medicine_prescription' => "nullable",

            'services_rendered' => "nullable",
            'oral_health_condition' => "nullable",

            'other_assistant' => "nullable",
            'follow_up' => "nullable",
            'remarks' => "required",
            'consultation_method' => "required",
        ]);
        $dentalConsultaion = new Dentalconsultation();
        $dentalConsultaion->fill($validated);
        $dentalConsultaion->services_rendered = isset($validated['services_rendered']) ? json_encode($validated['services_rendered']) : null;
        $dentalConsultaion->oral_health_condition = isset($validated['oral_health_condition']) ? json_encode($validated['oral_health_condition']) : null;
        // Check if the JSON fields exist in the $validated array
        $dentalConsultaion->medicine_issuance = isset($validated['medicine_issuance']) ? json_encode($validated['medicine_issuance']) : null;
        $dentalConsultaion->medicine_prescription = isset($validated['medicine_prescription']) ? json_encode($validated['medicine_prescription']) : null;
        $dentalConsultaion->save();
    }

    public function UpdatepatientWalkinTestDental(Request $request, $id)
    {
        $doctor = Doctor::find(Auth::id());
        $doctorId = Auth::id();
        $nurses = Nurse::all();
        $dentalConsultation = Dentalconsultation::findOrFail($id);
        return view('doctor.patients.updateDentalConsultationWalkin', ["dentalConsultation" => $dentalConsultation, "nurses" => $nurses, "doctor" => $doctor, "doctorId" => $doctorId]);
    }

    public function update_dental_consultation_walkin(Request $request, $id)
    {

        $dentalConsultaion = Dentalconsultation::findOrFail($id);
        date_default_timezone_set('Asia/Manila');
        // dd($request);
        $validated = $request->validate([
            'nurse_id_1' => "nullable",
            'nurse_id_2' => "nullable",
            'doctor_id' => "required",
            'medicine_issuance' => "nullable",
            'medicine_prescription' => "nullable",

            'services_rendered' => "nullable",
            'oral_health_condition' => "nullable",

            'other_assistant' => "nullable",
            'follow_up' => "nullable",
            'remarks' => "required",
            'consultation_method' => "required",
        ]);
        $dentalConsultaion->fill($validated);

        $dentalConsultaion->oral_health_condition = isset($validated['oral_health_condition']) ? json_encode($validated['oral_health_condition']) : null;
        $dentalConsultaion->medicine_prescription = isset($validated['medicine_prescription']) ? json_encode($validated['medicine_prescription']) : null;
        // Check if the JSON fields exist in the $validated array
        $dentalConsultaion->medicine_issuance = isset($validated['medicine_issuance']) ? json_encode($validated['medicine_issuance']) : null;
        $dentalConsultaion->medicine_prescription = isset($validated['medicine_prescription']) ? json_encode($validated['medicine_prescription']) : null;
        $dentalConsultaion->save();

        return response()->json(['success' => 'update saved successfully'], 200);
    }
}
