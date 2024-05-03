<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Student;
use App\Models\Employee;
use App\Models\Nurse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Session;


class SuperAdminController extends Controller
{
    public function superadmin_index()
    {
        return view('super_admin.super_admin_index');
    }


    // PATIENT
    public function superadmin_patient()
    {
        return view('super_admin.patient');
    }

    public function student_patient()
    {
        $patients = Patient::all();
        return view('super_admin.patient.student_patient', compact('patients'));
    }

    public function employee_patient()
    {
        $patients = Patient::all();
        return view('super_admin.patient.employee_patient', compact('patients'));
    }
    public function importData(Request $request)
    {

        $students = Student::all();
        $employees = Employee::all();

        $duplicateEntries = [];


        foreach ($students as $student) {
            $password = $student->password;
            if (!Patient::where('student_id', $student->id)->exists()) {
                $patient = new Patient();
                $patient->student_id = $student->id;

                $patient->save();
            } else {
                $duplicateEntries[] = "Duplicate entry found for student ID: $student->id";
            }
        }


        foreach ($employees as $employee) {

            if (!Patient::where('employee_id', $employee->id)->exists()) {
                $patient = new Patient();
                $patient->employee_id = $employee->id;

                $patient->save();
            } else {
                $duplicateEntries[] = "Duplicate entry found for employee ID: $employee->id";
            }
        }


        if (!empty($duplicateEntries)) {
            Session::flash('duplicateEntries', $duplicateEntries);
        }


        return redirect()->back()->with('success', 'Data imported successfully.');
    }


    // STUDENT
    public function superadmin_student()
    {
        $students = Student::all();
        return view('super_admin.student', compact('students'));
    }

    public function addStudent()
    {
        return view('super_admin.student.addStudent');
    }

    public function store_student(Request $request)
    {
        $validated = $request->validate([
            'id' => ["required", Rule::unique('students', 'id')],
            'first_name' => "required",
            'middle_name' => "required",
            'last_name' => "required",
            'gender' => "required",
            'civil_status' => "required",
            'date_of_birth' => 'required|date',
            'birth_place' => "required",
            'permanent_address' => "required",
            'contact_number' => "required",
            "email" => ['required', 'email', Rule::unique('students', 'email')],
            'password' => 'required|confirmed', // 'password_confirmation' field must match 'password'
            'student_department' => "required",
            'student_level' => "required",
            'course' => "nullable",
            'school_year_enrolled' => "required",
            'emergency_contact_name' => "required",
            'emergency_contact_number' => "required",
            'emergency_contact_address' => "required",
            'status' => "required",
            'image' => "nullable",
        ]);
        if ($request->hasFile('image')) {

            $request->validate([
                "image" => 'mimes:jpeg,png,bmp,tiff,svg |max:4096'
            ]);

            $filenameWithExtension = $request->file("image");

            $filename = pathinfo($filenameWithExtension, PATHINFO_FILENAME);

            $extension = $request->file("image")->getClientOriginalExtension();
            $filenameToStore = $filename . '_' . time() . '.' . $extension;
            $smallThumbnail = $filename . '_' . time() . '.' . $extension;

            $request->file('image')->storeAs('public/student', $filenameToStore);
            $request->file('image')->storeAs('public/student/thumbnail', $smallThumbnail);

            $thumbNail = 'storage/student/thumbnail/' . $smallThumbnail;

            $this->createThumbnail($thumbNail, 150, 93);

            $validated['image'] = $filenameToStore;
        }
        //dd($validated);
        // dd($request->all());
        $validated['password'] = bcrypt($validated['password']);
        Student::create($validated);
        return response()->json(['message' => 'Registration successful'], 200);
    }

    public function edit_Student($id)
    {
        $students = Student::findOrFail($id);
        return view('super_admin.student.updateStudent', ["students" => $students]);
    }

    public function update_student(Request $request, Student $student)
    {
        // dd($request);
        $validated = $request->validate([
            // 'id' => ["required", Rule::unique('students', 'id')],
            'first_name' => "required",
            'middle_name' => "required",
            'last_name' => "required",
            'gender' => "required",
            'civil_status' => "required",
            'date_of_birth' => 'required|date',
            'birth_place' => "required",
            'permanent_address' => "required",
            'contact_number' => "required",
            // "email" => ['required', 'email', Rule::unique('students', 'email')],
            'password' => 'nullable|confirmed', // 'password_confirmation' field must match 'password'
            'student_department' => "required",
            'student_level' => "required",
            'course' => "nullable",
            'school_year_enrolled' => "required",
            'emergency_contact_name' => "required",
            'emergency_contact_number' => "required",
            'emergency_contact_address' => "required",
            'status' => "required",
            'image' => "nullable",
        ]);
        //  dd($validated);
        // dd($request);
        if ($request->hasFile('image')) {

            $request->validate([
                "image" => 'mimes:jpeg,png,bmp,tiff,svg |max:4096'
            ]);

            $filenameWithExtension = $request->file("image");

            $filename = pathinfo($filenameWithExtension, PATHINFO_FILENAME);

            $extension = $request->file("image")->getClientOriginalExtension();
            $filenameToStore = $filename . '_' . time() . '.' . $extension;
            $smallThumbnail = $filename . '_' . time() . '.' . $extension;

            $request->file('image')->storeAs('public/student', $filenameToStore);
            $request->file('image')->storeAs('public/student/thumbnail', $smallThumbnail);

            $thumbNail = 'storage/student/thumbnail/' . $smallThumbnail;

            $this->createThumbnail($thumbNail, 150, 93);

            $validated['image'] = $filenameToStore;
        }


        $validated['password'] = bcrypt($validated['password']);
        $student->update($validated);
        return redirect('/superadmin/student')->with('updateSuccess', true);
    }
    function checkStudentID(Request $request)
    {
        if ($request->has('student_id')) {
            $student_id = $request->input('student_id');

            // Check in the 'users' table
            $countStudents = DB::table('students')
                ->where('id', $student_id)
                ->count();

            // If the student_id exists in either table, consider it not unique
            if ($countStudents > 0) {
                echo 'not_unique';
            } else {
                echo 'unique';
            }
        }
    }

    //check student email
    function checkEmail(Request $request)
    {
        if ($request->has('email')) {
            $email = $request->input('email');

            // Check in the 'users' table
            $countDoctors = DB::table('doctors')
                ->where('email', $email)
                ->count();

            // If the student_id exists in either table, consider it not unique
            if ($countDoctors > 0) {
                echo 'not_unique';
            } else {
                echo 'unique';
            }
        }
    }

    // EMPLOYEE
    public function superadmin_employee()
    {
        $employees = Employee::all();
        return view('super_admin.employee', compact('employees'));
    }




    // DOCTOR
    public function superadmin_doctor()
    {
        $doctors = Doctor::all();
        return view('super_admin.doctor', compact('doctors'));
    }

    public function add_doctor()
    {
        return view('super_admin.doctor.addDoctor');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'department' => "required",
            'name' => "required",
            'phone_number' => "required",
            "email" => ['required', 'email', Rule::unique('doctors', 'email')],
            'password' => 'required|confirmed',
            'gender' => "required",
            'designation' => "required",
            'qualification' => 'required',
            'experience' => "required",
            'specialization' => "required",
            'bio' => "required",
            'address' => "required",
            'status' => "required",
            'image' => "nullable",
        ]);
        if ($request->hasFile('image')) {

            $request->validate([
                "image" => 'mimes:jpeg,png,bmp,tiff,svg |max:4096'
            ]);

            $filenameWithExtension = $request->file("image");

            $filename = pathinfo($filenameWithExtension, PATHINFO_FILENAME);

            $extension = $request->file("image")->getClientOriginalExtension();
            $filenameToStore = $filename . '_' . time() . '.' . $extension;
            $smallThumbnail = $filename . '_' . time() . '.' . $extension;

            $request->file('image')->storeAs('public/doctor', $filenameToStore);
            $request->file('image')->storeAs('public/doctor/thumbnail', $smallThumbnail);

            $thumbNail = 'storage/doctor/thumbnail/' . $smallThumbnail;

            $this->createThumbnail($thumbNail, 150, 93);

            $validated['image'] = $filenameToStore;
        }
        //dd($validated);
        $validated['password'] = bcrypt($validated['password']);
        Doctor::create($validated);
        return redirect('/superadmin/doctor')->with('message', 'New Doctor Added Successfully!');
    }
    public function createThumbnail($path, $with, $height)
    {
        $img = Image::make($path)->resize($with, $height, function ($constraint) {
            $constraint->aspectRatio();
        });
        $img->save($path);
    }

    function StudentcheckEmail(Request $request)
    {
        if ($request->has('email')) {
            $email = $request->input('email');

            // Check in the 'users' table
            $countStudents = DB::table('students')
                ->where('email', $email)
                ->count();

            // If the student_id exists in either table, consider it not unique
            if ($countStudents > 0) {
                echo 'not_unique';
            } else {
                echo 'unique';
            }
        }
    }

    public function updatedoctor($id)
    {
        $doctors = Doctor::findOrFail($id);
        return view('super_admin.doctor.updatedoctor', ['doctors' => $doctors]);
    }

    public function update(Request $request, Doctor $doctor)
    {
        $validated = $request->validate([
            'department' => "required",
            'name' => "required",
            'phone_number' => "required",
            // "email" => ['required', 'email', Rule::unique('doctors', 'email')],
            'password' => 'nullable|confirmed',
            'gender' => "required",
            'designation' => "required",
            'qualification' => 'required',
            'experience' => "required",
            'specialization' => "required",
            'bio' => "required",
            'address' => "required",
            'status' => "required",
            'image' => "nullable|mimes:jpeg,png,bmp,tiff,svg|max:4096",
        ]);


        if ($request->hasFile('image')) {

            $request->validate([
                "image" => 'mimes:jpeg,png,bmp,tiff,svg |max:4096'
            ]);

            $filenameWithExtension = $request->file("image");

            $filename = pathinfo($filenameWithExtension, PATHINFO_FILENAME);

            $extension = $request->file("image")->getClientOriginalExtension();
            $filenameToStore = $filename . '_' . time() . '.' . $extension;
            $smallThumbnail = $filename . '_' . time() . '.' . $extension;

            $request->file('image')->storeAs('public/doctor', $filenameToStore);
            $request->file('image')->storeAs('public/doctor/thumbnail', $smallThumbnail);

            $thumbNail = 'storage/doctor/thumbnail/' . $smallThumbnail;

            $this->createThumbnail($thumbNail, 150, 93);

            $validated['image'] = $filenameToStore;
        }
        $validated['password'] = bcrypt($validated['password']);
        $doctor->update($validated);
        return redirect('/superadmin/doctor')->with('updateSuccess', true);
    }

    public function destroy($modelName, $id)
    {
        $modelClass = "App\\Models\\" . ucfirst($modelName);

        // Check if the model class exists
        if (!class_exists($modelClass)) {
            return response()->json([
                'status' => 404,
                'message' => 'Model not found!'
            ], 404);
        }

        $model = $modelClass::find($id);

        // Check if the model instance exists
        if (!$model) {
            return response()->json([
                'status' => 404,
                'message' => 'Record not found!'
            ], 404);
        }

        $model->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Deleted successfully!'
        ]);
    }


    ///////////////////////////////////////////// NURSE ///////////////////////////////
    public function nurse()
    {
        $nurses = Nurse::all();
        return view('super_admin.manage_accounts.nurse', compact('nurses'));
    }

    public function createNurse()
    {
        return view('super_admin.manage_accounts.createNurse');
    }

    public function store_nurse(Request $request)
    {
        $validated = $request->validate([
            'name' => "required",
            'phone_number' => "required",
            "email" => ['required', 'email', Rule::unique('nurses', 'email')],
            'password' => 'required|confirmed',
            'gender' => "required",
            'specialties' => "required",
            'bio' => "required",
            'address' => "required",
            'status' => "required",
            'image' => "nullable",
        ]);
        if ($request->hasFile('image')) {

            $request->validate([
                "image" => 'mimes:jpeg,png,bmp,tiff,svg |max:4096'
            ]);

            $filenameWithExtension = $request->file("image");

            $filename = pathinfo($filenameWithExtension, PATHINFO_FILENAME);

            $extension = $request->file("image")->getClientOriginalExtension();
            $filenameToStore = $filename . '_' . time() . '.' . $extension;
            $smallThumbnail = $filename . '_' . time() . '.' . $extension;

            $request->file('image')->storeAs('public/nurse', $filenameToStore);
            $request->file('image')->storeAs('public/nurse/thumbnail', $smallThumbnail);

            $thumbNail = 'storage/nurse/thumbnail/' . $smallThumbnail;

            $this->createThumbnail($thumbNail, 150, 93);

            $validated['image'] = $filenameToStore;
        }
        //dd($validated);
        $validated['password'] = bcrypt($validated['password']);
        Nurse::create($validated);
        return redirect('/superadmin/nurse')->with('message', 'New Nurse Added Successfully!');
    }
}
