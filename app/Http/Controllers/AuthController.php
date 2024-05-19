<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Student;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function patient_login()
    {
        return view('auth.patient_login');
    }
    public function superadmin_login()
    {
        return view('auth.superadmin_login');
    }

    // $credentials = $request->only('email', 'password');

    //     $student = Student::where('email', $credentials['email'])->first();
    //     $employee = Employee::where('email', $credentials['email'])->first();

    //     if ($student || $employee) {
    //         $patient = Patient::where(function ($query) use ($student, $employee) {
    //             if ($student) {
    //                 $query->where('student_id', $student->id);
    //             } elseif ($employee) {
    //                 $query->where('employee_id', $employee->id);
    //             }
    //         })->first();

    //         if ($patient && ($student && password_verify($credentials['password'], $student->password)) || ($employee && password_verify($credentials['password'], $employee->password))) {
    //             Auth::guard('patient')->login($patient);
    //             $request->session()->regenerate();

    //             if ($student) {
    //                 return redirect()->route('patient.index');
    //             } elseif ($employee) {
    //                 return redirect()->route('patient.index');
    //             }
    //         }
    //     }
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        $student = Student::where('email', $credentials['email'])->first();
        $employee = Employee::where('email', $credentials['email'])->first();

        if ($student || $employee) {
            $patient = Patient::where(function ($query) use ($student, $employee) {
                if ($student) {
                    $query->where('student_id', $student->id);
                } elseif ($employee) {
                    $query->where('employee_id', $employee->id);
                }
            })->first();

            if ($patient) {
                if (($student && password_verify($credentials['password'], $student->password) && strtolower($student->status) === 'active') ||
                    ($employee && password_verify($credentials['password'], $employee->password) && strtolower($employee->status) === 'active')
                ) {

                    Auth::guard('patient')->login($patient);
                    $request->session()->regenerate();

                    return redirect()->route('patient.index');
                } else {
                    // If the user's status is not active, or password verification fails
                    return back()->withErrors([
                        'email' => 'The provided credentials do not match our records or the account is not active.',
                    ]);
                }
            }
        } else if (Auth::guard('doctor')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->guest(route('doctor.index'));
        }

        return redirect()->back()->withErrors(['email' => 'Email and Password not Matched!']);
    }




    public function studentLogout(Request $request)
    {
        if (Auth::guard('patient')->check()) {
            Auth::guard('patient')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }

        return redirect('/patient_login')->with('message', 'Patient logout successful');
    }

    public function doctorLogout(Request $request)
    {
        if (Auth::guard('doctor')->check()) {
            Auth::guard('doctor')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }

        return redirect('/patient_login')->with('message', 'Patient logout successful');
    }

    public function login_superadmin(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('superadmin')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->guest(route('superadmin.index'));
        }

        return redirect()->back()->withErrors(['email' => 'Email and Password not Matched!']);
    }
}
