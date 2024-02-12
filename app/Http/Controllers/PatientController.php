<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function patient_index(){
        return view('patient.patient_index');
    }
}
