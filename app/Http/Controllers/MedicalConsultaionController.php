<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

class MedicalConsultaionController extends Controller
{
    public function medical_consultation($id)
    {
        $patientsInfo = Patient::findOrFail($id);
        return view('admin.patient.student.medical consultation.medical_consulation',["patientsInfo" => $patientsInfo]);
    }
}
