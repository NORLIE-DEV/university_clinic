<?php

namespace App\Http\Controllers;


use App\Models\Patient;
use Illuminate\Http\Request;
use App\Models\Medicalhistory;
use App\Models\Medicalinformation;
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


    public function patient_medicaInformation($id)
    {
        $patientsInfo = Patient::findOrFail($id);
        $medicalInfo = $patientsInfo->medicalInfo;


        $hasMedicalInfo = $medicalInfo && $medicalInfo->isNotEmpty();

        return view('admin.patient.student.medical history.medicalIformation', [
            'patientsInfo' => $patientsInfo,
            'medicalInfo' => $medicalInfo,
            'hasMedicalInfo' => $hasMedicalInfo,
        ]);
    }

    public function add_medicalinfo(Request $request)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'patient_id' => 'required',
            'illness' => 'nullable',
            'other_illness' => 'nullable',
            'food_allergy' => 'nullable',
            'medicine_allergy' => 'nullable',
            'insect_bite_allergy' => 'nullable',
            'other_allergy' => 'nullable',
            'vission_of_righteye' => 'nullable',
            'vission_of_lefteye' => 'nullable',
            'blood_pressure' => 'required',
            'pulse_rate' => 'required',
            'blood_pressure_category' => 'nullable',
            'body_temperature' => 'required',
            'height' => 'nullable',
            'weight' => 'nullable',
            'bodymassindex' => 'nullable',
            'bodymassindex_category' => 'nullable',
            'injurie_status' => 'nullable',
            'dateofinjurie' => 'nullable',
            'name_of_hospital' => 'nullable',
            'immunization' => 'nullable',
            'other_immunization' => 'nullable',
            'familyhistory' => 'nullable',
            'other_familyhistory' => 'nullable',
        ]);

        $medicalHistory = new Medicalinformation();
        $medicalHistory->fill($validated);
        $medicalHistory->illness = json_encode($validated['illness']);
        $medicalHistory->immunization = json_encode($validated['immunization']);
        $medicalHistory->familyhistory = json_encode($validated['familyhistory']);
        $medicalHistory->save();

        return response()->json(['message' => 'Medical history added successfully', 'data' => $medicalHistory], 200);
    }


    public function update_medicalInfo(Request $request, $id)
    {
        $medicalInfo = Medicalinformation::findOrFail($id);
        $validated = $request->validate([
            'patient_id' => 'required',
            'illness' => 'nullable',
            'other_illness' => 'nullable',
            'food_allergy' => 'nullable',
            'medicine_allergy' => 'nullable',
            'insect_bite_allergy' => 'nullable',
            'other_allergy' => 'nullable',
            'vission_of_righteye' => 'nullable',
            'vission_of_lefteye' => 'nullable',
            'blood_pressure' => 'required',
            'pulse_rate' => 'required',
            'blood_pressure_category' => 'nullable',
            'body_temperature' => 'required',
            'height' => 'nullable',
            'weight' => 'nullable',
            'bodymassindex' => 'nullable',
            'bodymassindex_category' => 'nullable',
            'injurie_status' => 'nullable',
            'dateofinjurie' => 'nullable',
            'name_of_hospital' => 'nullable',
            'immunization' => 'nullable',
            'other_immunization' => 'nullable',
            'familyhistory' => 'nullable',
            'other_familyhistory' => 'nullable',
        ]);

        $medicalInfo->fill($validated);
        $medicalInfo->illness = isset($validated['illness']) ? json_encode($validated['illness']) : null;
        $medicalInfo->immunization = isset($validated['immunization']) ? json_encode($validated['immunization']) : null;
        $medicalInfo->familyhistory = isset($validated['familyhistory']) ? json_encode($validated['familyhistory']) : null;

        $medicalInfo->save();

        return redirect()->back()->with('success', 'Medical history updated successfully');
    }
}
