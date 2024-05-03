<?php

namespace App\Http\Controllers;

use App\Models\Nurse;
use App\Models\Doctor;
use App\Models\Timing;
use App\Models\Patient;
use App\Models\Medicine;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Models\Medicalconsultation;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class DoctorController extends Controller
{
    public function doctor_index()
    {
        return view('doctor.doctor_index');
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
        $doctorId = Auth::id();
        $appointments = Appointment::where('doctor_id', $doctorId)->get();
        return view('doctor.appointments.allappointments', compact('appointments'));
    }

    public function viewPatientAppointment($id)
    {
        $appointments = Appointment::findOrFail($id);
        return view('doctor.appointments.viewpatientappointment', compact('appointments'));
    }

    public function testPatient($id)
    {
        $doctorId = Auth::id();
        $nurses = Nurse::all();
        $appointments = Appointment::findOrFail($id);
        $medicalConsultation = $appointments->medicalConsultation;

        return view('doctor.appointments.patient_test.TestPatient', [
            'doctorId' => $doctorId,
            'appointments' => $appointments,
            'medicalConsultation' => $medicalConsultation,
            'nurses' => $nurses,
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
            'other_assistant' => "required",
            'transfferofcare' => "required",
            'remarks' => "required",
            'timeout' => "required",
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
         //dd($request);
        $medicalConsultaion = Medicalconsultation::findOrFail($id);

        $validated = $request->validate([
            // 'doctor_id' => "required",
            // 'appointment_id' => "required",
            // 'patient_id' => "required",
            // 'nurse_id_1' => "nullable",
            // 'nurse_id_2' => "nullable",

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
            'other_assistant' => "required",
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
    }
    public function patient_medical_information($id)
    {
    }
}
