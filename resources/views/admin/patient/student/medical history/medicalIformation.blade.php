@extends('layout.admin_layout')

@section('content')
    <div class="bg-white shadow p-10" style="width:98%; height:auto; margin:10px auto;">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-xl font-medium text-blue-950"><i class="fa-solid fa-notes-medical"></i>MEDICAL INFORMATION
                </h1>
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
        @if ($hasMedicalInfo)
            @foreach ($medicalInfo as $details)
                <form action="/medicalinfo/{{ $details->id }}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="hidden">
                        <input type="text" name="patient_id" id="patient_id" value="{{ $patientsInfo->id }}">
                    </div>
                    <div class="text-xs mt-2 font-light text-gray-500">
                        Last Modified : <span>{{$details->updated_at}}</span>
                    </div>
                    <div class="mt-10">


                        <div class="bg-white shadow-xl mt-5" style="width:100%;">
                            <div class="p-4">
                                <h1 class="text-gray-500 pt-5">
                                    Medical History

                                </h1>
                                <span class="text-xs text-gray-400 font-light">Have you ever had any of the following
                                    illness?
                                    (Please check)
                                </span>
                                <div class="flex justify-center p-7">
                                    <div class="text-gray-500" style="width: 33%;">
                                        <div>
                                            <div>
                                                <input type="checkbox" name="illness[]" value="Asthma"
                                                    {{ str_contains($details->illness, 'Asthma') ? 'checked' : '' }}><span
                                                    class="text-sm ml-5">Asthma</span><br>
                                                <input type="checkbox" name="illness[]" value="Pneumonia"
                                                    {{ str_contains($details->illness, 'Pneumonia') ? 'checked' : '' }}><span
                                                    class="text-sm ml-5">Pneumonia</span><br>
                                                <input type="checkbox" name="illness[]" value="Diabetes"
                                                    {{ str_contains($details->illness, 'Diabetes') ? 'checked' : '' }}><span
                                                    class="text-sm ml-5">Diabetes</span><br>
                                                <input type="checkbox" name="illness[]" value="Seizures"
                                                    {{ str_contains($details->illness, 'Seizures') ? 'checked' : '' }}><span
                                                    class="text-sm ml-5">Seizures</span><br>
                                                <input type="checkbox" name="illness[]"
                                                    value="Tubercolosis"{{ str_contains($details->illness, 'Tubercolosis') ? 'checked' : '' }}><span
                                                    class="text-sm ml-5">Tubercolosis</span><br>
                                                <input type="checkbox" name="illness[]"
                                                    value="Heart Disease"{{ str_contains($details->illness, 'Heart Disease') ? 'checked' : '' }}><span
                                                    class="text-sm ml-5">Heart Disease</span><br>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-gray-500" style="width: 33%;">
                                        <input type="checkbox" name="illness[]"
                                            value="Kidney Disease"{{ str_contains($details->illness, 'Kidney Disease') ? 'checked' : '' }}><span
                                            class="text-sm ml-5">Kidney Disease</span><br>
                                        <input type="checkbox" name="illness[]" value="Migraine"
                                            {{ str_contains($details->illness, 'Migraine') ? 'checked' : '' }}><span
                                            class="text-sm ml-5">Migraine</span><br>
                                        <input type="checkbox" name="illness[]" value="Dysmenorrhea"
                                            {{ str_contains($details->illness, 'Dysmenorrhea') ? 'checked' : '' }}><span
                                            class="text-sm ml-5">Dysmenorrhea</span><br>
                                        <input type="checkbox" name="illness[]" value="Mental Illness"
                                            {{ str_contains($details->illness, 'Mental Illness') ? 'checked' : '' }}><span
                                            class="text-sm ml-5">Mental
                                            Illness</span><br>
                                        <input type="checkbox" name="illness[]"
                                            value="Digestive Problem"{{ str_contains($details->illness, 'Digestive Problem') ? 'checked' : '' }}><span
                                            class="text-sm ml-5">Digestive
                                            Problem</span><br>
                                        <input type="checkbox" name="illness[]"
                                            value="Endoctrine Disease"{{ str_contains($details->illness, 'Endoctrine Disease') ? 'checked' : '' }}><span
                                            class="text-sm ml-5">Endoctrine
                                            Disease</span><br>
                                    </div>
                                    <div class="text-gray-500" style="width: 33%;">
                                        <input type="checkbox" name="illness[]" value=">Sports Injury"
                                            {{ str_contains($details->illness, 'Sports Injury') ? 'checked' : '' }}><span
                                            class="text-sm ml-5">Sports Injury</span><br>
                                        <input type="checkbox" name="illness[]" value="Amoebiasis"
                                            {{ str_contains($details->illness, 'Amoebiasis') ? 'checked' : '' }}><span
                                            class="text-sm ml-5">Amoebiasis</span><br>
                                        <input type="checkbox" id="other" name="illness[]" value="other"  {{ str_contains($details->illness, 'other') ? 'checked' : '' }}><span class="text-sm ml-5">Others</span><br>
                                        <div class="mt-2 text-gray-500">
                                            <input type="text" name="other_illness" id="other_illness"
                                                class="border text-xs p-2 w-60 outline-none" value="{{$details->other_illness}}">
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-white shadow-xl mt-5" style="width:100%;">
                            <div class="p-4">
                                <h1 class="text-gray-500 pt-5">
                                    History of Allergy Reaction
                                </h1>
                                <span class="text-xs text-gray-400">(Please specify)</span>
                                <div class="flex gap-3">
                                    <div class="mt-2" style="width: 50%;">
                                        <label for="food_allergy" class="text-xs font-light">Food</label>
                                        <input type="text" name="food_allergy" id="food_allergy"
                                            class="w-full border p-2 text-xs mt-2 outline-none text-gray-500"
                                            value="{{ $details->food_allergy }}">
                                    </div>
                                    <div class="mt-2" style="width: 50%;">
                                        <label for="medicine_allergy" class="text-xs font-light">Medicine</label>
                                        <input type="text" name="medicine_allergy" id="medicine_allergy"
                                            class="w-full border p-2 text-xs mt-2 outline-none text-gray-500"
                                            value="{{ $details->medicine_allergy }}">
                                    </div>
                                </div>
                                <div class="flex gap-3">
                                    <div class="mt-2" style="width: 50%;">
                                        <label for="insect_bite_allergy" class="text-xs font-light">Insect Bite</label>
                                        <input type="text" name="insect_bite_allergy" id="insect_bite_allergy"
                                            class="w-full border p-2 text-xs mt-2 outline-none text-gray-500"
                                            value="{{ $details->insect_bite_allergy }}">
                                    </div>
                                    <div class="mt-2" style="width: 50%;">
                                        <label for="other_allergy" class="text-xs font-light">Other</label>
                                        <input type="text" name="other_allergy" id="other_allergy"
                                            class="w-full border p-2 text-xs mt-2 outline-none text-gray-500"
                                            value="{{ $details->other_allergy }}">
                                    </div>
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
                                            class="w-full border p-2 text-xs mt-2 outline-none text-gray-500" value="{{$details->vission_of_righteye}}">
                                    </div>
                                    <div class="mt-2" style="width: 50%;">
                                        <label for="vission_of_lefteye" class="text-xs font-light">Vision of
                                            left-eye</label>
                                        <input type="text" name="vission_of_lefteye" id="vission_of_lefteye"
                                            class="w-full border p-2 text-xs mt-2 outline-none text-gray-500"value="{{$details->vission_of_lefteye}}">
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
                                            class="w-full border p-2 text-xs mt-2 outline-none text-gray-500" value="{{$details->blood_pressure}}">
                                    </div>
                                    <div class="mt-2" style="width: 50%;">
                                        <label for="pulse_rate" class="text-xs font-light">Pulse Rate</label>
                                        <input type="number" name="pulse_rate" id="pulse_rate"
                                            class="w-full border p-2 text-xs mt-2 outline-none text-gray-500" value="{{$details->pulse_rate}}">
                                    </div>
                                </div>
                                <div>
                                    <h3 class="text-sm mt-5 text-gray-500">Quick Results</h3>
                                </div>
                                <div class="mt-2">
                                    <label for="blood_pressure_category" class="text-xs font-light">Blood Pressure
                                        Category</label>
                                    <input type="text" name="blood_pressure_category" id="blood_pressure_category"
                                        class="w-full border p-2 text-xs mt-2 outline-none text-gray-500" value="{{$details->blood_pressure_category}}" disabled>
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
                                        class="w-full border p-2 text-xs mt-2 outline-none text-gray-500" value="{{$details->body_temperature}}">
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
                                            class="w-full border p-2 text-xs mt-2 outline-none text-gray-500" value="{{$details->height}}">
                                    </div>
                                    <div class="mt-2" style="width: 50%;">
                                        <label for="weight" class="text-xs font-light">Weight <span>(kg)</span></label>
                                        <input type="number" name="weight" id="weight"
                                            class="w-full border p-2 text-xs mt-2 outline-none text-gray-500" value="{{$details->weight}}">
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
                                                class="w-full border p-2 text-xs mt-2 outline-none text-gray-500" value="{{$details->bodymassindex}}" disabled>
                                        </div>
                                        <div style="width:70%;">
                                            <label for="bodymassindex_category" class="text-xs font-light">BMI
                                                Category</label>
                                            <input type="text" name="bodymassindex_category"
                                                id="bodymassindex_category"
                                                class="w-full border p-2 text-xs mt-2 outline-none text-gray-500" value="{{$details->bodymassindex_category}}" disabled>
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
                                                <option value="None"{{ $details->injurie_status == 'None' ? 'selected' : '' }}>None
                                                </option>
                                                <option value="Minor"{{ $details->injurie_status == 'Minor' ? 'selected' : '' }}>Minor
                                                </option>
                                                <option value="Medium"{{ $details->injurie_status == 'Medium' ? 'selected' : '' }}>Medium
                                                </option>
                                                <option value="Major"{{ $details->injurie_status == 'Major' ? 'selected' : '' }}>Major
                                                </option>
                                            </select>
                                        </div>
                                        <div style="width:33%;">
                                            <label for="dateofinjurie" class="text-xs font-light">Date</label>
                                            <input type="date" name="dateofinjurie" id="dateofinjurie"
                                                class="w-full border p-2 text-xs mt-2 outline-none text-gray-500" value="{{$details->dateofinjurie}}">
                                        </div>
                                        <div style="width:33%;">
                                            <label for="name_of_hospital" class="text-xs font-light">Name of
                                                Hospital</label>
                                            <input type="text" name="name_of_hospital" id="name_of_hospital"
                                                class="w-full border p-2 text-xs mt-2 outline-none text-gray-500" value="{{$details->name_of_hospital}}">
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
                                    (Please check)</span>
                                <div class="flex justify-center p-7">
                                    <div class="text-gray-500" style="width: 33%;">
                                        <div>
                                            <div>
                                                <input type="checkbox" name="immunization[]" value="BCG"  {{ str_contains($details->immunization, 'BCG') ? 'checked' : '' }}><span
                                                    class="text-sm ml-5">BCG</span><br>
                                                <input type="checkbox" name="immunization[]" value="DPT" {{ str_contains($details->immunization, 'DPT') ? 'checked' : '' }}><span
                                                    class="text-sm ml-5">DPT</span><br>
                                                <input type="checkbox" name="immunization[]" value="Polio" {{ str_contains($details->immunization, 'Polio') ? 'checked' : '' }}><span
                                                    class="text-sm ml-5">Polio</span><br>
                                                <input type="checkbox" name="immunization[]" value="Hepatitis A" {{ str_contains($details->immunization, 'Hepatitis A') ? 'checked' : '' }}><span
                                                    class="text-sm ml-5">Hepatitis A</span><br>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-gray-500" style="width: 33%;">
                                        <input type="checkbox" name="immunization[]" value=">Hepatitis B" {{ str_contains($details->immunization, 'Hepatitis B') ? 'checked' : '' }}><span
                                            class="text-sm ml-5">Hepatitis B</span><br>
                                        <input type="checkbox" name="immunization[]" value="FLU" {{ str_contains($details->immunization, 'FLU') ? 'checked' : '' }}><span
                                            class="text-sm ml-5">FLU</span><br>
                                        <input type="checkbox" name="immunization[]" value="Measiles" {{ str_contains($details->immunization, 'Measiles') ? 'checked' : '' }}><span
                                            class="text-sm ml-5">Measiles</span><br>
                                        <input type="checkbox" name="immunization[]"
                                            value="Human Papiloma Virus" {{ str_contains($details->immunization, 'Human Papiloma Virus') ? 'checked' : '' }}><span
                                            class="text-sm ml-5">Human
                                            Papiloma Virus</span><br>
                                    </div>
                                    <div class="text-gray-500" style="width: 33%;">
                                        <input type="checkbox" name="immunization[]" value=">Chicken Fox" {{ str_contains($details->immunization, 'Chicken Fox') ? 'checked' : '' }}><span
                                            class="text-sm ml-5">Chicken Fox</span><br>
                                        <input type="checkbox" id="other_immunization" name="immunization[]" value="other" {{ str_contains($details->immunization, 'other') ? 'checked' : '' }}><span
                                            class="text-sm ml-5" >Others</span><br>
                                        <div class="mt-2 text-gray-500">
                                            <input type="text" name="other_immunization"
                                                id="other_immunization_textbox"
                                                class="border text-xs p-2 w-60 outline-none"  value="{{$details->other_immunization}}">
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
                                                <input type="checkbox" name="familyhistory[]" value="Cancer" {{ str_contains($details->familyhistory, 'Cancer') ? 'checked' : '' }}><span
                                                    class="text-sm ml-5">Cancer</span><br>
                                                <input type="checkbox" name="familyhistory[]" value="Hypertension" {{ str_contains($details->familyhistory, 'Hypertension') ? 'checked' : '' }}><span
                                                    class="text-sm ml-5">Hypertension</span><br>
                                                <input type="checkbox" name="familyhistory[]" value="Tuberculosis" {{ str_contains($details->familyhistory, 'Tuberculosis') ? 'checked' : '' }}><span
                                                    class="text-sm ml-5">Tuberculosis</span><br>
                                                <input type="checkbox" name="familyhistory[]" value="Diabetes" {{ str_contains($details->familyhistory, 'Diabetes') ? 'checked' : '' }}><span
                                                    class="text-sm ml-5">Diabetes</span><br>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-gray-500" style="width: 33%;">
                                        <input type="checkbox" name="familyhistory[]" value=">Kidney Disease" {{ str_contains($details->familyhistory, 'Kidney Disease') ? 'checked' : '' }}><span
                                            class="text-sm ml-5">Kidney Disease</span><br>
                                        <input type="checkbox" name="familyhistory[]" value="Goiter" {{ str_contains($details->familyhistory, 'Goiter') ? 'checked' : '' }}><span
                                            class="text-sm ml-5">Goiter</span><br>
                                        <input type="checkbox" name="familyhistory[]" value="Asthma" {{ str_contains($details->familyhistory, 'Asthma') ? 'checked' : '' }}><span
                                            class="text-sm ml-5">Asthma</span><br>
                                        <input type="checkbox" name="familyhistory[]" value="Allergy" {{ str_contains($details->familyhistory, 'Allergy') ? 'checked' : '' }}><span
                                            class="text-sm ml-5">Allergy</span><br>
                                    </div>
                                    <div class="text-gray-500" style="width: 33%;">
                                        <input type="checkbox" name="familyhistory[]" value=">Febrile Convulsion" {{ str_contains($details->familyhistory, 'Febrile Convulsion') ? 'checked' : '' }}><span
                                            class="text-sm ml-5">Febrile Convulsion</span><br>
                                        <input type="checkbox" name="familyhistory[]" value=">Epilepsy" {{ str_contains($details->familyhistory, 'Epilepsy') ? 'checked' : '' }}><span
                                            class="text-sm ml-5">Epilepsy</span><br>
                                        <input type="checkbox" id="other_familyhistory" name="familyhistory[]" value="other" {{ str_contains($details->familyhistory, 'other') ? 'checked' : '' }}><span
                                            class="text-sm ml-5">Others</span><br>
                                        <div class="mt-2 text-gray-500">
                                            <input type="text" name="other_familyhistory"
                                                id="other_familyhistory_textbox"
                                                class="border text-xs p-2 w-60 outline-none" value="{{$details->other_familyhistory}}">
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-10">
                            <button type="submit"
                                class="p-2.5 bg-blue-700 text-white float-right m-5 text-sm w-40 rounded-md shadow-xl hover:bg-blue-800 duration-700">Save <span><i class="fa-solid fa-floppy-disk"></i></span></button>
                        </div>
                    </div>

                </form>
            @endforeach
        @else
            {{-- <div>WALA</div> --}}
            <form id="medicalInformation" action="#">

                <div class="hidden">
                    <input type="text" name="patient_id" id="patient_id" value="{{ $patientsInfo->id }}">
                </div>

                <div class="mt-10">

                    <div class="bg-white shadow-xl mt-5" style="width:100%;">
                        <div class="p-4">
                            <h1 class="text-gray-500 pt-5">
                                Medical History
                            </h1>
                            <span class="text-xs text-gray-400 font-light">Have you ever had any of the following
                                illness?
                                (Please check)</span>
                            <div class="flex justify-center p-7">
                                <div class="text-gray-500" style="width: 33%;">
                                    <div>
                                        <div>
                                            <input type="checkbox" name="illness[]" value="Asthma"><span
                                                class="text-sm ml-5">Asthma</span><br>
                                            <input type="checkbox" name="illness[]" value="Pneumonia"><span
                                                class="text-sm ml-5">Pneumonia</span><br>
                                            <input type="checkbox" name="illness[]" value="Diabetes"><span
                                                class="text-sm ml-5">Diabetes</span><br>
                                            <input type="checkbox" name="illness[]" value="Seizures"><span
                                                class="text-sm ml-5">Seizures</span><br>
                                            <input type="checkbox" name="illness[]" value="Tubercolosis"><span
                                                class="text-sm ml-5">Tubercolosis</span><br>
                                            <input type="checkbox" name="illness[]" value="Heart Disease"><span
                                                class="text-sm ml-5">Heart Disease</span><br>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-gray-500" style="width: 33%;">
                                    <input type="checkbox" name="illness[]" value="Kidney Disease"><span
                                        class="text-sm ml-5">Kidney
                                        Disease</span><br>
                                    <input type="checkbox" name="illness[]" value="Migraine"><span
                                        class="text-sm ml-5">Migraine</span><br>
                                    <input type="checkbox" name="illness[]" value="Dysmenorrhea"><span
                                        class="text-sm ml-5">Dysmenorrhea</span><br>
                                    <input type="checkbox" name="illness[]" value="Mental Illness"><span
                                        class="text-sm ml-5">Mental
                                        Illness</span><br>
                                    <input type="checkbox" name="illness[]" value="Digestive Problem"><span
                                        class="text-sm ml-5">Digestive
                                        Problem</span><br>
                                    <input type="checkbox" name="illness[]" value="Endoctrine Disease"><span
                                        class="text-sm ml-5">Endoctrine
                                        Disease</span><br>
                                </div>
                                <div class="text-gray-500" style="width: 33%;">
                                    <input type="checkbox" name="illness[]" value=">Sports Injury"><span
                                        class="text-sm ml-5">Sports Injury</span><br>
                                    <input type="checkbox" name="illness[]" value="Amoebiasis"><span
                                        class="text-sm ml-5">Amoebiasis</span><br>
                                    <input type="checkbox" id="other" name="illness[]" value="other"><span class="text-sm ml-5">Others</span><br>
                                    <div class="mt-2 text-gray-500">
                                        <input type="text" name="other_illness" id="other_illness"
                                            class="border text-xs p-2 w-60 outline-none">
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white shadow-xl mt-5" style="width:100%;">
                        <div class="p-4">
                            <h1 class="text-gray-500 pt-5">
                                History of Allergy Reaction
                            </h1>
                            <span class="text-xs text-gray-400">(Please specify)</span>
                            <div class="flex gap-3">
                                <div class="mt-2" style="width: 50%;">
                                    <label for="food_allergy" class="text-xs font-light">Food</label>
                                    <input type="text" name="food_allergy" id="food_allergy"
                                        class="w-full border p-2 text-xs mt-2 outline-none text-gray-500">
                                </div>
                                <div class="mt-2" style="width: 50%;">
                                    <label for="medicine_allergy" class="text-xs font-light">Medicine</label>
                                    <input type="text" name="medicine_allergy" id="medicine_allergy"
                                        class="w-full border p-2 text-xs mt-2 outline-none text-gray-500">
                                </div>
                            </div>
                            <div class="flex gap-3">
                                <div class="mt-2" style="width: 50%;">
                                    <label for="insect_bite_allergy" class="text-xs font-light">Insect Bite</label>
                                    <input type="text" name="insect_bite_allergy" id="insect_bite_allergy"
                                        class="w-full border p-2 text-xs mt-2 outline-none text-gray-500">
                                </div>
                                <div class="mt-2" style="width: 50%;">
                                    <label for="other_allergy" class="text-xs font-light">Other</label>
                                    <input type="text" name="other_allergy" id="other_allergy"
                                        class="w-full border p-2 text-xs mt-2 outline-none text-gray-500">
                                </div>
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
                                        class="w-full border p-2 text-xs mt-2 outline-none text-gray-500" disabled>
                                </div>
                                <div class="mt-2" style="width: 50%;">
                                    <label for="vission_of_lefteye" class="text-xs font-light">Vision of
                                        left-eye</label>
                                    <input type="text" name="vission_of_lefteye" id="vission_of_lefteye"
                                        class="w-full border p-2 text-xs mt-2 outline-none text-gray-500" disabled>
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
                                        class="w-full border p-2 text-xs mt-2 outline-none text-gray-500" ">
                                </div>
                                <div class="mt-2" style="width: 50%;">
                                    <label for="pulse_rate" class="text-xs font-light">Pulse Rate</label>
                                    <input type="number" name="pulse_rate" id="pulse_rate"
                                        class="w-full border p-2 text-xs mt-2 outline-none text-gray-500">
                                </div>
                            </div>
                            <div>
                                <h3 class="text-sm mt-5 text-gray-500">Quick Results</h3>
                            </div>
                            <div class="mt-2">
                                <label for="blood_pressure_category" class="text-xs font-light">Blood Pressure
                                    Category</label>
                                <input type="text" name="blood_pressure_category" id="blood_pressure_category"
                                    class="w-full border p-2 text-xs mt-2 outline-none text-gray-500" disabled>
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
                                    class="w-full border p-2 text-xs mt-2 outline-none text-gray-500">
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
                                        class="w-full border p-2 text-xs mt-2 outline-none text-gray-500">
                                </div>
                                <div class="mt-2" style="width: 50%;">
                                    <label for="weight" class="text-xs font-light">Weight <span>(kg)</span></label>
                                    <input type="number" name="weight" id="weight"
                                        class="w-full border p-2 text-xs mt-2 outline-none text-gray-500">
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
                                            class="w-full border p-2 text-xs mt-2 outline-none text-gray-500" disabled>
                                    </div>
                                    <div style="width:70%;">
                                        <label for="bodymassindex_category" class="text-xs font-light">BMI
                                            Category</label>
                                        <input type="text" name="bodymassindex_category" id="bodymassindex_category"
                                            class="w-full border p-2 text-xs mt-2 outline-none text-gray-500" disabled>
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
                                            <option value="None">None</option>
                                            <option value="Minor">Minor</option>
                                            <option value="Medium">Medium</option>
                                            <option value="Major">Major</option>
                                        </select>
                                    </div>
                                    <div style="width:33%;">
                                        <label for="dateofinjurie" class="text-xs font-light">Date</label>
                                        <input type="date" name="dateofinjurie" id="dateofinjurie"
                                            class="w-full border p-2 text-xs mt-2 outline-none text-gray-500">
                                    </div>
                                    <div style="width:33%;">
                                        <label for="name_of_hospital" class="text-xs font-light">Name of
                                            Hospital</label>
                                        <input type="text" name="name_of_hospital" id="name_of_hospital"
                                            class="w-full border p-2 text-xs mt-2 outline-none text-gray-500">
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
                                (Please check)</span>
                            <div class="flex justify-center p-7">
                                <div class="text-gray-500" style="width: 33%;">
                                    <div>
                                        <div>
                                            <input type="checkbox" name="immunization[]" value="BCG"><span
                                                class="text-sm ml-5">BCG</span><br>
                                            <input type="checkbox" name="immunization[]" value="DPT"><span
                                                class="text-sm ml-5">DPT</span><br>
                                            <input type="checkbox" name="immunization[]" value="Polio"><span
                                                class="text-sm ml-5">Polio</span><br>
                                            <input type="checkbox" name="immunization[]" value="Hepatitis A"><span
                                                class="text-sm ml-5">Hepatitis A</span><br>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-gray-500" style="width: 33%;">
                                    <input type="checkbox" name="immunization[]" value=">Hepatitis B"><span
                                        class="text-sm ml-5">Hepatitis B</span><br>
                                    <input type="checkbox" name="immunization[]" value="FLU"><span
                                        class="text-sm ml-5">FLU</span><br>
                                    <input type="checkbox" name="immunization[]" value="Measiles"><span
                                        class="text-sm ml-5">Measiles</span><br>
                                    <input type="checkbox" name="immunization[]"
                                        value="Human Papiloma Virus"><span
                                        class="text-sm ml-5">Human
                                        Papiloma Virus</span><br>
                                </div>
                                <div class="text-gray-500" style="width: 33%;">
                                    <input type="checkbox" name="immunization[]" value=">Chicken Fox"><span
                                        class="text-sm ml-5">Chicken Fox</span><br>
                                    <input type="checkbox" id="other_immunization" name="immunization[]" value=">other"><span
                                        class="text-sm ml-5">Others</span><br>
                                    <div class="mt-2 text-gray-500">
                                        <input type="text" name="other_immunization" id="other_immunization_textbox"
                                            class="border text-xs p-2 w-60 outline-none">
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
                                            <input type="checkbox" name="familyhistory[]" value="Cancer"><span
                                                class="text-sm ml-5">Cancer</span><br>
                                            <input type="checkbox" name="familyhistory[]" value="Hypertension"><span
                                                class="text-sm ml-5">Hypertension</span><br>
                                            <input type="checkbox" name="familyhistory[]" value="Tuberculosis"><span
                                                class="text-sm ml-5">Tuberculosis</span><br>
                                            <input type="checkbox" name="familyhistory[]" value="Diabetes"><span
                                                class="text-sm ml-5">Diabetes</span><br>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-gray-500" style="width: 33%;">
                                    <input type="checkbox" name="familyhistory[]" value=">Kidney Disease"><span
                                        class="text-sm ml-5">Kidney Disease</span><br>
                                    <input type="checkbox" name="familyhistory[]" value="Goiter"><span
                                        class="text-sm ml-5">Goiter</span><br>
                                    <input type="checkbox" name="familyhistory[]" value="Asthma"><span
                                        class="text-sm ml-5">Asthma</span><br>
                                    <input type="checkbox" name="familyhistory[]" value="Allergy"><span
                                        class="text-sm ml-5">Allergy</span><br>
                                </div>
                                <div class="text-gray-500" style="width: 33%;">
                                    <input type="checkbox" name="familyhistory[]" value=">Febrile Convulsion"><span
                                        class="text-sm ml-5">Febrile Convulsion</span><br>
                                    <input type="checkbox" name="familyhistory[]" value=">Epilepsy"><span
                                        class="text-sm ml-5">Epilepsy</span><br>
                                    <input type="checkbox" id="other_familyhistory" name="familyhistory[]" value=">other"><span
                                        class="text-sm ml-5">Others</span><br>
                                    <div class="mt-2 text-gray-500">
                                        <input type="text" name="other_familyhistory" id="other_familyhistory_textbox"
                                            class="border text-xs p-2 w-60 outline-none">
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-10">
                        <button type="submit"
                            class="p-2.5 bg-blue-700 text-white float-right m-5 text-sm w-40 rounded-md shadow-xl hover:bg-blue-800 duration-700">Submit</button>
                    </div>
                </div>

            </form>
        @endif

    </div>

    <script>
        $(document).ready(function() {
            $('#other_familyhistory_textbox').prop('disabled', true);
            $('#vission_of_lefteye').prop('disabled', true);
            $('#vission_of_righteye').prop('disabled', true);
            $('#other_illness').prop('disabled', true);
            $('#other_immunization_textbox').prop('disabled', true);
            $('#parents_abroad_checkbox').change(function() {
                $('#guardian_name').prop('disabled', !$(this).prop('checked'));
                $('#guardian_relationship').prop('disabled', !$(this).prop('checked'));
                $('#guardian_occupation').prop('disabled', !$(this).prop('checked'));
                $('#guardian_cpnumber').prop('disabled', !$(this).prop('checked'));
            });

            $('#other').change(function() {

                if ($(this).is(':checked')) {
                    $('#other_illness').prop('disabled', false);
                } else {
                    $('#other_illness').prop('disabled', true);
                }
            });

            $('#other_immunization').change(function() {

                if ($(this).is(':checked')) {
                    $('#other_immunization_textbox').prop('disabled', false);
                } else {
                    $('#other_immunization_textbox').prop('disabled', true);
                }
            });

            $('#other_familyhistory').change(function() {

                if ($(this).is(':checked')) {
                    $('#other_familyhistory_textbox').prop('disabled', false);
                } else {
                    $('#other_familyhistory_textbox').prop('disabled', true);
                }
            });
            $('#witheyeglasses').change(function() {
                $('#vission_of_righteye').prop('disabled', !$(this).prop('checked'));
                $('#vission_of_lefteye').prop('disabled', !$(this).prop('checked'));
            });

            $('#blood_pressure').on('input', function() {
                var bloodPressure = $(this).val();
                var category = calculateBloodPressureCategory(bloodPressure);
                $('#blood_pressure_category').val(category);
            });

            function calculateBloodPressureCategory(bloodPressure) {
                if (bloodPressure < 120) {
                    return 'Normal';
                } else if (bloodPressure >= 120 && bloodPressure <= 129) {
                    return 'Elevated';
                } else if (bloodPressure >= 130 && bloodPressure <= 139) {
                    return 'High Blood Pressure (Stage 1)';
                } else if (bloodPressure >= 140 && bloodPressure <= 180) {
                    return 'High Blood Pressure (Stage 2)';
                } else {
                    return 'Hypertensive Crisis';
                }
            }

            // BMI

            $('#height, #weight').on('input', function() {
                calculateBMI();
            });

            function calculateBMI() {
                var height = parseFloat($('#height').val());
                var weight = parseFloat($('#weight').val());

                if (!isNaN(height) && !isNaN(weight) && height > 0 && weight > 0) {
                    var bmi = weight / ((height / 100) * (height / 100));
                    $('#bodymassindex').val(bmi.toFixed(2));


                    var category = '';
                    if (bmi < 18.5) {
                        category = 'Underweight';
                    } else if (bmi >= 18.5 && bmi < 25) {
                        category = 'Normal weight';
                    } else if (bmi >= 25 && bmi < 30) {
                        category = 'Overweight';
                    } else {
                        category = 'Obese';
                    }
                    $('#bodymassindex_category').val(category);
                } else {
                    $('#bmi').val('');
                    $('#bmi_category').val('');
                }
            }

        });
        $("#vission_of_righteye, #vission_of_lefteye").keyup(function() {
            var rightEye = $("#vission_of_righteye").val();
            var leftEye = $("#vission_of_lefteye").val();
            var checkBox = $("#witheyeglasses");

            if (rightEye !== "" || leftEye !== "") {
                checkBox.prop("checked", true);
            } else {
                checkBox.prop("checked", false);
            }
        });

        var rightEyeInput = $("#vission_of_righteye");
        var leftEyeInput = $("#vission_of_lefteye");
        var glassesCheckbox = $("#witheyeglasses");

        function updateCheckbox() {
            if (rightEyeInput.val() && leftEyeInput.val()) {
                glassesCheckbox.prop("checked", true);
            } else {
                glassesCheckbox.prop("checked", false);
            }
        }

        updateCheckbox();

        rightEyeInput.on("input", updateCheckbox);
        leftEyeInput.on("input", updateCheckbox);

        function toggleFields() {
            var injuryStatus = $('#injurie_status').val();
            if (injuryStatus === 'None') {
                $('#dateofinjurie').prop('disabled', true);
                $('#name_of_hospital').prop('disabled', true);
            } else {
                $('#dateofinjurie').prop('disabled', false);
                $('#name_of_hospital').prop('disabled', false);
            }
        }


        toggleFields();
        $('#injurie_status').change(function () {
            toggleFields();
        });
        // submit form
        $("#medicalInformation").submit(function(e) {
            e.preventDefault();
            alert("PISOT NA DAKULA");

            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
            });
            var formData = new FormData(this);

            $.ajax({
                type: "POST",
                url: "/add_medicalinformation",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    alert("MEDICAL HISTORY SUCCESSULLY ADDED!");
                    location.reload();
                },
                error: function(xhr) {
                    var errorMessage = xhr.responseText;
                    console.log(errorMessage); // Log the error message
                    alert(errorMessage); // Display the error message
                },
            });
        });
    </script>
@endsection
