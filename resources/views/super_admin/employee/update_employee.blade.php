@extends('layout.superadmin_layout')

@section('content')
    <div class="bg-white h-auto p-3 shadow-xl rounded"
        style="width:1000px; margin: 10px auto; border:1px solid rgb(202, 197, 197);">
        <div class="flex justify-between mt-3">
            <h1 class="text-xl font-medium text-gray-500 ml-4"><i class="fa-solid fa-graduation-cap"></i><span
                    class="ml-2"></span>Update employees</h1>
            <a href="/superadmin/employee"
                class="bg-blue-950 p-2 text-xs w-24 rounded-md text-center text-white font-semibold">Back</a>
        </div>
        <div class="width-full bg-green-500 text-white p-2 mt-3 hidden" id="addsuccess">
            <h5>SUCCESS</h5>
        </div>
        <form action="/employees/{{ $employees->id }}" method="POST" enctype="multipart/form-data" class="mt-10">
            @method('PUT')
            {{ csrf_field() }}
            <div class="flex">
                <div class="" style="width:650px;">
                    <div class="m-2">
                        <label for="id" class="text-sm">employees ID * </label><br>
                        <input name="id" id="id" class="w-full p-2 text-xs rounded-md mt-2"
                            placeholder="employees ID - (Don't include any special character)"
                            style="border:1px solid gray;" value="{{ $employees->id }}" required>
                        <div id="error_student_id"></div>
                    </div>
                    <h4 class="ml-2 font-semibold mt-5">employees Information</h4>
                    <div class="flex justify-between">
                        <div class="m-2">
                            <label for="first_name" class="text-sm">First Name *</label><br>
                            <input type="text" name="first_name" placeholder="First Name"
                                class="p-2 rounded-md mt-2 text-xs" style="border: 1px solid gray; width:200px;"
                                value="{{ $employees->first_name }}" required>
                        </div>
                        <div class="m-2">
                            <label for="middle_name" class="text-sm">Middle Name *</label><br>
                            <input type="text" name="middle_name" placeholder="Middle Name"
                                class="p-2 rounded-md mt-2 text-xs" style="border: 1px solid gray; width:200px;"
                                value="{{ $employees->middle_name }}" required>
                        </div>
                        <div class="m-2">
                            <label for="last_name" class="text-sm">Last Name *</label><br>
                            <input type="text" name="last_name" placeholder="Last Name"
                                class="p-2 rounded-md mt-2 text-xs" style="border: 1px solid gray; width:200px;"
                                value="{{ $employees->last_name }}" required>
                        </div>

                    </div>
                    <div class="flex justify-between">
                        <div class="m-2">
                            <label for="gender" class="text-sm">Gender *</label><br>
                            <select name="gender" class=" rounded-md mt-2 text-xs"
                                style="border: 1px solid gray; width:300px; padding:8px;" required>
                                <option value="male"{{ $employees->gender == 'male' ? 'selected' : '' }}>Male</option>
                                <option value="female"{{ $employees->gender == 'female' ? 'selected' : '' }}>Female</option>
                            </select>
                        </div>
                        <div class="m-2">
                            <label for="civil_status" class="text-sm">Civil Status *</label><br>
                            <select name="civil_status" class=" rounded-md mt-2 text-xs"
                                style="border: 1px solid gray; width:300px; padding:8px;" required>
                                <option value="single"{{ $employees->civil_status == 'single' ? 'selected' : '' }}>Single
                                </option>
                                <option value="married"{{ $employees->civil_status == 'married' ? 'selected' : '' }}>Married
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="flex justify-between text-sm">
                        <div class="m-2">
                            <label for="date_of_birth">Date of Birth *</label><br>
                            <input type="date" name="date_of_birth" placeholder="Date Of Birth" id="date_of_birth"
                                class="p-2 text-xs rounded-md mt-2" style="border: 1px solid gray; width:470px;"
                                value="{{ $employees->date_of_birth }}" required>


                        </div>
                        <div class="m-2">
                            <label for="birth_place">Birth Place *</label><br>
                            <input type="text" name="birth_place" id="birth_place" placeholder="Birth Place"
                                class="p-2 text-xs rounded-md mt-2" style="border: 1px solid gray; width:470px;"
                                value="{{ $employees->birth_place }}" required>
                            {{-- <div id="passwordMatch"></div> --}}
                        </div>
                    </div>
                    <div class="m-2">
                        <label for="permanent_address" class="text-sm">Permanent Address *</label><br>
                        <input type="text" name="permanent_address" id="permanent_address"
                            placeholder="Permamnent Addres" class="p-2 text-xs rounded-md mt-2 "
                            style="border: 1px solid gray; width:955px;" value="{{ $employees->permanent_address }}"
                            required>
                        {{-- <div id="error_email"></div> --}}
                    </div>
                    <div class="m-2">
                        <label for="contact_number" class="text-sm">Contact Number *</label><br>
                        <input type="text" name="contact_number" id="contact_number" placeholder="Contact Number"
                            class="p-2 text-xs rounded-md mt-2 " style="border: 1px solid gray; width:955px;"
                            value="{{ $employees->contact_number }}" required>
                        <div id="cpNumber_err"></div>
                    </div>
                    <div class="mt-4">
                        <h1 class="ml-2 font-semibold">Accounts</h1>
                    </div>
                    <div class="m-2">
                        <label for="email" class="text-sm">Email *</label><br>
                        <input type="email" name="email" id="email" placeholder="Email"
                            class="p-2 text-xs rounded-md mt-2 " style="border: 1px solid gray; width:955px;"
                            value="{{ $employees->email }}" required>
                        <div id="error_email"></div>
                    </div>

                </div>
                {{-- image --}}
                <div class="mt-5" style="width: 400px;">
                    @php
                        //    $default_profile = "https://api.dicebear.com/7.x/initials/".$student->first_name."-".$student->last_name.".svg";
                        // echo $default_profile,'<br>';
                        $default_profile = 'https://api.dicebear.com/7.x/adventurer-neutral/svg';
                    @endphp

                    <div class="">
                        <img class="m-auto"id="image-preview"
                            style="width:200px; height:180px;"src="{{ $employees->image ? asset('storage/employee/' . $employees->image) : $default_profile }}">
                    </div>
                    <div class="m-2">
                        <label for="image" class="text-xs ml-16">Upload Student Image</label>
                        <input type="file" name="image" id="upload" accept="image/*"
                            class="border text-xs mt-2 ml-16">
                    </div>
                </div>
            </div>
            <div class="flex justify-between text-sm">
                <div class="m-2">
                    <label for="password">Password *</label><br>
                    <input type="password" name="password" placeholder="Password" id="password"
                        class="p-2 text-xs rounded-md mt-2" style="border: 1px solid gray; width:450px;">


                </div>
                <div class="m-2">
                    <label for="password_confirmation">Confirm Password *</label><br>
                    <input type="password" name="password_confirmation" id="password_confirmation"
                        placeholder="Confirm Password" class="p-2 text-xs rounded-md mt-2"
                        style="border: 1px solid gray; width:450px;">
                    <div id="passwordMatch"></div>
                </div>
            </div>
            <div class="ml-2 mt-4">
                <h1 class="font-semibold">Other Information</h1>
            </div>
            <div class="flex justify-between">
                <div class="m-2">
                    <label for="employee_department" class="text-sm">Employee Department *</label><br>
                    <input name="employee_department" class=" rounded-md mt-2 text-xs" id="employee_department"
                        value="{{ $employees->employee_department }}"
                        style="border: 1px solid gray; width:450px; padding:8px;" required>
                </div>
                <div class="m-2">
                    <label for="employee_position" class="text-sm">Employee Position</label><br>
                    <input type="text" name="employee_position" id="employee_position"
                        class=" rounded-md mt-2 text-xs" value="{{ $employees->employee_position }}"
                        style="border: 1px solid gray; width:450px; padding:8px; "required>
                </div>

                {{-- <div class="m-2">
                    <label for="student_department" class="text-sm">Student Department *</label><br>
                    <select name="student_department" class=" rounded-md mt-2 text-xs" id="student_department"
                        style="border: 1px solid gray; width:270px; padding:8px;" required>
                        <option value="" disabled selected>Department</option>
                        <option value="0">Kinder and Pre-School</option>
                        <option value="1">Elementary</option>
                        <option value="2">Junior High School</option>
                        <option value="3">Senior High School</option>
                        <option value="4">College of Arts and Science </option>
                        <option value="5">College of Computer Studies</option>
                        <option value="6">College of Criminal Justice</option>
                        <option value="7">College of Education</option>
                        <option value="8">College of Engineering and Architechture</option>
                        <option value="9">College of Business in Accountancy</option>
                        <option value="10">College of Nursing</option>
                        <option value="11">School of Law</option>
                    </select>
                </div>
                <div class="m-2">
                    <label for="student_level" class="text-sm">Year Level</label><br>
                    <select type="text" name="student_level" id="student_level" class=" rounded-md mt-2 text-xs "
                        style="border: 1px solid gray; width:270px; padding:8px;">
                        <option value="" disabled selected>Year Level</option>
                    </select>
                </div>
                <div class="m-2">
                    <label for="course" class="text-sm">Course</label><br>
                    <select type="text" name="course" id="course" class=" rounded-md mt-2 text-xs"
                        style="border: 1px solid gray; width:270px; padding:8px;">
                        <option value="" disabled selected>Course</option>
                    </select>
                </div> --}}
            </div>

            <h4 class="ml-2 font-semibold mt-5 text-sm">Emergency Contact</h4>
            <div class="flex justify-between">
                <div class="m-2">
                    <label for="emergency_contact_name" class="text-sm">Full Name</label><br>
                    <input type="text" name="emergency_contact_name" placeholder="Contact Name"
                        class=" rounded-md mt-2 text-xs" style="border: 1px solid gray; width:270px; padding:8px;"
                        value="{{ $employees->emergency_contact_name }}" required>
                </div>
                <div class="m-2">
                    <label for="emergency_contact_address" class="text-sm">Address</label><br>
                    <input type="text" name="emergency_contact_address" placeholder=" Address"
                        class=" rounded-md mt-2 text-xs" style="border: 1px solid gray; width:270px; padding:8px"
                        value="{{ $employees->emergency_contact_address }}" required>
                </div>
                <div class="m-2">
                    <label for="emergency_contact_number" class="text-sm">Cellphone Number</label><br>
                    <input type="text" name="emergency_contact_number" id="emergency_contact_number"
                        placeholder="Cellphone Number" class=" rounded-md mt-2 text-xs"
                        style="border: 1px solid gray; width:270px; padding:8px;"
                        value="{{ $employees->emergency_contact_number }}" required>
                    <div id="error_emergencyNumber"></div>
                </div>
            </div>
            <div class="m-2">
                <label for="status" class="text-sm">Status*</label><br>
                <select name="status" class="p-2 text-xs rounded-md mt-2 w-full" style="border: 1px solid gray;"
                    required>
                    <option value="active"{{ $employees->status == 'active' ? 'selected' : '' }}>Active
                    </option>
                    <option value="not-active"{{ $employees->status == 'not-active' ? 'selected' : '' }}>Not-Active
                    </option>
                </select>
            </div>
            <input type="submit" id="submit" class="m-2 p-3 text-xs font-bold bg-blue-950 rounded-lg text-white"
                style="width:960px">
        </form>
    </div>

    {{-- <script src="{{ asset('asset/js/superadmin/student/department.js') }}"></script> --}}
    <script>
        $(document).ready(function() {
            //  alert(2);
            $("#id").prop("disabled", true);
            $("#email").prop("disabled", true);


            //   image
            $("#upload").change(function() {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $("#image-preview").attr("src", e.target.result);
                };
                reader.readAsDataURL(this.files[0]);
            });


        });
    </script>
@endsection
