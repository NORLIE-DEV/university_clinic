<?php

namespace App\Http\Controllers;


use App\Models\Patient;
use Illuminate\Http\Request;
use App\Models\Medicalhistory;
use Illuminate\Support\Facades\Log;

class AdminPatientController extends Controller
{
    public function adminPatientIndex()
    {
        return view('admin.patient.patient_index');
    }

    //patient student
    public function student_patient()
    {
        $patients = Patient::all();
        return view('admin.patient.student.patient', compact('patients'));
    }

    public function patient_info($id)
    {
        $patientsInfo = Patient::findOrFail($id);
        return view('admin.patient.student.patient_info', ["patientsInfo" => $patientsInfo]);
    }

    // Medical History
    public function patient_medicalHistory($id)
    {
        $patientsInfo = Patient::findOrFail($id);
        $medicalHistory = $patientsInfo->medicalHistory;


        $hasMedicalHistory = $medicalHistory && $medicalHistory->isNotEmpty();

        return view('admin.patient.student.medical history.medicalHistory', [
            'patientsInfo' => $patientsInfo,
            'medicalHistory' => $medicalHistory,
            'hasMedicalHistory' => $hasMedicalHistory,
        ]);
    }

    public function add_medicalhistory(Request $request)
    {

        // Validate the incoming request
        $validated = $request->validate([
            'patient_id' => 'required',
            'father_first_name' => 'required',
            'father_middle_name' => 'required',
            'father_last_name' => 'required',
            'father_cp_number' => 'required',
            'father_email' => 'required|email',
            'mother_first_name' => 'required',
            'mother_middle_name' => 'required',
            'mother_last_name' => 'required',
            'mother_cp_number' => 'required',
            'mother_email' => 'required|email',
            'emergency_contact_name' => 'required',
            'emergency_contact_number' => 'required',
            'food_allergy' => 'nullable',
            'medicine_allergy' => 'nullable',
            'other_allergy' => 'nullable',
            'illness' => 'nullable',
            'other_illness' => 'nullable',
        ]);


        $medicalHistory = new Medicalhistory();
        $medicalHistory->fill($validated);
        $medicalHistory->illness = json_encode($validated['illness']);
        $medicalHistory->save();

        return response()->json(['message' => 'Medical history added successfully', 'data' => $medicalHistory], 200);
    }

    public function update_medicalhistory(Request $request, $id)
    {
        $medicalHistory = Medicalhistory::findOrFail($id);
        $validated = $request->validate([
            'food_allergy' => 'nullable',
            'medicine_allergy' => 'nullable',
            'other_allergy' => 'nullable',
            'illness' => 'nullable',
            'other_illness' => 'nullable',
        ]);
        $medicalHistory->fill($validated);

        if (array_key_exists('illness', $validated)) {

            $medicalHistory->illness = json_encode($validated['illness']);
        } else {

            $medicalHistory->illness = null;
        }
        $medicalHistory->save();

        return response()->json(['message' => 'Medical history updated successfully', 'data' => $medicalHistory], 200);
    }
}
