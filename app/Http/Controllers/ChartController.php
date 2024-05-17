<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChartController extends Controller
{
    public function index()
    {
        // Example data for the chart
        $data = [
            ['Month', 'Sales'],
            ['January', 1000],
            ['February', 1170],
            ['March', 660],
            ['April', 1030]
        ];

        // Convert data to JSON for use in the view
        $chartData = json_encode($data);

        // Pass the data to the view
        return view('super_admin.super_admin_index', compact('chartData'));
    }
}
