<?php

namespace App\Http\Controllers;

use App\Models\Timing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DoctorController extends Controller
{
    public function doctor_index(){
        return view('doctor.doctor_index');
    }

    public function timing(){
        $doctorId = Auth::id();
        $timings = Timing::where('doctor_id', $doctorId)->get();
        return view('doctor.timings.timing', compact('timings'));
    }
}
