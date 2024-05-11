<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Sickleavemedicalcertificates;

class MedicalCertificate extends Controller
{
    public function medical_sickleave_form($id)
    {
        $doctorId = Auth::id();
        $cert = Sickleavemedicalcertificates::all();
        $patient = Patient::findOrFail($id);
        return view('doctor.patients.medical_certificate.sickliveMedicalCertForm', ["patient" => $patient, "doctorId" => $doctorId, "cert"=>$cert]);
    }

    public function store_medical_sickleave(Request $request)
    {
        $validated = $request->validate([
            'certificateID' => "required",
            'doctor_id' => "required",
            'patient_id' => "required",
            'absent_from' => "required",
            'absent_to' => "required",
            'number_days_absent' => "required",
            'date_issue' => "required",
            'reason' => "required",
            'findings' => "required",
            'remarks' => "required",
        ]);
        Sickleavemedicalcertificates::create($validated);
        return response()->json(['success' => ' saved successfully'], 200);
    }
}
