<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\StudentImportClass;
use App\Imports\EmployeeImportClass;
use Maatwebsite\Excel\Facades\Excel;

class ExcelImportController extends Controller
{
    public function import_student(Request $request)
    {
        try {
            $request->validate([
                'file' => 'required|mimes:xlsx,xls',
            ]);

            $file = $request->file('file');

            Excel::import(new StudentImportClass, $file);

            return redirect()->back()->with('success', 'Excel file imported successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while importing the Excel file. Please try again.');
        }
    }


    public function import_employee(Request $request)
    {
        try {
            $request->validate([
                'file' => 'required|mimes:xlsx,xls',
            ]);

            $file = $request->file('file');

            Excel::import(new EmployeeImportClass, $file);

            return redirect()->back()->with('success', 'Excel file imported successfully!');
        } catch (\Exception $e) {

            // Return back with an error message
            return redirect()->back()->with('error', 'An error occurred while importing the Excel file. Please try again.');
        }
    }
}
