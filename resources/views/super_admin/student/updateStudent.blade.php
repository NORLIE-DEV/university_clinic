@extends('layout.superadmin_layout')

@section('content')
    <div class="bg-white h-auto p-3 shadow-xl rounded"
        style="width:1000px; margin: 10px auto; border:1px solid rgb(202, 197, 197);">
        <div class="flex justify-between mt-3">
            <h1 class="text-xl font-medium text-gray-500 ml-4"><i class="fa-solid fa-graduation-cap"></i><span
                    class="ml-2"></span>Update Student</h1>
            <a href="/superadmin/student"
                class="bg-blue-950 p-2 text-xs w-24 rounded-md text-center text-white font-semibold">Back</a>
        </div>
        <div class="width-full bg-green-500 text-white p-2 mt-3 hidden" id="addsuccess">
            <h5>SUCCESS</h5>
        </div>
        <form id="studentForm" action="/student/{{ $students->id }}" method="POST" enctype="multipart/form-data"
            class="mt-10">
            @method('PUT')
            {{ csrf_field() }}
            <div class="flex">
                <div class="" style="width:650px;">
                    <div class="m-2">
                        <label for="id" class="text-sm">Student ID * </label><br>
                        <input name="id" id="id" class="w-full p-2 text-xs rounded-md mt-2"
                            placeholder="Student ID - (Don't include any special character)" style="border:1px solid gray;"
                            value="{{ $students->id }}" required>
                        <div id="error_student_id"></div>
                    </div>
                    <h4 class="ml-2 font-semibold mt-5">Student Information</h4>
                    <div class="flex justify-between">
                        <div class="m-2">
                            <label for="first_name" class="text-sm">First Name *</label><br>
                            <input type="text" name="first_name" placeholder="First Name"
                                class="p-2 rounded-md mt-2 text-xs" style="border: 1px solid gray; width:200px;"
                                value="{{ $students->first_name }}" required>
                        </div>
                        <div class="m-2">
                            <label for="middle_name" class="text-sm">Middle Name *</label><br>
                            <input type="text" name="middle_name" placeholder="Middle Name"
                                class="p-2 rounded-md mt-2 text-xs" style="border: 1px solid gray; width:200px;"
                                value="{{ $students->middle_name }}" required>
                        </div>
                        <div class="m-2">
                            <label for="last_name" class="text-sm">Last Name *</label><br>
                            <input type="text" name="last_name" placeholder="Last Name"
                                class="p-2 rounded-md mt-2 text-xs" style="border: 1px solid gray; width:200px;"
                                value="{{ $students->last_name }}" required>
                        </div>

                    </div>
                    <div class="flex justify-between">
                        <div class="m-2">
                            <label for="gender" class="text-sm">Gender *</label><br>
                            <select name="gender" class=" rounded-md mt-2 text-xs"
                                style="border: 1px solid gray; width:300px; padding:8px;" required>
                                <option value="male"{{ $students->gender == 'male' ? 'selected' : '' }}>Male</option>
                                <option value="female"{{ $students->gender == 'female' ? 'selected' : '' }}>Female</option>
                            </select>
                        </div>
                        <div class="m-2">
                            <label for="civil_status" class="text-sm">Civil Status *</label><br>
                            <select name="civil_status" class=" rounded-md mt-2 text-xs"
                                style="border: 1px solid gray; width:300px; padding:8px;" required>
                                <option value="single"{{ $students->civil_status == 'single' ? 'selected' : '' }}>Single
                                </option>
                                <option value="married"{{ $students->civil_status == 'married' ? 'selected' : '' }}>Married
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="flex justify-between text-sm">
                        <div class="m-2">
                            <label for="date_of_birth">Date of Birth *</label><br>
                            <input type="date" name="date_of_birth" placeholder="Date Of Birth" id="date_of_birth"
                                class="p-2 text-xs rounded-md mt-2" style="border: 1px solid gray; width:470px;"
                                value="{{ $students->date_of_birth }}" required>


                        </div>
                        <div class="m-2">
                            <label for="birth_place">Birth Place *</label><br>
                            <input type="text" name="birth_place" id="birth_place" placeholder="Birth Place"
                                class="p-2 text-xs rounded-md mt-2" style="border: 1px solid gray; width:470px;"
                                value="{{ $students->birth_place }}" required>
                            {{-- <div id="passwordMatch"></div> --}}
                        </div>
                    </div>
                    <div class="m-2">
                        <label for="permanent_address" class="text-sm">Permanent Address *</label><br>
                        <input type="text" name="permanent_address" id="permanent_address"
                            placeholder="Permamnent Addres" class="p-2 text-xs rounded-md mt-2 "
                            style="border: 1px solid gray; width:955px;" value="{{ $students->permanent_address }}"
                            required>
                        {{-- <div id="error_email"></div> --}}
                    </div>
                    <div class="m-2">
                        <label for="contact_number" class="text-sm">Contact Number *</label><br>
                        <input type="text" name="contact_number" id="contact_number" placeholder="Contact Number"
                            class="p-2 text-xs rounded-md mt-2 " style="border: 1px solid gray; width:955px;"
                            value="{{ $students->contact_number }}" required>
                        <div id="cpNumber_err"></div>
                    </div>
                    <div class="mt-4">
                        <h1 class="ml-2 font-semibold">Accounts</h1>
                    </div>
                    <div class="m-2">
                        <label for="email" class="text-sm">Email *</label><br>
                        <input type="email" name="email" id="email" placeholder="Email"
                            class="p-2 text-xs rounded-md mt-2 " style="border: 1px solid gray; width:955px;"
                            value="{{ $students->email }}" required>
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
                            style="width:200px; height:180px;"src="{{ $students->image ? asset('storage/student/' . $students->image) : $default_profile }}">
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
                </div>
            </div>
            <div class="m-2">
                <label for="school_year_enrolled" class="text-sm">School Year Enrolled *</label><br>
                <input type="text" name="school_year_enrolled" id="school_year_enrolled"
                    placeholder="School Year Enrolled" class="p-2 text-xs rounded-md mt-2 "
                    style="border: 1px solid gray; width:955px;" value="{{ $students->school_year_enrolled }}" required>
                {{-- <div id="error_email"></div> --}}
            </div>
            <h4 class="ml-2 font-semibold mt-5 text-sm">Emergency Contact</h4>
            <div class="flex justify-between">
                <div class="m-2">
                    <label for="emergency_contact_name" class="text-sm">Full Name</label><br>
                    <input type="text" name="emergency_contact_name" placeholder="Contact Name"
                        class=" rounded-md mt-2 text-xs" style="border: 1px solid gray; width:270px; padding:8px;"
                        value="{{ $students->emergency_contact_name }}" required>
                </div>
                <div class="m-2">
                    <label for="emergency_contact_address" class="text-sm">Address</label><br>
                    <input type="text" name="emergency_contact_address" placeholder=" Address"
                        class=" rounded-md mt-2 text-xs" style="border: 1px solid gray; width:270px; padding:8px"
                        value="{{ $students->emergency_contact_address }}" required>
                </div>
                <div class="m-2">
                    <label for="emergency_contact_number" class="text-sm">Cellphone Number</label><br>
                    <input type="text" name="emergency_contact_number" id="emergency_contact_number"
                        placeholder="Cellphone Number" class=" rounded-md mt-2 text-xs"
                        style="border: 1px solid gray; width:270px; padding:8px;"
                        value="{{ $students->emergency_contact_number }}" required>
                    <div id="error_emergencyNumber"></div>
                </div>
            </div>
            <div class="m-2">
                <label for="status" class="text-sm">Status*</label><br>
                <select name="status" class="p-2 text-xs rounded-md mt-2 w-full" style="border: 1px solid gray;"
                    required>
                    <option value="active"{{ $students->status == 'active' ? 'selected' : '' }}>Active
                    </option>
                    <option value="not-active"{{ $students->status == 'not-active' ? 'selected' : '' }}>Not-Active
                    </option>
                </select>
            </div>
            <input type="submit" id="submit" class="m-2 p-3 text-xs font-bold bg-blue-950 rounded-lg text-white"
                style="width:960px">
        </form>
    </div>

    <script src="{{ asset('asset/js/superadmin/student/department.js') }}"></script>
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

            var departmentDropdown = $("#department");
            var courseDropdown = $("#course");
            var studentlevelDropdown = $("#student_level");
            var departmentOptions = {
                0: ["Nursery 1", "Nursery 2", "Kinder 2"],
                1: ["Grade 1", "Grade 2", "Grade 3", "Grade 4", "Grade 5",
                    "Grade 6"
                ],
                2: ["Grade 7", "Grade 8", "Grade 9", "Grade 10"],
                3: ["Grade 11", "Grade 12"],
                4: ["1st Year", "2nd Year", "3rd Year", "4th Year",
                    "5th Year"
                ],
                5: ["1st Year", "2nd Year", "3rd Year", "4th Year",
                    "5th Year"
                ],
                6: ["1st Year", "2nd Year", "3rd Year", "4th Year",
                    "5th Year"
                ],
                7: ["1st Year", "2nd Year", "3rd Year", "4th Year",
                    "5th Year"
                ],
                8: ["1st Year", "2nd Year", "3rd Year", "4th Year",
                    "5th Year"
                ],
                9: ["1st Year", "2nd Year", "3rd Year", "4th Year",
                    "5th Year"
                ],
                10: ["1st Year", "2nd Year", "3rd Year", "4th Year",
                    "5th Year"
                ],
                11: ["1st Year", "2nd Year", "3rd Year", "4th Year",
                    "5th Year"
                ],
            };

            var courseOptions = {
                4: [
                    "Political Science",
                    "Psychology",
                    "Biology",
                    "Environmental Science",
                ],
                5: [
                    "Computer Technology",
                    "Library in Information System",
                    "Computer Science",
                    "Information Technology",
                ],
                6: ["Criminology"],
                7: [
                    "Physical Education",
                    "Elementary Education",
                    "Secondary Education Major in English",
                    "Secondary Education Major in Filipino",
                    "Secondary Education Major in Mathematics",
                    "Secondary Education Major in Science",
                    "Special Needs Education Major in Teaching Deaf And Hard-of-Hearing Learners",
                    "Special Needs Education Major in Teaching Learners W/ Visual Impairment",
                    "Teacher Certificate Program-MAPEH",
                ],
                8: [
                    "Architecture",
                    "Civil Engineering",
                    "Computer Engineering",
                    "Electrical Engineering",
                    "Electronics Engineering",
                    "Mechanical Engineering",
                ],
                9: [
                    "Accountancy",
                    "Accounting Information System",
                    "Business Administration Major in Financial Management",
                    "Business Administration Major in Marketing Management",
                    "Business Administration Major in Digital Marketing",
                    "Entrepreneurship",
                    "Hospitality Management",
                    "Tourism Management",
                    "ETEEAP",
                    "Business Administration Major in Human Resource Management",
                    "Business Administration Major in Operation Management",
                ],
                10: ["Nursing", "Caregiving NCII (7 Months)"],
                11: ["Juris Doctor", "Master of Laws", "Refresher Course"],
            };

            departmentDropdown.on("change", function() {
                var selectedDepartment = parseInt(departmentDropdown.val());


                courseDropdown.empty();
                studentlevelDropdown.empty();


                if (selectedDepartment in departmentOptions) {

                    populateDropdown(studentlevelDropdown, departmentOptions[
                        selectedDepartment]);


                    if ([0, 1, 2, 3].includes(selectedDepartment)) {

                        courseDropdown.prop("disabled", true);
                        courseDropdown.append('<option value="">Option Disabled</option>');
                    } else {
                        courseDropdown.prop("disabled", false);
                        if (selectedDepartment in courseOptions) {
                            populateDropdown(courseDropdown, courseOptions[selectedDepartment]);
                        }
                    }
                }
            });

            function populateDropdown(dropdown, options) {
                console.log("Options:", options);

                options.forEach(function(option, index) {
                    console.log("Appending option:", option, "with value:", index + 1);
                    dropdown.append('<option value="' + (index + 1) + '">' + option +
                        '</option>');
                });
            }


            var departmentDropdown = $("#student_department");
            departmentDropdown.val("{{ $students->student_department }}").trigger("change");


            var selectedDepartment = parseInt(departmentDropdown.val());
            studentlevelDropdown.val(parseInt("{{ $students->student_level }}"));

            courseDropdown.val(parseInt("{{ $students->course }}"));

        });
    </script>
@endsection
