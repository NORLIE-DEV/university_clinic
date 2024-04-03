<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function patient_login()
    {
        return view('auth.patient_login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('student')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->guest(route('patient.index'));
        } else {
            return redirect()->back()->withErrors(['email' => 'Email and Password not Matched!']);
        }
    }

    public function studentLogout(Request $request)
    {
        if (Auth::guard('student')->check()) {
            Auth::guard('student')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }

        return redirect('/patient_login')->with('message', 'Patient logout successful');
    }
}
