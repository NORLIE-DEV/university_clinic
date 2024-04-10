<?php

namespace App\Http\Controllers;

use App\Models\Timing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TimingController extends Controller
{
    public function storeDoctorTiming(Request $request)
    {
        $doctorId = Auth::id();
        $day = $request->input('day');
        $shiftType = $request->input('shift');

        // Check if a timing for the same doctor, day, and shift type already exists
        $existingTiming = Timing::where('doctor_id', $doctorId)
            ->where('day', $day)
            ->where('shift', $shiftType)
            ->exists();

        if ($existingTiming) {
            return redirect()->back()->with('error', 'Timing for this day and shift already exists');
        }

        // Proceed to create a new timing record if the timing doesn't already exist
        $doctorTiming = new Timing();

        $doctorTiming->doctor_id = $doctorId;
        $doctorTiming->day = $day;
        $doctorTiming->start_time = $request->input('start_time');
        $doctorTiming->shift = $shiftType;
        $doctorTiming->end_time = $request->input('end_time');
        $doctorTiming->average_consultation_time = $request->input('consultation_time');
        $doctorTiming->save();

        return redirect()->back()->with('success', 'Timing Added Success');
    }
}
