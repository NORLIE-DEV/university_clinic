@extends('layout.doctor_layout')

@section('content')
    <div class="bg-white mx-auto my-5 rounded-md flex justify-between items-center shadow-md p-3"
        style="width: 95%; height:auto;">
        @if ($doctor->department == 'dentist')
            <div class="text-xl font-medium text-gray-500">
                Dental Patient Consultation
            </div>
        @elseif($doctor->department == 'physician')
            <div class="text-xl font-medium text-gray-500">
                Medical Patient Consultation
            </div>
        @endif
        <div>
            <button id="backButton" class="text-xs p-2 bg-blue-950 text-white w-20 rounded-md">Back</button>
        </div>
    </div>

    <!---Patient  Information-->
    <form action="#" id="dentalConsultationFormUpdate">
        <div class="bg-white mx-auto rounded-md shadow-lg p-1 mb-5" style="width: 95%; height:auto;">
            <ul class="flex border text-sm items-center">
                <li id="tab-1" class="tab flex-1 text-center py-2 cursor-pointer border active-tab">Dental
                    Exam
                </li>
                <li id="tab-2" class="tab flex-1 text-center py-2 cursor-pointer border">Medication</li>
                <li id="tab-3" class="tab flex-1 text-center py-2 cursor-pointer border">Oral Condition</li>
                <li id="tab-4" class="tab flex-1 text-center py-2 cursor-pointer border">Discharge Summary
                </li>
            </ul>
            <div class="tab-content" id="tab-content-1">
                <div class="text-center mt-10 font-medium text-3xl">
                    Dental Chart
                </div>
                <div class="flex justify-center m-10 p-10">
                    <img src="{{ asset('asset/img/logo/istockphoto-1584408847-612x612.jpg') }}" alt="">
                </div>
            </div>
            <div class="tab-content hidden" id="tab-content-2">
                <div class="w-full bg-blue-800 text-sm p-3 mt-3 text-white">
                    Medicines / Qty / Instruction
                </div>
                <div class="mt-5 mx-3 text-gray-500">
                    Medicine Issuance
                </div>

                <div class="flex items-center gap-5 mt-2">
                    <div class="m-2" style="width:85%; height:auto;">
                        <label for="medicine[]">Select Medicine Brand Name</label><br>
                        <select type="text" name="medicine[]" id="medicine"
                            class="w-full text-xs p-2 outline-none border">
                            <option value="#">Select Medicine</option>
                        </select>
                    </div>
                    <div style="width:5%; height:auto;">
                        <label for="qty">Qty</label><br>
                        <input type="number" name="qty[]" id="qty" class="w-20 text-xs p-2 outline-none border"">
                    </div>
                </div>
                <div class="flex items-center gap-5">
                    <div class="m-2" style="width:85%; height:auto;">
                        <label for="instruction[]">Instruction / Remarks</label><br>
                        <textarea name="instruction[]" id="instruction" class="outline-none border w-full text-xs text-gray-500 h-20" "></textarea>
                    </div>
                    <div style="width:5%; height:auto;">
                        <div id="AddMedicine" class="text-xs text-center bg-blue-900 p-2.5 mt-5 w-20 text-white rounded-md"
                            style="cursor: pointer";><i class="fa-solid fa-plus"></i>Add</div>
                    </div>
                </div>
                <input type="hidden" name="num_medicine_issuance" id="num_medicine_issuance" value="1">
                <div class="mb-10 mx-2">
                    <!-- Table responsive wrapper -->
                    <div class="overflow-x-auto bg-white dark:bg-neutral-700">
                        <!-- Table -->
                        <table id="dataTable" class="min-w-full text-left text-xs whitespace-nowrap text-gray-600">
                            <!-- Table head -->
                            <thead class="uppercase tracking-wider border-b-2 dark:border-neutral-600 border-t">
                                <tr>

                                    <th scope="col" class="px-6 py-3 border-x dark:border-neutral-600">
                                        Brand Name
                                    </th>
                                    <th scope="col" class="px-6 py-3 border-x dark:border-neutral-600">
                                        Qty
                                    </th>
                                    <th scope="col" class="px-6 py-3 border-x dark:border-neutral-600">
                                        Instruction
                                    </th>
                                    <th scope="col" class="px-6 py-3 border-x dark:border-neutral-600">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <!-- Table body -->
                            <tbody class="text-xs" id="medicineIssuanceTableBody">
                                @php
                                    $consultation = \App\Models\DentalConsultation::findOrFail($dentalConsultation->id);

                                    $medicineIssuance = json_decode(
                                        json_decode($consultation->medicine_issuance),
                                        true,
                                    );
                                @endphp

                                @foreach ($medicineIssuance as $index => $issuance)
                                    <tr>
                                        <td>{{ $issuance['medicine'] }}</td>
                                        <td>{{ $issuance['qty'] }}</td>
                                        <td>{{ $issuance['instruction'] }}</td>
                                        <td>
                                            <div class="cursor-pointer remove-row">Remove</div>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>

                        <div class="float-right">
                            <a href="#" class="text-xs underline text-blue-800">View Allergy</a>
                        </div>
                    </div>
                </div>
                <div class="mt-5 mx-3 text-gray-500">
                    Medicine Prescription
                </div>
                <div class="flex items-center gap-5 mt-2">
                    <div class="m-2" style="width:85%; height:auto;">
                        <label for="medicine_1[]">Select Medicine Brand Name</label><br>
                        <select type="text" name="medicine_1[]" id="medicine_1"
                            class="w-full text-xs p-2 outline-none border">
                            <option value="#">Select Medicine</option>
                        </select>
                    </div>
                    <div style="width:5%; height:auto;">
                        <label for="qty_1">Qty</label><br>
                        <input type="number" name="qty_1[]" id="qty_1" class="w-20 text-xs p-2 outline-none border"">
                    </div>
                </div>
                <div class="flex items-center gap-5">
                    <div class="m-2" style="width:85%; height:auto;">
                        <label for="instruction_1[]">Instruction / Remarks</label><br>
                        <textarea name="instruction_1[]" id="instruction_1" class="outline-none border w-full text-xs text-gray-500 h-20""></textarea>
                    </div>
                    <div style="width:5%; height:auto;">
                        <div id="AddMedicinePrescription"
                            class="text-xs bg-blue-900 p-2.5 mt-5 w-20 text-white rounded-md text-center"
                            style="cursor: pointer";><i class="fa-solid fa-plus"></i>Add</div>
                    </div>
                </div>
                <input type="hidden" name="num_medicine_prescription" id="num_medicine_prescription" value="1">
                <div class="mb-10 mx-2">
                    <!-- Table responsive wrapper -->
                    <div class="overflow-x-auto bg-white dark:bg-neutral-700">
                        <!-- Table -->
                        <table id="dataTable" class="min-w-full text-left text-xs whitespace-nowrap text-gray-600">
                            <!-- Table head -->
                            <thead class="uppercase tracking-wider border-b-2 dark:border-neutral-600 border-t">
                                <tr>

                                    <th scope="col" class="px-6 py-3 border-x dark:border-neutral-600">
                                        Brand Name
                                    </th>
                                    <th scope="col" class="px-6 py-3 border-x dark:border-neutral-600">
                                        Qty
                                    </th>
                                    <th scope="col" class="px-6 py-3 border-x dark:border-neutral-600">
                                        Instruction
                                    </th>
                                    <th scope="col" class="px-6 py-3 border-x dark:border-neutral-600">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <!-- Table body -->
                            <tbody class="text-xs" id="tablePrescriptionBody">
                                @php
                                    $consultation = \App\Models\DentalConsultation::findOrFail($dentalConsultation->id);

                                    $medicinePrescription = json_decode(
                                        json_decode($consultation->medicine_prescription),
                                        true,
                                    );
                                @endphp

                                @foreach ($medicinePrescription as $index => $prescription)
                                    <tr>
                                        <td>{{ $prescription['medicine'] }}</td>
                                        <td>{{ $prescription['qty'] }}</td>
                                        <td>{{ $prescription['instruction'] }}</td>
                                        <td>
                                            <div class="cursor-pointer remove-row">Remove</div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>

                    </div>
                </div>
            </div>
            <div class="tab-content hidden" id="tab-content-3">
                <div class="w-full bg-blue-800 text-sm p-3 mt-3 text-white"> Oral Health Condition </div>
                <div class="flex">
                    <div>
                        <div class="m-5"> <input type="checkbox" name="oral_health_condition[]"
                                id="oral_health_condition" value="CALCULUS"
                                {{ str_contains($dentalConsultation->oral_health_condition, 'CALCULUS') ? 'checked' : '' }}><span
                                class="text-sm ml-5">CALCULUS</span><br> </div>
                        <div class="m-5"> <input type="checkbox"
                                name="oral_health_condition[]"id="oral_health_condition"
                                value="CARIES"{{ str_contains($dentalConsultation->oral_health_condition, 'CARIES') ? 'checked' : '' }}><span
                                class="text-sm ml-5">CARIES</span><br> </div>
                        <div class="m-5"> <input type="checkbox"
                                name="oral_health_condition[]"id="oral_health_condition"
                                value="CLEFT PLATE"{{ str_contains($dentalConsultation->oral_health_condition, 'CLEFT PLATE') ? 'checked' : '' }}><span
                                class="text-sm ml-5">CLEFT PLATE</span><br> </div>
                        <div class="m-5"> <input type="checkbox"
                                name="oral_health_condition[]"id="oral_health_condition"
                                value="DEBRIS"{{ str_contains($dentalConsultation->oral_health_condition, 'DEBRIS') ? 'checked' : '' }}><span
                                class="text-sm ml-5">DEBRIS</span><br> </div>
                        <div class="m-5"> <input type="checkbox"
                                name="oral_health_condition[]"id="oral_health_condition"
                                value="GINGIVITIS"{{ str_contains($dentalConsultation->oral_health_condition, 'GINGIVITIS') ? 'checked' : '' }}><span
                                class="text-sm ml-5">GINGIVITIS</span><br> </div>
                        <div class="m-5"> <input type="checkbox"
                                name="oral_health_condition[]"id="oral_health_condition"
                                value="NEOPLASM"{{ str_contains($dentalConsultation->oral_health_condition, 'NEOPLASM') ? 'checked' : '' }}><span
                                class="text-sm ml-5">NEOPLASM</span><br> </div>
                    </div>
                    <div>
                        <div class="m-5"> <input type="checkbox"
                                name="oral_health_condition[]"id="oral_health_condition"
                                value="P.POCKETS"{{ str_contains($dentalConsultation->oral_health_condition, 'P.POCKETS') ? 'checked' : '' }}><span
                                class="text-sm ml-5">P.POCKETS</span><br> </div>
                        <div class="m-5"> <input type="checkbox"
                                name="oral_health_condition[]"id="oral_health_condition"
                                value="ROOT FRAGMENT"{{ str_contains($dentalConsultation->oral_health_condition, 'ROOT FRAGMENT') ? 'checked' : '' }}><span
                                class="text-sm ml-5">ROOT FRAGMENT </span><br> </div>
                    </div>
                </div>
                {{-- sr --}}
                <div class="w-full bg-blue-800 text-sm p-3 mt-3 text-white"> Service Rendered </div>
                <div class="flex">
                    <div>
                        <div class="m-5"> <input type="checkbox" name="services_rendered[]" id="services_rendered"
                                value="AMALGAM FILLING"{{ str_contains($dentalConsultation->services_rendered, 'AMALGAM FILLING') ? 'checked' : '' }}><span
                                class="text-sm ml-5">AMALGAM FILLING</span><br> </div>
                        <div class="m-5"> <input type="checkbox" name="services_rendered[]"id="services_rendered"
                                value="COMPOSITE FILLING"{{ str_contains($dentalConsultation->services_rendered, 'COMPOSITE FILLING') ? 'checked' : '' }}><span
                                class="text-sm ml-5">COMPOSITE FILLING</span><br> </div>
                        <div class="m-5"> <input type="checkbox" name="services_rendered[]"
                                id="services_rendered"value="CONSULTATION"
                                {{ str_contains($dentalConsultation->services_rendered, 'CONSULTATION') ? 'checked' : '' }}><span
                                class="text-sm ml-5">CONSULTATION</span><br> </div>
                        <div class="m-5"> <input type="checkbox" name="services_rendered[]"id="services_rendered"
                                value="DENTAL CERTIFICATE"{{ str_contains($dentalConsultation->services_rendered, 'DENTAL CERTIFICATE') ? 'checked' : '' }}><span
                                class="text-sm ml-5">DENTAL CERTIFICATE</span><br> </div>
                        <div class="m-5"> <input type="checkbox" name="services_rendered[]"
                                id="services_rendered"value="DENTAL PRO PROPHYLAXIS"
                                {{ str_contains($dentalConsultation->services_rendered, 'DENTAL PRO PROPHYLAXIS') ? 'checked' : '' }}><span
                                class="text-sm ml-5">DENTAL PRO PROPHYLAXIS</span><br> </div>
                        <div class="m-5"> <input type="checkbox" name="services_rendered[]"id="services_rendered"
                                value="EMERGENCY TREATMENT"{{ str_contains($dentalConsultation->services_rendered, 'EMERGENCY TREATMENT') ? 'checked' : '' }}><span
                                class="text-sm ml-5">EMERGENCY TREATMENT</span><br> </div>
                        <div class="m-5"> <input type="checkbox" name="services_rendered[]"
                                id="services_rendered"value="BRIDGE WORK"
                                {{ str_contains($dentalConsultation->services_rendered, 'BRIDGE WORK') ? 'checked' : '' }}><span
                                class="text-sm ml-5">BRIDGE WORK</span><br> </div>
                    </div>
                    <div>
                        <div class="m-5"> <input type="checkbox" name="services_rendered[]"
                                id="services_rendered"value="FLOURIDE THERAPY"
                                {{ str_contains($dentalConsultation->services_rendered, 'FLOURIDE THERAPY') ? 'checked' : '' }}><span
                                class="text-sm ml-5">FLOURIDE THERAPY</span><br> </div>
                        <div class="m-5"> <input type="checkbox" name="services_rendered[]"
                                id="services_rendered"value="ROOT FRAGMENT"
                                {{ str_contains($dentalConsultation->services_rendered, 'ROOT FRAGMENT') ? 'checked' : '' }}><span
                                class="text-sm ml-5">ROOT FRAGMENT </span><br> </div>
                        <div class="m-5"> <input type="checkbox" name="services_rendered[]"id="services_rendered"
                                value="CLEFT PLATE"{{ str_contains($dentalConsultation->services_rendered, 'CLEFT PLATE') ? 'checked' : '' }}><span
                                class="text-sm ml-5">CLEFT PLATE</span><br> </div>
                        <div class="m-5"> <input type="checkbox" name="services_rendered[]"
                                id="services_rendered"value="DENTAL BONDING"
                                {{ str_contains($dentalConsultation->services_rendered, 'DENTAL BONDING') ? 'checked' : '' }}><span
                                class="text-sm ml-5">DENTAL BONDING</span><br> </div>
                        <div class="m-5"> <input type="checkbox" name="services_rendered[]"id="services_rendered"
                                value="DENTURES"{{ str_contains($dentalConsultation->services_rendered, 'DENTURES') ? 'checked' : '' }}><span
                                class="text-sm ml-5">DENTURES</span><br> </div>
                        <div class="m-5"> <input type="checkbox" name="services_rendered[]"id="services_rendered"
                                value="TEETH WHITENING"{{ str_contains($dentalConsultation->services_rendered, 'TEETH WHITENING') ? 'checked' : '' }}><span
                                class="text-sm ml-5">TEETH WHITENING</span><br> </div>
                        <div class="m-5"> <input type="checkbox" name="services_rendered[]"
                                id="services_rendered"value="TOOTH EXTRACTIONS"
                                {{ str_contains($dentalConsultation->services_rendered, 'TOOTH EXTRACTIONS') ? 'checked' : '' }}><span
                                class="text-sm ml-5">TOOTH EXTRACTIONS</span><br> </div>
                    </div>
                </div>
            </div>
            <div class="tab-content hidden" id="tab-content-4">
                <div class="w-full bg-blue-800 text-sm p-3 mt-3 text-white">
                    Discharge Summary
                </div>
                <div class="ml-5">
                    <label for="nurse" class="text-xs">Nurse On Duty 1</label>

                    <select type="text" name="nurse" id="nurse" class="text-xs p-2 outline-none w-full border"
                        data-selected-nurse="{{ $dentalConsultation->nurse_id_1 }}">
                        <option value="" disabled selected>Select a Nurse</option>
                        @foreach ($nurses as $nurse)
                            <option value="{{ $nurse->id }}">{{ $nurse->name }}</option>
                        @endforeach

                    </select>
                </div>
                <div class="ml-5">
                    <label for="nurse_1" class="text-xs">Nurse On Duty 2</label>
                    <select type="text" name="nurse_1" id="nurse_1"
                        data-selected-nurse_1="{{ $dentalConsultation->nurse_id_2 }}"
                        class="text-xs p-2 outline-none w-full border">
                        <option value="" disabled selected>Select a Nurse</option>

                    </select>
                </div>
                <div class="ml-5">
                    <label for="other_assistant" class="text-xs">Other Assistant</label>
                    <input type="text" name="other_assistant" id="other_assistant"
                        class="text-xs p-2 outline-none w-full border"
                        value="{{ $dentalConsultation->other_assistant }}">
                </div>

                <div class="ml-5">
                    <label for="dentist_on_duty" class="text-xs">Dentist On Duty</label>
                    <input type="text" name="dentist_on_duty" id="dentist_on_duty"
                        class="text-xs p-2 outline-none w-full border" value="{{ $doctor->name }}" disabled>
                </div>
                <div class="ml-5">
                    <label for="follow_up" class="text-xs">Follow Up</label>
                    <input type="text" name="follow_up" id="follow_up"
                        class="text-xs p-2 outline-none w-full border"value="{{ $dentalConsultation->follow_up }}">
                </div>
                <div class="ml-5">
                    <label for="remarks" class="text-xs">Remarks</label>
                    <textarea name="remarks" id="remarks" class="w-full h-20 border outline-none text-xs">{{ $dentalConsultation->remarks }}</textarea>
                </div>
                <div class="ml-5 mt-5">
                    <div class="flex gap-5">
                        <input type="checkbox">
                        <label for="#">Is this for annual dental examination? <span>(check if
                                yes)</span></label>
                    </div>
                </div>
                <div>
                    <input type="text" class="hidden" name="consultation_method" id="consultation_method"
                        value="Appointment">
                </div>
                <div>
                    <button type="submit" class="bg-blue-500 text-white ">Save</button>
                </div>
            </div>
        </div>

        <input type="text" class="hidden" name="consultation_id" id="consultation_id"
            value="{{ $dentalConsultation->id }}"><br>
        <input type="text" class="hidden" name="doctor_id" id="doctor_id" value="{{ $doctorId }}"><br>
       
    </form>


    <script src="{{ asset('asset/js/doctor_consultation/consultationWalkin.js') }}"></script>
    <style>
        .active-tab {
            background-color: #e2e8f0;
        }

        .tab-bed-rest-active {
            background-color: #e2e8f0;
        }

        .hidden {
            display: none;
        }

        #dataTable th,
        #dataTable td {
            border: 1px solid #e5e7eb;
            padding: 1rem;

        }

        #dataTable th {
            background-color: #f3f4f6;

        }
    </style>
@endsection
