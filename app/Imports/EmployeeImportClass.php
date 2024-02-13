<?php

namespace App\Imports;

use App\Models\Employee;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class EmployeeImportClass implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {

            if (!isset($row[0]) || $row[0] === '') {
                continue;
            }


            $excelDate = $row[6];
            if (is_numeric($excelDate)) {
                $birthdate = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($excelDate)->format('Y-m-d');
            } else {

                $birthdate = null;
            }


            if ($birthdate === null) {

                continue;
            }

            $student = new Employee([
                'employee_id' => $row[0],
                'first_name' => $row[1],
                'middle_name' => $row[2],
                'last_name' => $row[3],
                'gender' => $row[4],
                'civil_status' => $row[5],
                'date_of_birth' => $birthdate,
                'birth_place' => $row[7],
                'permanent_address' => $row[8],
                'contact_number' => $row[9],
                'email' => $row[10],
                'password' => $row[11],
                'employee_department' => $row[12],
                'employee_position' => $row[13],
                'status' => $row[14],
                'emergency_contact_name' => $row[15],
                'emergency_contact_number' => $row[16],
                'emergency_contact_address' => $row[17],
            ]);

            // Save the patient to the database
            $student->save();
        }
    }
}
