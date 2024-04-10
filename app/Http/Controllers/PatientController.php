<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Timing;
use App\Models\Patient;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PatientController extends Controller
{
    public function patient_index()
    {
        return view('patient.patient_index');
    }

    // department
    public function department()
    {
        return view('patient.department');
    }

    // dental
    public function dental()
    {
        $dentalDoctors = Doctor::where('department', 'dentist')->get();
        return view('patient.dental.dental', ['dentalDoctors' => $dentalDoctors]);
    }

    // medical
    public function medical()
    {
        $medicalDoctors = Doctor::where('department', 'physician')->get();
        return view('patient.medical.medical', ['medicalDoctors' => $medicalDoctors]);
    }

    // book appointment
    public function bookedAppointment(Request $request, $id)
    {

        $current_doctor = Doctor::findOrFail($id);
        $doctors = Doctor::with(['timings', 'appointments'])->get();
        $timings = Timing::all();
        $loggedInPatient = Auth::user();
        $user = $loggedInPatient->student ?: $loggedInPatient->employee;
        $appointments = Appointment::where('patient_id', $user->id)->get();
        $appointments = Appointment::all();
        return view('patient.booked.booked', compact('timings', 'loggedInPatient', 'appointments', 'doctors', 'current_doctor', 'user'));
    }

    public function makeAppointment(Request $request)
    {
        // Validate incoming data
        $validatedData = $request->validate([
            'date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'doctor_id' => 'required|exists:doctors,id',
        ]);

        // Retrieve the currently authenticated patient
        $patient = Auth::guard('patient')->user();

        // Determine if the patient is associated with a student or an employee
        if ($patient->student) {
            $user = $patient->student;
        } elseif ($patient->employee) {
            $user = $patient->employee;
        } else {
            // Handle the case where neither student nor employee is associated with the patient
            return response()->json(['error' => 'No student or employee associated with the patient'], 400);
        }

        // Create the appointment
        Appointment::create([
            'date' => $validatedData['date'],
            'start_time' => $validatedData['start_time'],
            'end_time' => $validatedData['end_time'],
            'doctor_id' => $validatedData['doctor_id'],
            'patient_id' => $patient->id, // Use the patient's own ID
            'appointment_status' => 'booked',
            'notes' => $request->input('notes'),
        ]);

        // Return a success message
        return response()->json(['message' => 'Appointment created successfully']);
    }



    public function checkAvailability(Request $request)
    {

        $date = $request->input('date');
        $startTime = $request->input('startTime');
        $endTime = $request->input('endTime');
        $doctorId = $request->input('doctorId');


        $startDateTime = \Carbon\Carbon::createFromFormat('Y-m-d H:i A', $date . ' ' . $startTime);
        $endDateTime = \Carbon\Carbon::createFromFormat('Y-m-d H:i A', $date . ' ' . $endTime);


        $existingAppointments = Appointment::where('doctor_id', $doctorId)
            ->where('date', $date)
            ->where(function ($query) use ($startDateTime, $endDateTime) {
                $query->where(function ($q) use ($startDateTime, $endDateTime) {
                    $q->where('start_time', '>=', $startDateTime)
                        ->where('start_time', '<', $endDateTime);
                })
                    ->orWhere(function ($q) use ($startDateTime, $endDateTime) {
                        $q->where('end_time', '>', $startDateTime)
                            ->where('end_time', '<=', $endDateTime);
                    })
                    ->orWhere(function ($q) use ($startDateTime, $endDateTime) {
                        $q->where('start_time', '<', $startDateTime)
                            ->where('end_time', '>', $endDateTime);
                    });
            })
            ->exists();


        if ($existingAppointments) {
            return response()->json(['available' => false, 'message' => 'Slot is already booked. Please choose another slot.']);
        } else {
            return response()->json(['available' => true, 'message' => 'Slot is available.']);
        }
    }


    public function finddoctor()
    {
        return view('patient.finddoctor');
    }
}
