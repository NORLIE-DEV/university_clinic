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

        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        $file = $request->file('file');

        Excel::import(new StudentImportClass, $file);

        return redirect()->back()->with('success', 'Excel file imported successfully!');
    }


    public function import_employee(Request $request)
    {

        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        $file = $request->file('file');

        Excel::import(new EmployeeImportClass, $file);

        return redirect()->back()->with('success', 'Excel file imported successfully!');
    }
}
