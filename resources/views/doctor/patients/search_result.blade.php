@extends('layout.doctor_layout')

@section('content')
    {{-- {{$studentPatient->student->first_name ?? $studentPatient->employee->first_name}} --}}

    <div class="bg-white m-3 p-3 mt-5 shadow-lg border">
        <div class="text-gray-500 font-medium ml-2">Patients</div>
    </div>
    <div class="flex">
        <div class=" h-3/4 shadow-md rounded-md m-3 bg-white" style="width:100%;">
            <div class="flex justify-between items-center p-4">
                <div class="font-medium text-gray-600">
                    Patient Profile
                </div>
                <div>
                    <a href="/doctor_index/patient/student">Home</a>
                </div>
            </div>
            <hr class="mx-auto" style="width: 98%;">
            <div class="flex ml-5">
                <div class="flex bg-blue-600 p-3 m-5 mt-7 font-semibold rounded-lg shadow-md">
                    <div class="text-white text-4xl">
                        {{ strtoupper(substr($studentPatient->student->first_name ?? $studentPatient->employee->first_name, 0, 1)) }}
                    </div>
                    <div class="text-white text-4xl">
                        {{ strtoupper(substr($studentPatient->student->last_name ?? $studentPatient->employee->last_name, 0, 1)) }}
                    </div>
                </div>
                <div class=" font-medium">
                    <div>
                        <div class="flex gap-2 mt-6 text-blue-900 uppercase">
                            <div>{{ $studentPatient->student->first_name ?? $studentPatient->employee->first_name }}</div>
                            <div>{{ $studentPatient->student->last_name ?? $studentPatient->employee->last_name }}</div>

                        </div>
                        @php
                            $birthdate =
                                $studentPatient->student->date_of_birth ?? $studentPatient->employee->date_of_birth;
                            $currentDate = date('Y-m-d');
                            $diff = date_diff(date_create($birthdate), date_create($currentDate));
                            $age = $diff->y;
                        @endphp

                        <div class="text-xs text-gray-500">
                            Age {{ $age }}
                        </div>
                        <div class="text-xs text-gray-500">
                            ID {{ $studentPatient->student->id ?? $studentPatient->employee->id }}
                        </div>
                        <div class="text-xs text-gray-500">
                            @if ($studentPatient->student)
                                <div class="p-2 text-xs bg-orange-600 w-20 text-white rounded-md text-center mt-2">Student
                                </div>
                            @else
                                <div class="p-2 text-xs bg-blue-600 w-20 text-white rounded-md text-center mt-2">Employee
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="m-10">
                <ul class="flex gap-3 text-sm items-center text-blue-950 font-medium">
                    <li id="tab-1" class="tab flex-1 text-center py-2 cursor-pointer active-tab">Patient Information
                    </li>
                    <li id="tab-2" class="tab flex-1 text-center py-2 cursor-pointer ">Medical Information</li>
                    <li id="tab-3" class="tab flex-1 text-center py-2 cursor-pointer ">Consultat ion History</li>
                    @if ($doctor->department == 'physician')
                        <li id="tab-4" class="tab flex-1 text-center py-2 cursor-pointer ">Medical Certificate</li>
                    @endif

                    <!-- Add more tabs as needed -->
                </ul>

                <div class="tab-content" id="tab-content-1">
                    <div class="flex">
                        <div style="width:60%;">
                            <div class="mt-10 text-gray-500 font-medium">
                                Personal info
                            </div>
                            <div class="mt-4 ml-4 text-gray-600 flex" style="width: 60%;">
                                @php
                                    use Carbon\Carbon;
                                    $dateOfBirth = isset($studentPatient->student)
                                        ? $studentPatient->student->date_of_birth
                                        : $studentPatient->employee->date_of_birth;
                                    $formattedDateOfBirth = Carbon::parse($dateOfBirth)->format('d M Y');
                                @endphp
                                <div class="w-80"> Date of Birth</div>
                                <div class="" style="width:60%;">
                                    <div>{{ $formattedDateOfBirth }}</div>
                                </div>
                            </div>
                            <div class="mt-4 ml-4 text-gray-600 flex" style="width: 60%;">
                                <div class="w-80"> Age</div>
                                <div style="width:60%;">
                                    <div>{{ $age }}</div>
                                </div>
                            </div>
                            <div class="mt-4 ml-4 text-gray-600 flex" style="width: 60%;">
                                <div class="w-80"> Gender</div>
                                <div style="width:60%;">
                                    <div>{{ $studentPatient->student->gender ?? $studentPatient->employee->gender }}</div>
                                </div>
                            </div>
                            <div class="mt-4 ml-4 text-gray-600 flex" style="width: 60%;">
                                <div class="w-80"> Civil Status</div>
                                <div style="width:60%;">
                                    <div>
                                        {{ $studentPatient->student->civil_status ?? $studentPatient->employee->civil_status }}
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4 ml-4 text-gray-600 flex" style="width: 60%;">
                                <div class="w-80"> Address</div>
                                <div style="width:60%;">
                                    <div>
                                        {{ $studentPatient->student->permanent_address ?? $studentPatient->employee->permanent_address }}
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4 ml-4 text-gray-600 flex" style="width: 60%;">
                                <div class="w-80"> Email</div>
                                <div style="width:60%;">
                                    <div>
                                        {{ $studentPatient->student->email ?? $studentPatient->employee->email }}
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4 ml-4 text-gray-600 flex" style="width: 60%;">
                                <div class="w-80"> Contact Number</div>
                                <div style="width:60%;">
                                    <div>
                                        {{ $studentPatient->student->contact_number ?? $studentPatient->employee->contact_number }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div style="width: 40%;">
                            @if ($studentPatient->student)
                                <div class="mt-10 text-gray-500 font-medium">
                                    Other info
                                </div>
                                <div class="mt-4 ml-4 text-gray-600 flex" style="width: 60%;">
                                    <div class="w-80"> Department</div>
                                    <div style="width:100%;">
                                        <div>
                                            {{ $studentPatient->student->student_department }}
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-4 ml-4 text-gray-600 flex" style="width: 60%;">
                                    <div class="w-80"> Course</div>
                                    <div style="width:100%;">
                                        <div>
                                            {{ $studentPatient->student->course }}
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-4 ml-4 text-gray-600 flex" style="width: 60%;">
                                    <div class="w-80"> Year</div>
                                    <div style="width:100%;">
                                        <div>
                                            {{ $studentPatient->student->student_level }}
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="mt-10 text-gray-500 font-medium">
                                    Other info
                                </div>
                                <div class="mt-4 ml-4 text-gray-600 flex" style="width: 60%;">
                                    <div class="w-80"> Department</div>
                                    <div style="width:100%;">
                                        <div>
                                            {{ $studentPatient->employee->employee_department }}
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-4 ml-4 text-gray-600 flex" style="width: 60%;">
                                    <div class="w-80"> Course</div>
                                    <div style="width:100%;">
                                        <div>
                                            {{ $studentPatient->employee->employee_position }}
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                </div>

                <div class="tab-content hidden" id="tab-content-2">
                    @foreach ($medicalInfo as $info)
                        <div class="flex justify-between items-center m-5 bg-white rounded shadow overflow-hidden">

                            <div class="p-4 shadow-md">
                                Medical History
                            </div>
                            <div class="text-gray-500 mr-4">
                                MODIFIED <span class="ml-2">{{ $info->updated_at }}</span>
                            </div>
                        </div>
                        <div>
                            <div class="flex justify-center p-7">
                                <div class="text-gray-500" style="width: 33%;">
                                    <div>
                                        <div>
                                            <input type="checkbox" name="illness[]" value="Asthma"
                                                {{ str_contains($info->illness, 'Asthma') ? 'checked' : '' }}><span
                                                class="text-sm ml-5">Asthma</span><br>
                                            <input type="checkbox" name="illness[]" value="Pneumonia"
                                                {{ str_contains($info->illness, 'Pneumonia') ? 'checked' : '' }}><span
                                                class="text-sm ml-5">Pneumonia</span><br>
                                            <input type="checkbox" name="illness[]" value="Diabetes"
                                                {{ str_contains($info->illness, 'Diabetes') ? 'checked' : '' }}><span
                                                class="text-sm ml-5">Diabetes</span><br>
                                            <input type="checkbox" name="illness[]" value="Seizures"
                                                {{ str_contains($info->illness, 'Seizures') ? 'checked' : '' }}><span
                                                class="text-sm ml-5">Seizures</span><br>
                                            <input type="checkbox" name="illness[]"
                                                value="Tubercolosis"{{ str_contains($info->illness, 'Tubercolosis') ? 'checked' : '' }}><span
                                                class="text-sm ml-5">Tubercolosis</span><br>
                                            <input type="checkbox" name="illness[]"
                                                value="Heart Disease"{{ str_contains($info->illness, 'Heart Disease') ? 'checked' : '' }}><span
                                                class="text-sm ml-5">Heart Disease</span><br>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-gray-500" style="width: 33%;">
                                    <input type="checkbox" name="illness[]"
                                        value="Kidney Disease"{{ str_contains($info->illness, 'Kidney Disease') ? 'checked' : '' }}><span
                                        class="text-sm ml-5">Kidney Disease</span><br>
                                    <input type="checkbox" name="illness[]" value="Migraine"
                                        {{ str_contains($info->illness, 'Migraine') ? 'checked' : '' }}><span
                                        class="text-sm ml-5">Migraine</span><br>
                                    <input type="checkbox" name="illness[]" value="Dysmenorrhea"
                                        {{ str_contains($info->illness, 'Dysmenorrhea') ? 'checked' : '' }}><span
                                        class="text-sm ml-5">Dysmenorrhea</span><br>
                                    <input type="checkbox" name="illness[]" value="Mental Illness"
                                        {{ str_contains($info->illness, 'Mental Illness') ? 'checked' : '' }}><span
                                        class="text-sm ml-5">Mental
                                        Illness</span><br>
                                    <input type="checkbox" name="illness[]"
                                        value="Digestive Problem"{{ str_contains($info->illness, 'Digestive Problem') ? 'checked' : '' }}><span
                                        class="text-sm ml-5">Digestive
                                        Problem</span><br>
                                    <input type="checkbox" name="illness[]"
                                        value="Endoctrine Disease"{{ str_contains($info->illness, 'Endoctrine Disease') ? 'checked' : '' }}><span
                                        class="text-sm ml-5">Endoctrine
                                        Disease</span><br>
                                </div>
                                <div class="text-gray-500" style="width: 33%;">
                                    <input type="checkbox" name="illness[]" value=">Sports Injury"
                                        {{ str_contains($info->illness, 'Sports Injury') ? 'checked' : '' }}><span
                                        class="text-sm ml-5">Sports Injury</span><br>
                                    <input type="checkbox" name="illness[]" value="Amoebiasis"
                                        {{ str_contains($info->illness, 'Amoebiasis') ? 'checked' : '' }}><span
                                        class="text-sm ml-5">Amoebiasis</span><br>
                                    <input type="checkbox" id="other" name="illness[]" value="other"
                                        {{ str_contains($info->illness, 'other') ? 'checked' : '' }}><span
                                        class="text-sm ml-5">Others</span><br>
                                    <div class="mt-2 text-gray-500">
                                        <input type="text" name="other_illness" id="other_illness"
                                            class="border text-xs p-2 w-60 outline-none"
                                            value="{{ $info->other_illness }}">
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="p-4">
                            <h1 class="text-gray-500 pt-5">
                                History of Allergy Reaction
                            </h1>
                            <div class="flex gap-3">
                                <div class="mt-2" style="width: 50%;">
                                    <label for="food_allergy" class="text-xs font-light">Food</label>
                                    <input type="text" name="food_allergy" id="food_allergy"
                                        class="w-full border p-2 text-xs mt-2 outline-none text-gray-500"
                                        value="{{ $info->food_allergy }}">
                                </div>
                                <div class="mt-2" style="width: 50%;">
                                    <label for="medicine_allergy" class="text-xs font-light">Medicine</label>
                                    <input type="text" name="medicine_allergy" id="medicine_allergy"
                                        class="w-full border p-2 text-xs mt-2 outline-none text-gray-500"
                                        value="{{ $info->medicine_allergy }}">
                                </div>
                            </div>
                            <div class="flex gap-3">
                                <div class="mt-2" style="width: 50%;">
                                    <label for="insect_bite_allergy" class="text-xs font-light">Insect Bite</label>
                                    <input type="text" name="insect_bite_allergy" id="insect_bite_allergy"
                                        class="w-full border p-2 text-xs mt-2 outline-none text-gray-500"
                                        value="{{ $info->insect_bite_allergy }}">
                                </div>
                                <div class="mt-2" style="width: 50%;">
                                    <label for="other_allergy" class="text-xs font-light">Other</label>
                                    <input type="text" name="other_allergy" id="other_allergy"
                                        class="w-full border p-2 text-xs mt-2 outline-none text-gray-500"
                                        value="{{ $info->other_allergy }}">
                                </div>
                            </div>
                        </div>
                        <div class="bg-white shadow-xl mt-5" style="width:100%;">
                            <div class="p-4">
                                <h1 class="text-gray-500 py-5">
                                    With eye glasses?
                                    <span><input type="checkbox" id="witheyeglasses"></span>
                                </h1>

                                <div class="flex gap-3">
                                    <div class="mt-2" style="width: 50%;">
                                        <label for="vission_of_righteye" class="text-xs font-light">Vision of
                                            right-eye</label>
                                        <input type="text" name="vission_of_righteye" id="vission_of_righteye"
                                            class="w-full border p-2 text-xs mt-2 outline-none text-gray-500"
                                            value="{{ $info->vission_of_righteye }}">
                                    </div>
                                    <div class="mt-2" style="width: 50%;">
                                        <label for="vission_of_lefteye" class="text-xs font-light">Vision of
                                            left-eye</label>
                                        <input type="text" name="vission_of_lefteye" id="vission_of_lefteye"
                                            class="w-full border p-2 text-xs mt-2 outline-none text-gray-500"value="{{ $info->vission_of_lefteye }}">
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="bg-white shadow-xl mt-5" style="width:100%;">
                            <div class="p-4">
                                <h1 class="text-gray-500 py-5">
                                    Blood Pressure and Pulse Rate
                                </h1>

                                <div class="flex gap-3">
                                    <div class="mt-2" style="width: 50%;">
                                        <label for="blood_pressure" class="text-xs font-light">Blood Pressure</label>
                                        <input type="number" name="blood_pressure" id="blood_pressure"
                                            class="w-full border p-2 text-xs mt-2 outline-none text-gray-500"
                                            value="{{ $info->blood_pressure }}">
                                    </div>
                                    <div class="mt-2" style="width: 50%;">
                                        <label for="pulse_rate" class="text-xs font-light">Pulse Rate</label>
                                        <input type="number" name="pulse_rate" id="pulse_rate"
                                            class="w-full border p-2 text-xs mt-2 outline-none text-gray-500"
                                            value="{{ $info->pulse_rate }}">
                                    </div>
                                </div>
                                <div>
                                    <h3 class="text-sm mt-5 text-gray-500">Quick Results</h3>
                                </div>
                                <div class="mt-2">
                                    <label for="blood_pressure_category" class="text-xs font-light">Blood Pressure
                                        Category</label>
                                    <input type="text" name="blood_pressure_category" id="blood_pressure_category"
                                        class="w-full border p-2 text-xs mt-2 outline-none text-gray-500"
                                        value="{{ $info->blood_pressure_category }}" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="bg-white shadow-xl mt-5" style="width:100%;">
                            <div class="p-4">
                                <h1 class="text-gray-500 py-5">
                                    Body temperature
                                </h1>
                                <div class="mt-2">
                                    <label for="body_temperature" class="text-xs font-light">Body Temperature</label>
                                    <input type="number" name="body_temperature" id="body_temperature"
                                        class="w-full border p-2 text-xs mt-2 outline-none text-gray-500"
                                        value="{{ $info->body_temperature }}">
                                </div>
                            </div>
                        </div>

                        <div class="bg-white shadow-xl mt-5" style="width:100%;">
                            <div class="p-4">
                                <h1 class="text-gray-500">
                                    Body Mass Index
                                </h1>
                                <span class="text-xs text-gray-400">(BMI)</span>
                                <div class="flex gap-3">
                                    <div class="mt-2" style="width: 50%;">
                                        <label for="height" class="text-xs font-light">Height <span>(cm)</span></label>
                                        <input type="number" name="height" id="height"
                                            class="w-full border p-2 text-xs mt-2 outline-none text-gray-500"
                                            value="{{ $info->height }}">
                                    </div>
                                    <div class="mt-2" style="width: 50%;">
                                        <label for="weight" class="text-xs font-light">Weight <span>(kg)</span></label>
                                        <input type="number" name="weight" id="weight"
                                            class="w-full border p-2 text-xs mt-2 outline-none text-gray-500"
                                            value="{{ $info->weight }}">
                                    </div>
                                </div>
                                <div>
                                    <h3 class="text-sm mt-5 text-gray-500">Quick Results</h3>
                                </div>
                                <div class="mt-2">
                                    <div class="flex gap-3">
                                        <div style="width: 30%;">
                                            <label for="bodymassindex" class="text-xs font-light">BMI</label>
                                            <input type="text" name="bodymassindex" id="bodymassindex"
                                                class="w-full border p-2 text-xs mt-2 outline-none text-gray-500"
                                                value="{{ $info->bodymassindex }}" disabled>
                                        </div>
                                        <div style="width:70%;">
                                            <label for="bodymassindex_category" class="text-xs font-light">BMI
                                                Category</label>
                                            <input type="text" name="bodymassindex_category"
                                                id="bodymassindex_category"
                                                class="w-full border p-2 text-xs mt-2 outline-none text-gray-500"
                                                value="{{ $info->bodymassindex_category }}" disabled>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="bg-white shadow-xl mt-5" style="width:100%;">
                            <div class="p-4">
                                <h1 class="text-gray-500">
                                    Previous Operation Injuries
                                </h1>
                                <span class="text-xs text-gray-400">(Minor,Medium,Major)</span>
                                <div class="mt-2">
                                    <div class="flex gap-3">
                                        <div style="width: 33%;">
                                            <label for="injurie_status" class="text-xs font-light">Injuries Status</label>
                                            <select type="text" name="injurie_status" id="injurie_status"
                                                class="w-full border p-2 text-xs mt-2 outline-none text-gray-500">
                                                <option
                                                    value="None"{{ $info->injurie_status == 'None' ? 'selected' : '' }}>
                                                    None
                                                </option>
                                                <option
                                                    value="Minor"{{ $info->injurie_status == 'Minor' ? 'selected' : '' }}>
                                                    Minor
                                                </option>
                                                <option
                                                    value="Medium"{{ $info->injurie_status == 'Medium' ? 'selected' : '' }}>
                                                    Medium
                                                </option>
                                                <option
                                                    value="Major"{{ $info->injurie_status == 'Major' ? 'selected' : '' }}>
                                                    Major
                                                </option>
                                            </select>
                                        </div>
                                        <div style="width:33%;">
                                            <label for="dateofinjurie" class="text-xs font-light">Date</label>
                                            <input type="date" name="dateofinjurie" id="dateofinjurie"
                                                class="w-full border p-2 text-xs mt-2 outline-none text-gray-500"
                                                value="{{ $info->dateofinjurie }}">
                                        </div>
                                        <div style="width:33%;">
                                            <label for="name_of_hospital" class="text-xs font-light">Name of
                                                Hospital</label>
                                            <input type="text" name="name_of_hospital" id="name_of_hospital"
                                                class="w-full border p-2 text-xs mt-2 outline-none text-gray-500"
                                                value="{{ $info->name_of_hospital }}">
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="bg-white shadow-xl mt-5" style="width:100%;">
                            <div class="p-4">
                                <h1 class="text-gray-500 pt-5">
                                    Immunization History
                                </h1>
                                <span class="text-xs text-gray-400 font-light">
                                    (Please check)
                                </span>
                                <div class="flex justify-center p-7">
                                    <div class="text-gray-500" style="width: 33%;">
                                        <div>
                                            <div>
                                                <input type="checkbox" name="immunization[]" value="BCG"
                                                    {{ str_contains($info->immunization, 'BCG') ? 'checked' : '' }}><span
                                                    class="text-sm ml-5">BCG</span><br>
                                                <input type="checkbox" name="immunization[]" value="DPT"
                                                    {{ str_contains($info->immunization, 'DPT') ? 'checked' : '' }}><span
                                                    class="text-sm ml-5">DPT</span><br>
                                                <input type="checkbox" name="immunization[]" value="Polio"
                                                    {{ str_contains($info->immunization, 'Polio') ? 'checked' : '' }}><span
                                                    class="text-sm ml-5">Polio</span><br>
                                                <input type="checkbox" name="immunization[]" value="Hepatitis A"
                                                    {{ str_contains($info->immunization, 'Hepatitis A') ? 'checked' : '' }}><span
                                                    class="text-sm ml-5">Hepatitis A</span><br>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-gray-500" style="width: 33%;">
                                        <input type="checkbox" name="immunization[]" value=">Hepatitis B"
                                            {{ str_contains($info->immunization, 'Hepatitis B') ? 'checked' : '' }}><span
                                            class="text-sm ml-5">Hepatitis B</span><br>
                                        <input type="checkbox" name="immunization[]" value="FLU"
                                            {{ str_contains($info->immunization, 'FLU') ? 'checked' : '' }}><span
                                            class="text-sm ml-5">FLU</span><br>
                                        <input type="checkbox" name="immunization[]" value="Measiles"
                                            {{ str_contains($info->immunization, 'Measiles') ? 'checked' : '' }}><span
                                            class="text-sm ml-5">Measiles</span><br>
                                        <input type="checkbox" name="immunization[]" value="Human Papiloma Virus"
                                            {{ str_contains($info->immunization, 'Human Papiloma Virus') ? 'checked' : '' }}><span
                                            class="text-sm ml-5">Human
                                            Papiloma Virus</span><br>
                                    </div>
                                    <div class="text-gray-500" style="width: 33%;">
                                        <input type="checkbox" name="immunization[]" value=">Chicken Fox"
                                            {{ str_contains($info->immunization, 'Chicken Fox') ? 'checked' : '' }}><span
                                            class="text-sm ml-5">Chicken Fox</span><br>
                                        <input type="checkbox" id="other_immunization" name="immunization[]"
                                            value="other"
                                            {{ str_contains($info->immunization, 'other') ? 'checked' : '' }}><span
                                            class="text-sm ml-5">Others</span><br>
                                        <div class="mt-2 text-gray-500">
                                            <input type="text" name="other_immunization"
                                                id="other_immunization_textbox"
                                                class="border text-xs p-2 w-60 outline-none"
                                                value="{{ $info->other_immunization }}">
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white shadow-xl mt-5" style="width:100%;">
                            <div class="p-4">
                                <h1 class="text-gray-500 pt-5">
                                    Family History
                                </h1>
                                <span class="text-xs text-gray-400 font-light">
                                    (Please check)</span>
                                <div class="flex justify-center p-7">
                                    <div class="text-gray-500" style="width: 33%;">
                                        <div>
                                            <div>
                                                <input type="checkbox" name="familyhistory[]" value="Cancer"
                                                    {{ str_contains($info->familyhistory, 'Cancer') ? 'checked' : '' }}><span
                                                    class="text-sm ml-5">Cancer</span><br>
                                                <input type="checkbox" name="familyhistory[]" value="Hypertension"
                                                    {{ str_contains($info->familyhistory, 'Hypertension') ? 'checked' : '' }}><span
                                                    class="text-sm ml-5">Hypertension</span><br>
                                                <input type="checkbox" name="familyhistory[]" value="Tuberculosis"
                                                    {{ str_contains($info->familyhistory, 'Tuberculosis') ? 'checked' : '' }}><span
                                                    class="text-sm ml-5">Tuberculosis</span><br>
                                                <input type="checkbox" name="familyhistory[]" value="Diabetes"
                                                    {{ str_contains($info->familyhistory, 'Diabetes') ? 'checked' : '' }}><span
                                                    class="text-sm ml-5">Diabetes</span><br>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-gray-500" style="width: 33%;">
                                        <input type="checkbox" name="familyhistory[]" value=">Kidney Disease"
                                            {{ str_contains($info->familyhistory, 'Kidney Disease') ? 'checked' : '' }}><span
                                            class="text-sm ml-5">Kidney Disease</span><br>
                                        <input type="checkbox" name="familyhistory[]" value="Goiter"
                                            {{ str_contains($info->familyhistory, 'Goiter') ? 'checked' : '' }}><span
                                            class="text-sm ml-5">Goiter</span><br>
                                        <input type="checkbox" name="familyhistory[]" value="Asthma"
                                            {{ str_contains($info->familyhistory, 'Asthma') ? 'checked' : '' }}><span
                                            class="text-sm ml-5">Asthma</span><br>
                                        <input type="checkbox" name="familyhistory[]" value="Allergy"
                                            {{ str_contains($info->familyhistory, 'Allergy') ? 'checked' : '' }}><span
                                            class="text-sm ml-5">Allergy</span><br>
                                    </div>
                                    <div class="text-gray-500" style="width: 33%;">
                                        <input type="checkbox" name="familyhistory[]" value=">Febrile Convulsion"
                                            {{ str_contains($info->familyhistory, 'Febrile Convulsion') ? 'checked' : '' }}><span
                                            class="text-sm ml-5">Febrile Convulsion</span><br>
                                        <input type="checkbox" name="familyhistory[]" value=">Epilepsy"
                                            {{ str_contains($info->familyhistory, 'Epilepsy') ? 'checked' : '' }}><span
                                            class="text-sm ml-5">Epilepsy</span><br>
                                        <input type="checkbox" id="other_familyhistory" name="familyhistory[]"
                                            value="other"
                                            {{ str_contains($info->familyhistory, 'other') ? 'checked' : '' }}><span
                                            class="text-sm ml-5">Others</span><br>
                                        <div class="mt-2 text-gray-500">
                                            <input type="text" name="other_familyhistory"
                                                id="other_familyhistory_textbox"
                                                class="border text-xs p-2 w-60 outline-none"
                                                value="{{ $info->other_familyhistory }}">
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="tab-content hidden" id="tab-content-3">

                    <div class="flex justify-between items-center my-10">
                        <div class="text-gray-500">
                            Consultation History
                        </div>

                        @if ($doctor->department == 'dentist')
                            <div>
                                <a href="/doctor_index/testPatientWalkinDental/{{ $studentPatient->id }}"
                                    class="text-xs p-3 bg-blue-900 rounded-sm text-white">Add Consultation</a>
                            </div>
                        @elseif($doctor->department == 'physician')
                            <div>
                                <a href="/doctor_index/testPatientWalkin/{{ $studentPatient->id }}"
                                    class="text-xs p-3 bg-blue-900 rounded-sm text-white">Add Consultation</a>
                            </div>
                        @endif

                    </div>
                    <!-- Table -->
                    <table class="min-w-full border text-left text-xs shadow-xl whitespace-nowrap tableContainer"
                        id="constultationHistoryTable">

                        <!-- Table head -->
                        <thead class="uppercase tracking-wider border-b-2 dark:border-neutral-600 border-t ">
                            <tr class="text-[#00ACBA]">
                                <th scope="col" class="px-6 py-4 border-x dark:border-neutral-600">
                                    Id
                                </th>
                                <th scope="col" class="px-6 py-4 border-x dark:border-neutral-600">
                                    Consultation Method
                                </th>
                                <th scope="col" class="px-6 py-4 border-x dark:border-neutral-600">
                                    Date
                                </th>
                                <th scope="col" class="px-6 py-4 border-x dark:border-neutral-600">
                                    Time-in
                                </th>
                                <th scope="col" class="px-6 py-4 border-x dark:border-neutral-600">
                                    Time-Out
                                </th>
                                <th scope="col" class="px-6 py-4 border-x dark:border-neutral-600">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <!-- Table body -->
                        <tbody>
                            @if ($doctor->department == 'dentist')
                                @foreach ($dentalconsultationInfo as $consultInfo)
                                    <tr>
                                        <th scope="row"
                                            class="px-6 py-4 border-x dark:border-neutral-600 text-left border-b-2">
                                            {{ $consultInfo->id }}
                                        </th>
                                        <th scope="row"
                                            class="px-6 py-4 border-x dark:border-neutral-600 text-left border-b-2">
                                            {{ $consultInfo->consultation_method }}
                                        </th>
                                        <th scope="row"
                                            class="px-6 py-4 border-x dark:border-neutral-600 text-left border-b-2">
                                            {{ $consultInfo->created_at->format('Y-m-d') }}
                                        </th>
                                        <th scope="row"
                                            class="px-6 py-4 border-x dark:border-neutral-600 text-left border-b-2">
                                            {{ $consultInfo->created_at->format('h:i:s A') }}

                                        </th>
                                        <th scope="row"
                                            class="px-6 py-4 border-x dark:border-neutral-600 text-left border-b-2">
                                            {{ \Carbon\Carbon::parse($consultInfo->timeout)->format('h:i:s A') }}

                                        </th>
                                        <th scope="row"
                                            class="px-6 py-4 border-x dark:border-neutral-600 text-left border-b-2">
                                            <a href="/update_dentalconsultation_walkin/{{ $consultInfo->id }}"
                                                class="p-2 text-xs bg-blue-500 text-white">View/Update</a>
                                        </th>

                                    </tr>
                                @endforeach
                            @elseif ($doctor->department == 'physician')
                                @foreach ($medicalconsultationInfo as $consultInfo)
                                    <tr>
                                        <th scope="row"
                                            class="px-6 py-4 border-x dark:border-neutral-600 text-left border-b-2">
                                            {{ $consultInfo->id }}
                                        </th>
                                        <th scope="row"
                                            class="px-6 py-4 border-x dark:border-neutral-600 text-left border-b-2">
                                            {{ $consultInfo->consultation_method }}
                                        </th>
                                        <th scope="row"
                                            class="px-6 py-4 border-x dark:border-neutral-600 text-left border-b-2">
                                            {{ $consultInfo->created_at->format('Y-m-d') }}
                                        </th>
                                        <th scope="row"
                                            class="px-6 py-4 border-x dark:border-neutral-600 text-left border-b-2">
                                            {{ $consultInfo->created_at->format('h:i:s A') }}

                                        </th>
                                        <th scope="row"
                                            class="px-6 py-4 border-x dark:border-neutral-600 text-left border-b-2">
                                            {{ \Carbon\Carbon::parse($consultInfo->timeout)->format('h:i:s A') }}

                                        </th>
                                        <th scope="row"
                                            class="px-6 py-4 border-x dark:border-neutral-600 text-left border-b-2">
                                            <a href="/update_medicalconsultation_walkin/{{ $consultInfo->id }}"
                                                class="p-2 text-xs bg-blue-500 text-white">View/Update</a>
                                        </th>

                                    </tr>
                                @endforeach
                            @endif
                        </tbody>

                    </table>

                </div>
                <div class="tab-content hidden" id="tab-content-4">
                    <div class="py-5 text-center font-medium">
                        Medical Certificate
                    </div>
                    <div>
                        <div class="flex justify-between m-3 items-center">
                            <div class="py-5 font-medium text-gray-500">
                                Absence Medical <span>(Sick/Leave)</span>
                            </div>
                            <div>
                                <a href="/medical_cert_sickleave_form/{{ $studentPatient->id }}"
                                    class="text-xs p-2 bg-blue-950 text-white">Add Certificate</a>
                            </div>
                        </div>
                        <table class="min-w-full border text-left text-xs shadow-xl whitespace-nowrap tableContainer"
                            id="sickleaveTable">

                            <!-- Table head -->
                            <thead class="uppercase tracking-wider border-b-2 dark:border-neutral-600 border-t ">
                                <tr class="text-[#00ACBA]">
                                    <th scope="col" class="px-6 py-4 border-x dark:border-neutral-600">
                                        Certificate No
                                    </th>
                                    <th scope="col" class="px-6 py-4 border-x dark:border-neutral-600">
                                        Absent From
                                    </th>
                                    <th scope="col" class="px-6 py-4 border-x dark:border-neutral-600">
                                        Absent TO
                                    </th>
                                    <th scope="col" class="px-6 py-4 border-x dark:border-neutral-600">
                                       Date Issue
                                    </th>
                                    <th scope="col" class="px-6 py-4 border-x dark:border-neutral-600">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <!-- Table body -->
                            <tbody>
                                @foreach ($sickleavemedicalcertificate as $cert)
                                    <tr>
                                        <th scope="row"
                                            class="px-6 py-4 border-x dark:border-neutral-600 text-left border-b-2">
                                            {{ $cert->certificateID }}
                                        </th>
                                        <th scope="row"
                                            class="px-6 py-4 border-x dark:border-neutral-600 text-left border-b-2">
                                            {{ $cert->absent_from }}
                                        </th>
                                        <th scope="row"
                                            class="px-6 py-4 border-x dark:border-neutral-600 text-left border-b-2">
                                            {{ $cert->absent_to }}
                                        </th>
                                        <th scope="row"
                                            class="px-6 py-4 border-x dark:border-neutral-600 text-left border-b-2">
                                            {{ $cert->date_issue }}
                                        </th>
                                        <th scope="row"
                                            class="px-6 py-4 border-x dark:border-neutral-600 text-left border-b-2">
                                           <a href="#">Print</a>
                                        </th>

                                    </tr>
                                @endforeach
                            </tbody>

                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .active-tab {
            border-bottom: 3px solid rgb(27, 189, 214);
        }
    </style>
    <script>
        $(document).ready(function() {

            $("#sickleaveTable").dataTable();

            $("#constultationHistoryTable").dataTable();
            $(".tab").click(function() {
                $(".tab").removeClass("active-tab");
                $(this).addClass("active-tab");
                $(".tab-content").addClass("hidden");

                var tabId = $(this).attr("id");
                var tabNumber = tabId.split("-")[1];

                $("#tab-content-" + tabNumber).removeClass("hidden");
                sessionStorage.setItem("activeTabId", tabNumber);
            });

            var activeTabId = sessionStorage.getItem("activeTabId");
            if (activeTabId) {

                $(".tab").removeClass("active-tab");
                $("#tab-" + activeTabId).addClass("active-tab");
                $(".tab-content").addClass("hidden");
                $("#tab-content-" + activeTabId).removeClass("hidden");
            }
        })
    </script>
@endsection
