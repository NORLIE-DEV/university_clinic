<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LandinPageController extends Controller
{
    public function about(){
        return view('layout.landingpage_layout');
    }
}
