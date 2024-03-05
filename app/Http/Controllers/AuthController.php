<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function patient_login(){
        return view('auth.patient_login');
    }
}
