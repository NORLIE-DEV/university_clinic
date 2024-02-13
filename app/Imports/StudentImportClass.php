<?php

namespace App\Imports;

use App\Models\Student;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class StudentImportClass implements ToCollection
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

            $student = new Student([
                'student_id' => $row[0],
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
                'student_department' => $row[12],
                'student_level' => $row[13],
                'course' => $row[14],
                'school_year_enrolled' => $row[15],
                'status' => $row[16],
                'emergency_contact_name' => $row[17],
                'emergency_contact_number' => $row[18],
                'emergency_contact_address' => $row[19],
            ]);

            // Save the patient to the database
            $student->save();
        }
    }
}
