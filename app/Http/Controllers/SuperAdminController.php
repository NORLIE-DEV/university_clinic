<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;


class SuperAdminController extends Controller
{
    public function superadmin_index()
    {
        return view('super_admin.super_admin_index');
    }
    public function superadmin_student()
    {
        return view('super_admin.student');
    }




    // PATIENT





    // STUDENT





    // EMPLOYEE





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
        return redirect('/superadmin/doctor')->with('message', 'Data was successfully updated');
    }
}
