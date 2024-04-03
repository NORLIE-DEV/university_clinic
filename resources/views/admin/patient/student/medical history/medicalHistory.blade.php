@extends('layout.admin_layout')

@section('content')
    <div class="bg-white shadow p-10" style="width:98%; height:auto; margin:10px auto;">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-medium text-blue-950"><i class="fa-solid fa-notes-medical"></i>MEDICAL HISTORY</h1>
            </div>
            <div class="gap-5 flex">
                <div>
                    <a href="/admin_patient_info/{{ $patientsInfo->id }}"><button><i
                                class="fa-solid fa-arrow-left"></i></button></a>
                </div>
                <div>
                    <a href="#"><button><i class="fa-solid fa-pen-to-square"></i></button></a>
                </div>
                <div>
                    <a href="#"><button><i class="fa-solid fa-download"></i></button></a>
                </div>
            </div>
        </div>
        {{-- patient information --}}
        {{-- <div class="mt-5">
            <div>
                <span class="font-light">Patient Name : <span
                        class="text-blue-950 font-semibold">{{ $patientsInfo->student->first_name }}
                        {{ $patientsInfo->student->middle_name }}
                        {{ $patientsInfo->student->last_name }}</span></span>
            </div>
            <div>
                <span class="font-light">Date of Birth : <span class="text-blue-950 font-semibold">
                        {{ $patientsInfo->student->date_of_birth }}
                    </span></span>
            </div>
            <div>
                <span class="font-light">Gender : <span class="text-blue-950 font-semibold">
                        {{ $patientsInfo->student->gender }}
                    </span></span>
            </div>
            <div>
                <span class="font-light">Address : <span class="text-blue-950 font-semibold">
                        {{ $patientsInfo->student->permanent_address }}
                    </span></span>
            </div>
            <div>
                <span class="font-light">Phone Number : <span class="text-blue-950 font-semibold">
                        {{ $patientsInfo->student->contact_number }}
                    </span></span>
            </div>
        </div> --}}

        {{-- Guardian --}}
        @if ($hasMedicalHistory)
            @foreach ($medicalHistory as $history)
                <form action="/medicalhistory/{{ $history->id }}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="mt-10 text-lg bg-blue-950 p-3 text-white">
                        <h1>Past History</h1>
                    </div>
                    <div class="w-full h-auto bg-white shadow">
                        <div class="relative overflow-hidden shadow-md rounded-lg mt-5">
                            <h1 class="p-2 mt-5 ml-10 text-center text-xl font-medium">illness</h1>
                            <hr style="width:90%; margin: 0 auto; border:1px solid gray;">
                            <div class="flex justify-center ml-14 mb-5" id="illness">
                                <div style="width: 50%;">

                                    <div class="ml-10 mt-5">
                                        <input type="checkbox" name="illness[]" value="Asthma"
                                            {{ str_contains($history->illness, 'Asthma') ? 'checked' : '' }}>
                                        <span class="text-sm">Asthma</span>
                                    </div>
                                    <div class="ml-10 mt-5">
                                        <input type="checkbox" name="illness[]" value="Chicken Fox"
                                            {{ str_contains($history->illness, 'Chicken Fox') ? 'checked' : '' }}>
                                        <span class="text-sm">Chicken Fox</span>
                                    </div>
                                    <div class="ml-10 mt-5">
                                        <input type="checkbox" name="illness[]"
                                            value="Chronic Ear Infections or Otitis Media"
                                            {{ str_contains($history->illness, 'Chronic Ear Infections or Otitis Media') ? 'checked' : '' }}>
                                        <span class="text-sm">Chronic Ear Infections or Otitis Media</span>
                                    </div>
                                    <div class="ml-10 mt-5">
                                        <input type="checkbox" name="illness[]" value="Diabetes"
                                            {{ str_contains($history->illness, 'Diabetes') ? 'checked' : '' }}>
                                        <span class="text-sm">Diabetes</span>
                                    </div>
                                    <div class="ml-10 mt-5">
                                        <input type="checkbox" name="illness[]" value="Epilepsy"
                                            {{ str_contains($history->illness, 'Epilepsy') ? 'checked' : '' }}>
                                        <span class="text-sm">Epilepsy</span>
                                    </div>
                                    <div class="ml-10 mt-5">
                                        <input type="checkbox" name="illness[]" value="Fainting Spells"
                                            {{ str_contains($history->illness, 'Fainting Spells') ? 'checked' : '' }}>
                                        <span class="text-sm">Fainting Spells</span>
                                    </div>
                                    <div class="ml-10 mt-5">
                                        <input type="checkbox" name="illness[]" value="Febrile Convulsions"
                                            {{ str_contains($history->illness, 'Febrile Convulsions') ? 'checked' : '' }}>
                                        <span class="text-sm">Febrile Convulsions</span>
                                    </div>
                                    <div class="ml-10 mt-5">
                                        <input type="checkbox" name="illness[]" value="Heart Disorder"
                                            {{ str_contains($history->illness, 'Heart Disorder') ? 'checked' : '' }}>
                                        <span class="text-sm">Heart Disorder</span>
                                    </div>
                                    <div class="ml-10 mt-5">
                                        <input type="checkbox" name="illness[]" value="Hepatitis A"
                                            {{ str_contains($history->illness, 'Hepatitis A') ? 'checked' : '' }}>
                                        <span class="text-sm">Hepatitis A</span>
                                    </div>
                                    <div class="ml-10 mt-5">
                                        <input type="checkbox" name="illness[]" value="Hepatitis B"
                                            {{ str_contains($history->illness, 'Hepatitis B') ? 'checked' : '' }}>
                                        <span class="text-sm">Hepatitis B</span>
                                    </div>

                                </div>
                                <div style="width: 50%;">
                                    <div class="ml-10 mt-5">
                                        <input type="checkbox" name="illness[]" value="Measles"
                                            {{ str_contains($history->illness, 'Measles') ? 'checked' : '' }}>
                                        <span class="text-sm">Measles</span>
                                    </div>
                                    <div class="ml-10 mt-5">
                                        <input type="checkbox" name="illness[]" value="Meningitis"
                                            {{ str_contains($history->illness, 'Meningitis') ? 'checked' : '' }}>
                                        <span class="text-sm">Meningitis</span>
                                    </div>
                                    <div class="ml-10 mt-5">
                                        <input type="checkbox" name="illness[]" value="Mumps"
                                            {{ str_contains($history->illness, 'Mumps') ? 'checked' : '' }}>
                                        <span class="text-sm">Mumps</span>
                                    </div>
                                    <div class="ml-10 mt-5">
                                        <input type="checkbox" name="illness[]" value="Primary Complex"
                                            {{ str_contains($history->illness, 'Primary Complex') ? 'checked' : '' }}>
                                        <span class="text-sm">Primary Complex</span>
                                    </div>
                                    <div class="ml-10 mt-5">
                                        <input type="checkbox" name="illness[]" value="Rubella"
                                            {{ str_contains($history->illness, 'Rubella') ? 'checked' : '' }}>
                                        <span class="text-sm">Rubella</span>
                                    </div>
                                    <div class="ml-10 mt-5">
                                        <input type="checkbox" name="illness[]" value="Scoliosis"
                                            {{ str_contains($history->illness, 'Scoliosis') ? 'checked' : '' }}>
                                        <span class="text-sm">Scoliosis</span>
                                    </div>
                                    <div class="ml-10 mt-5">
                                        <input type="checkbox" name="illness[]"
                                            value="Skin Problems"{{ str_contains($history->illness, 'Skin Problems') ? 'checked' : '' }}>
                                        <span class="text-sm">Skin
                                            Problems</span>
                                    </div>
                                    <div class="ml-10 mt-5">
                                        <input type="checkbox" name="illness[]" value="Urinary Tract Infections"
                                            {{ str_contains($history->illness, 'Urinary Tract Infections') ? 'checked' : '' }}>
                                        <span class="text-sm">Urinary Tract Infections</span>
                                    </div>
                                    <div class="ml-10 mt-5">
                                        <input type="checkbox" name="illness[]" value=">Whooping Cough"
                                            {{ str_contains($history->illness, '>Whooping Cough') ? 'checked' : '' }}>
                                        <span class="text-sm">Whooping Cough</span>
                                    </div>

                                    <div class="ml-10 mt-5">
                                        <label for="other_illness">Other_illness : </label>
                                        <input type="text" name="other_illness" id="other_illness"
                                            value="{{ $history->other_illness }}"
                                            class="border text-xs p-2 outline-none">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="w-full bg-white shadow h-auto">
                        <h1 class="ml-5 text-md text-gray-500 font-medium mt-5">Please indicate if the patient has any
                            allergies
                        </h1>
                        <div class="w-full px-10 mt-5">
                            <label for="food_allergy" class="text-sm">Food</label>
                            <input type="text" name="food_allergy" id="food_allergy"
                                class="border p-2 text-xs outline-none" style="width:100%;"
                                value="{{ $history->food_allergy }}">
                        </div>
                        <div class="w-full px-10 mt-2">
                            <label for="medicine_allergy" class="text-sm">Medicine</label>
                            <input type="text" name="medicine_allergy" id="medicine_allergy"
                                class="border p-2 text-xs outline-none" style="width:100%;"
                                value="{{ $history->medicine_allergy }}">
                        </div>
                        <div class="w-full px-10 mt-2 pb-10">
                            <label for="other_allergy" class="text-sm">Others</label>
                            <input type="text" name="other_allergy" id="other_allergy"
                                class="border p-2 text-xs outline-none" style="width:100%;"
                                value="{{ $history->other_allergy }}">
                        </div>
                    </div>

                    <div class="mb-10 mt-3">
                        <input type="submit" value="Update Medical Info"
                            class="float-right bg-blue-950 text-xs text-white p-2 mb-4 mt-2">
                    </div>
                </form>
            @endforeach
        @else
            <form id="medicalHistoryForm" action="#">
                <div class="hidden">
                    <input type="text" name="patient_id" id="patient_id" value="{{ $patientsInfo->id }}">
                </div>
                <div class="mt-10 text-lg bg-blue-950 p-3 text-white">
                    <h1>Parent / Guardian Information</h1>
                </div>
                <div class=" w-full bg-white shadow mb-2" style="">
                    <h1 class="mt-5 ml-5 text-md text-gray-500 font-medium">Parent Information</h1>
                    <div class="flex justify-around gap-3 p-5">
                        {{-- father --}}
                        <div class="bg-white shadow p-5" style="width: 45%;">
                            <div>
                                Father
                            </div>
                            <div class="flex mt-3 p-1 gap-3">
                                <label for="father_first_name" class="text-sm" style="width: 30%;">First Name :</label>
                                <input type="text" name="father_first_name" id="father_first_name"
                                    class="border p-2 text-xs outline-none" style="width:70%;">
                            </div>
                            <div class="flex mt-3 p-1 gap-3">
                                <label for="father_middle_name" class="text-sm" style="width: 30%;">Middle Name:</label>
                                <input type="text" name="father_middle_name" id="father_middle_name"
                                    class="border p-2 text-xs outline-none" style="width:70%;">
                            </div>
                            <div class="flex mt-3 p-1 gap-3">
                                <label for="father_last_name" class="text-sm" style="width: 30%;">Last Name :</label>
                                <input type="text" name="father_last_name" id="father_last_name"
                                    class="border p-2 text-xs outline-none" style="width:70%;">
                            </div>
                            <div class="flex mt-3 p-1 gap-3">
                                <label for="father_cp_number" class="text-sm" style="width: 30%;">CP Number :</label>
                                <input type="text" name="father_cp_number" id="father_cp_number"
                                    class="border p-2 text-xs outline-none" style="width:70%;">
                            </div>
                            <div class="flex mt-3 p-1 gap-3">
                                <label for="father_email" class="text-sm" style="width: 30%;">Email :</label>
                                <input type="email" name="father_email" id="father_email"
                                    class="border p-2 text-xs outline-none" style="width:70%;">
                            </div>
                        </div>
                        {{-- mother --}}
                        <div class="bg-white shadow p-5" style="width: 45%;">
                            <div>
                                Mother
                            </div>
                            <div class="flex mt-3 p-1 gap-3">
                                <label for="mother_first_name" class="text-sm" style="width: 30%;">First Name :</label>
                                <input type="text" name="mother_first_name" id="mother_first_name"
                                    class="border p-2 text-xs outline-none" style="width:70%;">
                            </div>
                            <div class="flex mt-3 p-1 gap-3">
                                <label for="mother_middle_name" class="text-sm" style="width: 30%;">Middle Name:</label>
                                <input type="text" name="mother_middle_name" id="mother_middle_name"
                                    class="border p-2 text-xs outline-none" style="width:70%;">
                            </div>
                            <div class="flex mt-3 p-1 gap-3">
                                <label for="mother_last_name" class="text-sm" style="width: 30%;">Last Name :</label>
                                <input type="text" name="mother_last_name" id="mother_last_name"
                                    class="border p-2 text-xs outline-none" style="width:70%;">
                            </div>
                            <div class="flex mt-3 p-1 gap-3">
                                <label for="mother_cp_number" class="text-sm" style="width: 30%;">CP Number :</label>
                                <input type="text" name="mother_cp_number" id="mother_cp_number"
                                    class="border p-2 text-xs outline-none" style="width:70%;">
                            </div>
                            <div class="flex mt-3 p-1 gap-3">
                                <label for="mother_email" class="text-sm" style="width: 30%;">Email :</label>
                                <input type="email" name="mother_email" id="mother_email"
                                    class="border p-2 text-xs outline-none" style="width:70%;">
                            </div>
                        </div>

                    </div>
                </div>

                {{-- emergency contact --}}
                <div class="w-full bg-white shadow h-48">
                    <h1 class="ml-5 text-md text-gray-500 font-medium mt-5 py-3">Emergency Contact Information</h1>
                    <div class="w-full px-10 mt-2">
                        <label for="emergency_contact_name" class="text-sm">Name</label>
                        <input type="text" name="emergency_contact_name" id="emergency_contact_name"
                            class="border p-2 text-xs outline-none" style="width:100%;">
                    </div>
                    <div class="w-full px-10 mt-2">
                        <label for="emergency_contact_number" class="text-sm">Contact Number</label>
                        <input type="text" name="emergency_contact_number" id="emergency_contact_number"
                            class="border p-2 text-xs outline-none" style="width:100%;">
                    </div>
                </div>

                <div class="mt-10 text-lg bg-blue-950 p-3 text-white">
                    <h1>Past History</h1>
                </div>
                <div class="w-full h-auto bg-white shadow">
                    <div class="relative overflow-hidden shadow-md rounded-lg mt-5">
                        <h1 class="p-2 mt-5 ml-10 text-center text-xl font-medium">illness</h1>
                        <hr style="width:90%; margin: 0 auto; border:1px solid gray;">
                        <div class="flex justify-center ml-14 mb-5" id="illness">
                            <div style="width: 50%;">
                                <div class="ml-10 mt-5">
                                    <input type="checkbox" name="illness[]" value="Asthma"> <span
                                        class="text-sm">Asthma</span>
                                </div>
                                <div class="ml-10 mt-5">
                                    <input type="checkbox" name="illness[]" value="Chicken Fox"> <span
                                        class="text-sm">Chicken
                                        Fox</span>
                                </div>
                                <div class="ml-10 mt-5">
                                    <input type="checkbox" name="illness[]"
                                        value="Chronic Ear Infections or Otitis Media">
                                    <span class="text-sm">Chronic Ear
                                        Infections or Otitis
                                        Media</span>
                                </div>
                                <div class="ml-10 mt-5">
                                    <input type="checkbox" name="illness[]" value="Diabetes"> <span
                                        class="text-sm">Diabetes</span>
                                </div>
                                <div class="ml-10 mt-5">
                                    <input type="checkbox" name="illness[]" value="Epilepsy"> <span
                                        class="text-sm">Epilepsy</span>
                                </div>
                                <div class="ml-10 mt-5">
                                    <input type="checkbox" name="illness[]" value="Fainting Spells"> <span
                                        class="text-sm">Fainting Spells</span>
                                </div>
                                <div class="ml-10 mt-5">
                                    <input type="checkbox" name="illness[]" value="Febrile Convulsions"> <span
                                        class="text-sm">Febrile Convulsions</span>
                                </div>
                                <div class="ml-10 mt-5">
                                    <input type="checkbox" name="illness[]" value="Heart Disorder"> <span
                                        class="text-sm">Heart
                                        Disorder</span>
                                </div>
                                <div class="ml-10 mt-5">
                                    <input type="checkbox" name="illness[]" value="Hepatitis A"> <span
                                        class="text-sm">Hepatitis
                                        A</span>
                                </div>
                                <div class="ml-10 mt-5">
                                    <input type="checkbox" name="illness[]" value="Hepatitis B"> <span
                                        class="text-sm">Hepatitis
                                        B</span>
                                </div>

                            </div>
                            <div style="width: 50%;">
                                <div class="ml-10 mt-5">
                                    <input type="checkbox" name="illness[]" value="Measles"> <span
                                        class="text-sm">Measles</span>
                                </div>
                                <div class="ml-10 mt-5">
                                    <input type="checkbox" name="illness[]" value="Meningitis"> <span
                                        class="text-sm">Meningitis</span>
                                </div>
                                <div class="ml-10 mt-5">
                                    <input type="checkbox" name="illness[]" value="Mumps"> <span
                                        class="text-sm">Mumps</span>
                                </div>
                                <div class="ml-10 mt-5">
                                    <input type="checkbox" name="illness[]" value="Primary Complex"> <span
                                        class="text-sm">Primary Complex</span>
                                </div>
                                <div class="ml-10 mt-5">
                                    <input type="checkbox" name="illness[]" value="Rubella"> <span
                                        class="text-sm">Rubella</span>
                                </div>
                                <div class="ml-10 mt-5">
                                    <input type="checkbox" name="illness[]" value="Scoliosis"> <span
                                        class="text-sm">Scoliosis</span>
                                </div>
                                <div class="ml-10 mt-5">
                                    <input type="checkbox" name="illness[]" value="Skin Problems"> <span
                                        class="text-sm">Skin
                                        Problems</span>
                                </div>
                                <div class="ml-10 mt-5">
                                    <input type="checkbox" name="illness[]" value="Urinary Tract Infections"> <span
                                        class="text-sm">Urinary Tract Infections</span>
                                </div>
                                <div class="ml-10 mt-5">
                                    <input type="checkbox" name="illness[]" value=">Whooping Cough"><span
                                        class="text-sm">Whooping Cough</span>
                                </div>
                                <div class="ml-10 mt-5">
                                    <label for="other_illness">Other_illness : </label>
                                    <input type="text" name="other_illness" id="other_illness"
                                        class="border text-xs p-2 outline-none">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="w-full bg-white shadow h-auto">
                    <h1 class="ml-5 text-md text-gray-500 font-medium mt-5">Please indicate if the patient has any
                        allergies
                    </h1>
                    <div class="w-full px-10 mt-5">
                        <label for="food_allergy" class="text-sm">Food</label>
                        <input type="text" name="food_allergy" id="food_allergy"
                            class="border p-2 text-xs outline-none" style="width:100%;">
                    </div>
                    <div class="w-full px-10 mt-2">
                        <label for="medicine_allergy" class="text-sm">Medicine</label>
                        <input type="text" name="medicine_allergy" id="medicine_allergy"
                            class="border p-2 text-xs outline-none" style="width:100%;">
                    </div>
                    <div class="w-full px-10 mt-2 pb-10">
                        <label for="other_allergy" class="text-sm">Others</label>
                        <input type="text" name="other_allergy" id="other_allergy"
                            class="border p-2 text-xs outline-none" style="width:100%;">
                    </div>
                </div>
                <div class="pb-10">
                    <input type="submit"
                        class="float-right p-3 text-xs bg-blue-950 mt-5 text-white shadow rounded-lg w-24">
                </div>
    </div>

    </form>
    @endif
    </div>

    <script src="{{ asset('asset/js/medicalHistory/medicalHistory.js') }}"></script>
@endsection
