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
            'phone_number' => 'nullable',
            'full_name' => 'required',
            'notes' => 'nullable',
        ]);

        // Retrieve the currently authenticated patient
        $patient = Auth::guard('patient')->user();


        if ($patient->student) {
            $user = $patient->student;
        } elseif ($patient->employee) {
            $user = $patient->employee;
        } else {

            return response()->json(['error' => 'No student or employee associated with the patient'], 400);
        }

        // Create the appointment
        Appointment::create([
            'date' => $validatedData['date'],
            'start_time' => $validatedData['start_time'],
            'end_time' => $validatedData['end_time'],
            'doctor_id' => $validatedData['doctor_id'],
            'patient_id' => $patient->id,
            'appointment_status' => 'booked',
            'notes' => $request->input('notes'),
            'phone_number' => $request->input('phone_number'),
            'full_name' => $request->input('full_name'),
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

    // view myappointment
    public function viewAppointment()
    {
        $patientId = Auth::id();
        $appointments = Appointment::where('patient_id', $patientId)
            ->where('appointment_status', 'booked')
            ->get();
        return view('patient.booked.appointment', compact('appointments'));
    }


    public function viewMyAppointment($id)
    {
        $viewappointment = Appointment::findOrFail($id);
        return view('patient.booked.viewmyappointments', compact('viewappointment'));
    }

    // getdoctor
    public function getDoctors()
    {
        $doctors = Doctor::select('id', 'name')->get(); 
        return response()->json(['doctors' => $doctors]);
    }

    public function getAppointmentsByDoctor($doctorId)
    {
        $appointments = Appointment::where('doctor_id', $doctorId)->get();
        return response()->json(['appointments' => $appointments]);
    }

    public function getAllAppointments()
    {
        $appointments = Appointment::all();
        return response()->json(['appointments' => $appointments]);
    }
}
