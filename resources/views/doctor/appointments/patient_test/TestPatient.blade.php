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
            <a href="/doctor_index/view/{{ $appointments->id }}">
                <button class="text-xs p-2 bg-blue-950 text-white w-20 rounded-md">Back</button>
            </a>
        </div>
    </div>

    @if (session('success'))
        <div class="m-auto h-14 rounded-t border-t-2 border-t-green-600 bg-green-200 items-center" id="editsuccess"
            style="width:95%;">
            <h1 class="ml-2 font-semibold text-green-800 p-3">Medicine Successfully Updated!</h1>
        </div>
    @endif
    <!---Patient  Information-->

    @if ($doctor->department == 'physician')
        @if ($medicalConsultation)
            <form id="medicalConsultationFormUpdate" method="PUT" enctype="multipart/form-data">
                @method('PUT')
                @csrf

                <div class="bg-white mx-auto rounded-md shadow-lg p-1 mb-5" style="width: 95%; height:auto;">
                    <ul class="flex border text-sm items-center">
                        <li id="tab-1" class="tab flex-1 text-center py-2 cursor-pointer border active-tab">Basic
                            Details
                        </li>
                        <li id="tab-2" class="tab flex-1 text-center py-2 cursor-pointer border">Medication</li>
                        <li id="tab-3" class="tab flex-1 text-center py-2 cursor-pointer border">Diagnosis</li>
                        <li id="tab-4" class="tab flex-1 text-center py-2 cursor-pointer border">Injuries/Transfer</li>
                        <li id="tab-5" class="tab flex-1 text-center py-2 cursor-pointer border">Findings</li>
                        <li id="tab-7" class="tab flex-1 text-center py-2 cursor-pointer border">Discharge Summary</li>
                    </ul>
                    <div class="tab-content" id="tab-content-1">
                        <div class="w-full bg-blue-800 text-sm p-3 mt-3 text-white">
                            Assestment / Chief Complaints
                        </div>

                        <div class="flex gap-5 justify-center pt-5">
                            <div>
                                <label for="pulse_rate" class="text-xs">Pulse Rate:</label><br>
                                <input type="number" name="pulse_rate" id="pulse_rate"
                                    class="border text-xs p-2 w-72 outline-none"
                                    value="{{ $medicalConsultation->pulse_rate }}">
                            </div>
                            <div>
                                <label for="respiratory_rate" class="text-xs">Respiratory Rate:</label><br>
                                <input type="number" name="respiratory_rate" id="respiratory_rate"
                                    class="border text-xs p-2 w-72 outline-none"
                                    value="{{ $medicalConsultation->respiratory_rate }}">
                            </div>
                            <div>
                                <label for="height" class="text-xs">Height(cm):</label><br>
                                <input type="number" name="height" id="height"
                                    class="border text-xs p-2 w-72 outline-none"value="{{ $medicalConsultation->height }}">
                            </div>
                        </div>
                        <div class="flex gap-5 justify-center pt-2">
                            <div>
                                <label for="blood_pressure" class="text-xs">Blood Pressure:</label><br>
                                <input type="number" name="blood_pressure" id="blood_pressure"
                                    class="border text-xs p-2 w-72 outline-none"value="{{ $medicalConsultation->blood_pressure }}">
                            </div>
                            <div>
                                <label for="body_temp" class="text-xs">Body Temperature:</label><br>
                                <input type="number" name="body_temp" id="body_temp"
                                    class="border text-xs p-2 w-72 outline-none"value="{{ $medicalConsultation->body_temp }}">
                            </div>
                            <div>
                                <label for="weight" class="text-xs">Weight(kg):</label><br>
                                <input type="number" name="weight" id="weight"
                                    class="border text-xs p-2 w-72 outline-none"value="{{ $medicalConsultation->weight }}">
                            </div>
                        </div>

                        <div class=" mx-auto h-auto bg-white shadow-md border mt-5" style="width: 98%;">
                            <div class="text-sm p-4 text-gray-500">Quick Results</div>
                            <hr>
                            <div class="flex justify-between m-5">
                                <div>
                                    <label for="bp_category" class="text-xs text-gray-500">BLOOD PRESSURE
                                        CATEGORY</label><br>
                                    <input type="text" name="bp_category" id="bp_category"
                                        class="w-72 border outline-none text-xs p-2" disabled>
                                </div>
                                <div>
                                    <label for="bmi" class="text-xs  text-gray-500">BMI (Body Mass Index)</label><br>
                                    <input type="text" name="bmi" id="bmi"
                                        class="w-72 border outline-none text-xs p-2" disabled>
                                </div>
                                <div>
                                    <label for="bmi_category" class="text-xs  text-gray-500">BMI CATEGORY</label><br>
                                    <input type="text" name="bmi_category" id="bmi_category"
                                        class="w-72 border outline-none text-xs p-2" disabled>
                                </div>
                            </div>
                        </div>


                        <div class="mx-auto h-auto bg-white shadow-md border mt-5" style="width: 98%;">

                            <div class="flex justify-between items-center gap-5 m-5">
                                <div class="w-full">
                                    <label for="chief_complaint[]" class="text-xs text-gray-500">Chief Complaint</label><br>
                                    <input type="text" name="chief_complaint[]" id="chief_complaint"
                                        class="w-full border outline-none text-xs p-2">
                                </div>
                                <div class="w-full">
                                    <label for="other_details[]" class="text-xs text-gray-500">Other Details</label><br>
                                    <input type="text" name="other_details[]" id="other_details"
                                        class="w-full border outline-none text-xs p-2">
                                </div>
                                <div class="w-20">
                                    <div type="button" id="addButton"
                                        class="text-xs text-center bg-blue-900 p-2.5 mt-5 w-20 text-white rounded-md"
                                        style="cursor: pointer";><i class="fa-solid fa-plus"></i>Add</div>
                                </div>
                            </div>
                            <input type="hidden" name="num_complaints" id="numComplaints" value="1">
                            <div class="mb-10 mx-5 pb-10">
                                <!-- Table responsive wrapper -->
                                <div class="overflow-x-auto bg-white dark:bg-neutral-700">
                                    <!-- Table -->
                                    <table id="dataTable"
                                        class="min-w-full text-left text-xs whitespace-nowrap text-gray-600">
                                        <!-- Table head -->
                                        <thead
                                            class="uppercase tracking-wider border-b-2 dark:border-neutral-600 border-t">
                                            <tr>
                                                <th scope="col" class="px-6 py-3 border-x dark:border-neutral-600">
                                                    Description
                                                </th>
                                                <th scope="col" class="px-6 py-3 border-x dark:border-neutral-600">
                                                    Other
                                                    Details</th>
                                                <th scope="col" class="px-6 py-3 border-x dark:border-neutral-600">
                                                    Action
                                                </th>
                                            </tr>
                                        </thead>
                                        <!-- Table body -->
                                        <tbody class="text-xs mb-10" id="tableBody">
                                            @php
                                                $consultation = \App\Models\MedicalConsultation::findOrFail(
                                                    $medicalConsultation->id,
                                                );

                                                $chiefComplaints = json_decode(
                                                    json_decode($consultation->chief_complaints),
                                                    true,
                                                );
                                            @endphp

                                            @foreach ($chiefComplaints as $index => $complaint)
                                                <tr>
                                                    <td>{{ $complaint['chiefComplaint'] }}</td>
                                                    <td>{{ $complaint['otherDetails'] }}</td>
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
                                <input type="number" name="qty[]" id="qty"
                                    class="w-20 text-xs p-2 outline-none border"">
                            </div>
                        </div>
                        <div class="flex items-center gap-5">
                            <div class="m-2" style="width:85%; height:auto;">
                                <label for="instruction[]">Instruction / Remarks</label><br>
                                <textarea name="instruction[]" id="instruction" class="outline-none border w-full text-xs text-gray-500 h-20" "></textarea>
                            </div>
                            <div style="width:5%; height:auto;">
                                <div id="AddMedicine"
                                    class="text-xs text-center bg-blue-900 p-2.5 mt-5 w-20 text-white rounded-md"
                                    style="cursor: pointer";><i class="fa-solid fa-plus"></i>Add</div>
                            </div>
                        </div>
                        <input type="hidden" name="num_medicine_issuance" id="num_medicine_issuance" value="1">
                        <div class="mb-10 mx-2">
                            <!-- Table responsive wrapper -->
                            <div class="overflow-x-auto bg-white dark:bg-neutral-700">
                                <!-- Table -->
                                <table id="dataTable"
                                    class="min-w-full text-left text-xs whitespace-nowrap text-gray-600">
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
                                            $consultation = \App\Models\MedicalConsultation::findOrFail(
                                                $medicalConsultation->id,
                                            );

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
                                <input type="number" name="qty_1[]" id="qty_1"
                                    class="w-20 text-xs p-2 outline-none border"">
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
                        <input type="hidden" name="num_medicine_prescription" id="num_medicine_prescription"
                            value="1">
                        <div class="mb-10 mx-2">
                            <!-- Table responsive wrapper -->
                            <div class="overflow-x-auto bg-white dark:bg-neutral-700">
                                <!-- Table -->
                                <table id="dataTable"
                                    class="min-w-full text-left text-xs whitespace-nowrap text-gray-600">
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
                                            $consultation = \App\Models\MedicalConsultation::findOrFail(
                                                $medicalConsultation->id,
                                            );

                                            $medicinePresciption = json_decode(
                                                json_decode($consultation->medicine_prescription),
                                                true,
                                            );
                                        @endphp

                                        @foreach ($medicinePresciption as $index => $issuance)
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

                            </div>
                        </div>
                    </div>
                    <div class="tab-content p-4 hidden" id="tab-content-3">
                        <div class="w-full bg-blue-800 text-sm p-3 mt-3 text-white">
                            Clinical Diagnosis Impression / Treatment Given
                        </div>

                        <div class="flex justify-between items-center mt-5 gap-10 p-2">
                            <div class="" style="width: 90%;">
                                <div>
                                    <label for="diagnosis[]">Clinical Diagnosis</label><br>
                                    <input type="text" name="diagnosis[]" id="diagnosis"
                                        class="w-full outline-none text-xs p-2 rounded-sm border mt-2"">
                                </div>
                            </div>
                            <div class="" style="width: 10%;">
                                <div id="addDiagnosis"
                                    class="text-xs bg-blue-900 p-2.5 mt-6 w-20 text-white rounded-md text-center"
                                    style="cursor: pointer"><i class="fa-solid fa-plus"></i>Add</div>
                            </div>
                        </div>
                        <input type="hidden" name="num_diagnosis" id="num_diagnosis" value="1">
                        <div class="mb-10 mx-2">
                            <!-- Table responsive wrapper -->
                            <div class="overflow-x-auto bg-white dark:bg-neutral-700">
                                <!-- Table -->
                                <table id="dataTable"
                                    class="min-w-full text-left text-xs whitespace-nowrap text-gray-600">
                                    <!-- Table head -->
                                    <thead class="uppercase tracking-wider border-b-2 dark:border-neutral-600 border-t">
                                        <tr>

                                            <th scope="col" class="px-6 py-3 border-x dark:border-neutral-600">
                                                Description
                                            </th>
                                            <th scope="col" class="px-6 py-3 border-x dark:border-neutral-600">
                                                Action
                                            </th>

                                        </tr>
                                    </thead>
                                    <!-- Table body -->
                                    <tbody class="text-xs" id="diagnosisTableBody">
                                        @php
                                            $consultation = \App\Models\MedicalConsultation::findOrFail(
                                                $medicalConsultation->id,
                                            );

                                            $clinicalDiagnosis = json_decode(
                                                json_decode($consultation->clinical_diagnosis),
                                                true,
                                            );
                                        @endphp

                                        @foreach ($clinicalDiagnosis as $index => $diagnosis)
                                            <tr>
                                                <td>{{ $diagnosis['diagnosis'] }}</td>
                                                <td>
                                                    <div class="cursor-pointer remove-row">Remove</div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>

                                </table>

                            </div>
                        </div>

                        <div class="flex justify-between items-center mt-5 gap-10 p-2">
                            <div class="" style="width: 90%;">
                                <div>
                                    <label for="treatment[]">Treatment Given</label><br>
                                    <input type="text" name="treatment[]" id="treatment"
                                        class="w-full outline-none text-xs p-2 rounded-sm border mt-2"">
                                </div>
                            </div>
                            <div class="" style="width: 10%;">
                                <div id="addTreatment"
                                    class="text-xs bg-blue-900 p-2.5 mt-6 w-20 text-white rounded-md text-center"
                                    style="cursor: pointer"><i class="fa-solid fa-plus"></i>Add</div>
                            </div>
                        </div>
                        <input type="hidden" name="num_treatment" id="num_treatment" value="1">
                        <div class="mb-10 mx-2">
                            <!-- Table responsive wrapper -->
                            <div class="overflow-x-auto bg-white dark:bg-neutral-700">
                                <!-- Table -->
                                <table id="dataTable"
                                    class="min-w-full text-left text-xs whitespace-nowrap text-gray-600">
                                    <!-- Table head -->
                                    <thead class="uppercase tracking-wider border-b-2 dark:border-neutral-600 border-t">
                                        <tr>

                                            <th scope="col" class="px-6 py-3 border-x dark:border-neutral-600">
                                                Description
                                            </th>
                                            <th scope="col" class="px-6 py-3 border-x dark:border-neutral-600">
                                                Action
                                            </th>

                                        </tr>
                                    </thead>
                                    <!-- Table body -->
                                    <tbody class="text-xs" id="treatmentTableBody">
                                        @php
                                            $consultation = \App\Models\MedicalConsultation::findOrFail(
                                                $medicalConsultation->id,
                                            );

                                            $treatmentGiven = json_decode(
                                                json_decode($consultation->treatment_given),
                                                true,
                                            );
                                        @endphp

                                        @foreach ($treatmentGiven as $index => $treatment)
                                            <tr>
                                                <td>{{ $treatment['treatment'] }}</td>
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
                    <div class="tab-content p-4 hidden" id="tab-content-4">
                        <div class="w-full bg-blue-800 text-sm p-3 mt-3 text-white">
                            Injuries / Transfer of care
                        </div>

                        <div class="flex justify-between items-center gap-10 p-2 mt-5">
                            <div class="" style="width: 50%;">
                                <div>
                                    <label for="date[]">Date</label><br>
                                    <input type="date" name="date[]" id="date"
                                        class="w-full outline-none text-xs p-2 rounded-sm border mt-2"">
                                </div>
                            </div>
                            <div class="" style="width: 50%;">
                                <div>
                                    <label for="time[]">Time</label><br>
                                    <input type="time" name="time[]" id="time"
                                        class="w-full outline-none text-xs p-2 rounded-sm border mt-2"">
                                </div>
                            </div>
                        </div>
                        <div class="p-2" style="width:100%;">
                            <div>
                                <label for="injuries[]">Injuries</label><br>
                                <input type="text" name="injuries[]" id="injuries"
                                    class="w-full outline-none text-xs p-2 rounded-sm border mt-2"">
                            </div>
                        </div>
                        <div class="flex justify-between items-center gap-10 p-2">
                            <div class="" style="width: 90%;">
                                <div>
                                    <label for="place_of_incident[]">Place of Incident</label><br>
                                    <input type="text" name="place_of_incident[]" id="place_of_incident"
                                        class="w-full outline-none text-xs p-2 rounded-sm border mt-2"">
                                </div>
                            </div>
                            <div class="" style="width: 10%;">
                                <div id="addInjuries"
                                    class="text-xs bg-blue-900 p-2.5 mt-6 w-20 text-white rounded-md text-center"
                                    style="cursor: pointer"><i class="fa-solid fa-plus"></i>Add</div>
                            </div>
                        </div>
                        <input type="hidden" name="num_injuries" id="num_injuries" value="1">
                        <div class="mb-10 mx-2 mt-3">
                            <!-- Table responsive wrapper -->
                            <div class="overflow-x-auto bg-white dark:bg-neutral-700">
                                <!-- Table -->
                                <table id="dataTable"
                                    class="min-w-full text-left text-xs whitespace-nowrap text-gray-600">
                                    <!-- Table head -->
                                    <thead class="uppercase tracking-wider border-b-2 dark:border-neutral-600 border-t">
                                        <tr>

                                            <th scope="col" class="px-6 py-3 border-x dark:border-neutral-600">
                                                TIme
                                            </th>
                                            <th scope="col" class="px-6 py-3 border-x dark:border-neutral-600">
                                                Date
                                            </th>
                                            <th scope="col" class="px-6 py-3 border-x dark:border-neutral-600">
                                                Injuries
                                            </th>
                                            <th scope="col" class="px-6 py-3 border-x dark:border-neutral-600">
                                                Place Of Incidents
                                            </th>
                                            <th scope="col" class="px-6 py-3 border-x dark:border-neutral-600">
                                                Action
                                            </th>


                                        </tr>
                                    </thead>
                                    <!-- Table body -->
                                    <tbody class="text-xs" id="injuriesTableBody">
                                        @php
                                            $consultation = \App\Models\MedicalConsultation::findOrFail(
                                                $medicalConsultation->id,
                                            );

                                            $injuries = json_decode(json_decode($consultation->injuries), true);
                                        @endphp

                                        @foreach ($injuries as $index => $patient_injuries)
                                            <tr>
                                                <td>{{ $patient_injuries['date'] }}</td>
                                                <td>{{ $patient_injuries['time'] }}</td>
                                                <td>{{ $patient_injuries['injurie'] }}</td>
                                                <td>{{ $patient_injuries['place_of_incident'] }}</td>
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
                    <div class="tab-content p-4 hidden" id="tab-content-5">
                        <div class="w-full bg-blue-800 text-sm p-3 mt-3 text-white">
                            Vital Signs Upon Discharge
                        </div>

                        <div class="p-10 text-gray-500">
                            Vital Signs Upon Discharge
                        </div>
                        <div class="flex gap-5 justify-center pt-5">
                            <div>
                                <label for="vsud_pulse_rate" class="text-xs">Pulse Rate:</label><br>
                                <input type="number" name="vsud_pulse_rate" id="vsud_pulse_rate"
                                    class="border text-xs p-2 w-72 outline-none""
                                    value="{{ $medicalConsultation->vsud_pulse_rate }}">
                            </div>
                            <div>
                                <label for="vsud_respiratory_rate" class="text-xs">Respiratory Rate:</label><br>
                                <input type="number" name="vsud_respiratory_rate" id="vsud_respiratory_rate"
                                    class="border text-xs p-2 w-72 outline-none""
                                    value="{{ $medicalConsultation->vsud_respiratory_rate }}">
                            </div>

                        </div>
                        <div class="flex gap-5 justify-center pt-2">
                            <div>
                                <label for="vsud_blood_pressure" class="text-xs">Blood Pressure:</label><br>
                                <input type="number" name="vsud_blood_pressure" id="vsud_blood_pressure"
                                    class="border text-xs p-2 w-72 outline-none""
                                    value="{{ $medicalConsultation->vsud_blood_pressure }}">
                            </div>
                            <div>
                                <label for="vsud_body_temp" class="text-xs">Body Temperature:</label><br>
                                <input type="number" name="vsud_body_temp" id="vsud_body_temp"
                                    class="border text-xs p-2 w-72 outline-none""
                                    value="{{ $medicalConsultation->vsud_body_temp }}">
                            </div>

                        </div>
                        <div class="p-2 mt-5" style="width: 100%;">
                            <div>
                                <label for="vsud_conditional_findings">Conditional Findings</label><br>
                                <input type="text" name="vsud_conditional_findings" id="vsud_conditional_findings"
                                    class="w-full outline-none text-xs p-2 rounded-sm border mt-2""
                                    value="{{ $medicalConsultation->vsud_conditional_findings }}">
                            </div>
                        </div>
                    </div>
                    <div class="tab-content p-4 hidden" id="tab-content-7">
                        <div class="w-full bg-blue-800 text-sm p-3 mt-3 text-white">
                            Discharge Summary
                        </div>
                        <div class="ml-5 mt-5">
                            <label for="assistedBy" class="text-xs">Assisted By:</label>
                            <input type="text" name="assistedBy" id="assistedBy"
                                class="text-xs p-2 outline-none w-full border"
                                value="{{ $medicalConsultation->assistedBy }}">
                        </div>
                        <div class="ml-5">
                            <label for="other_assistant" class="text-xs">Other Assistant</label>
                            <input type="text" name="other_assistant" id="other_assistant"
                                class="text-xs p-2 outline-none w-full border"value="{{ $medicalConsultation->other_assistant }}">
                        </div>
                        <div class="ml-5">
                            <label for="nurse" class="text-xs">Nurse On Duty 1</label>

                            <select type="text" name="nurse" id="nurse"
                                class="text-xs p-2 outline-none w-full border"
                                data-selected-nurse="{{ $medicalConsultation->nurse_id_1 }}">
                                <option value="" disabled selected>Select a Nurse</option>
                                @foreach ($nurses as $nurse)
                                    <option value="{{ $nurse->id }}">{{ $nurse->name }}</option>
                                @endforeach

                            </select>
                        </div>
                        <div class="ml-5">
                            <label for="nurse_1" class="text-xs">Nurse On Duty 2</label>
                            <select type="text" name="nurse_1" id="nurse_1"
                                data-selected-nurse_1="{{ $medicalConsultation->nurse_id_2 }}"
                                class="text-xs p-2 outline-none w-full border">
                                <option value="" disabled selected>Select a Nurse</option>

                            </select>
                        </div>
                        <div class="ml-5">
                            <label for="transfferofcare" class="text-xs">Transffer of Care</label>
                            <input type="text" name="transfferofcare" id="transfferofcare"
                                class="text-xs p-2 outline-none w-full border"
                                value="{{ $medicalConsultation->transfferofcare }}">
                        </div>
                        <div class="ml-5">
                            <label for="remarks" class="text-xs">Remarks</label>
                            <textarea name="remarks" id="remarks" class="w-full h-20 border outline-none text-xs">{{ $medicalConsultation->remarks }}</textarea>
                        </div>
                        <div class="ml-5">
                            <label for="timeout" class="text-xs">Time Out</label><br>
                            <input type="time" name="timeout" id="timeout"
                                class="text-xs p-3 outline-none border w-40"value="{{ $medicalConsultation->timeout }}">
                        </div>
                        <div class="ml-5 mt-5">
                            <div class="flex gap-5">
                                <input type="checkbox">
                                <label for="#">Is this for annual medical examination? <span>(check if
                                        yes)</span></label>
                            </div>
                        </div>
                        <div>
                            <button type="submit" class="bg-blue-500 text-white ">Update</button>
                        </div>
                    </div>


                    <input type="text" class="hidden" name="consultation_id" id="consultation_id"
                        value="{{ $medicalConsultation->id }}"><br>
                    <input type="text" class="hidden" name="doctor_id" id="doctor_id"
                        value="{{ $doctorId }}"><br>
                    <input type="text" class="hidden" name="patient_id" id="patient_id"
                        value="{{ $appointments->patient->id }}"><br>
                    <input type="text" class="hidden" name="appointment_id" id="appointment_id"
                        value="{{ $appointments->id }}">
            </form>
        @else
            <form id="medicalConsultationForm" method="POST" enctype="multipart/form-data" class="mt-10">
                {{ csrf_field() }}

                <div class="bg-white mx-auto rounded-md shadow-lg p-1 mb-10" style="width: 95%; height:auto;">
                    <ul class="flex border text-sm items-center">
                        <li id="tab-1" class="tab flex-1 text-center py-2 cursor-pointer border active-tab">Basic
                            Details
                        </li>
                        <li id="tab-2" class="tab flex-1 text-center py-2 cursor-pointer border">Medication</li>
                        <li id="tab-3" class="tab flex-1 text-center py-2 cursor-pointer border">Diagnosis</li>
                        <li id="tab-4" class="tab flex-1 text-center py-2 cursor-pointer border">Injuries/Transfer
                        </li>
                        <li id="tab-5" class="tab flex-1 text-center py-2 cursor-pointer border">Findings</li>
                        <li id="tab-7" class="tab flex-1 text-center py-2 cursor-pointer border">Discharge Summary
                        </li>
                        <!-- Add more tabs as needed -->
                    </ul>
                    <div class="tab-content" id="tab-content-1">
                        <div class="w-full bg-blue-800 text-sm p-3 mt-3 text-white">
                            Assestment / Chief Complaints
                        </div>

                        <div class="flex gap-5 justify-center pt-5">
                            <div>
                                <label for="pulse_rate" class="text-xs">Pulse Rate:</label><br>
                                <input type="number" name="pulse_rate" id="pulse_rate"
                                    class="border text-xs p-2 w-72 outline-none">
                            </div>
                            <div>
                                <label for="respiratory_rate" class="text-xs">Respiratory Rate:</label><br>
                                <input type="number" name="respiratory_rate" id="respiratory_rate"
                                    class="border text-xs p-2 w-72 outline-none">
                            </div>
                            <div>
                                <label for="height" class="text-xs">Height(cm):</label><br>
                                <input type="number" name="height" id="height"
                                    class="border text-xs p-2 w-72 outline-none">
                            </div>
                        </div>
                        <div class="flex gap-5 justify-center pt-2">
                            <div>
                                <label for="blood_pressure" class="text-xs">Blood Pressure:</label><br>
                                <input type="number" name="blood_pressure" id="blood_pressure"
                                    class="border text-xs p-2 w-72 outline-none">
                            </div>
                            <div>
                                <label for="body_temp" class="text-xs">Body Temperature:</label><br>
                                <input type="number" name="body_temp" id="body_temp"
                                    class="border text-xs p-2 w-72 outline-none">
                            </div>
                            <div>
                                <label for="weight" class="text-xs">Weight(kg):</label><br>
                                <input type="number" name="weight" id="weight"
                                    class="border text-xs p-2 w-72 outline-none" min="0">

                            </div>
                        </div>

                        <div class=" mx-auto h-auto bg-white shadow-md border mt-5" style="width: 98%;">
                            <div class="text-sm p-4 text-gray-500">Quick Results</div>
                            <hr>
                            <div class="flex justify-between m-5">
                                <div>
                                    <label for="bp_category" class="text-xs text-gray-500">BLOOD PRESSURE
                                        CATEGORY</label><br>
                                    <input type="text" name="bp_category" id="bp_category"
                                        class="w-72 border outline-none text-xs p-2" disabled>
                                </div>
                                <div>
                                    <label for="bmi" class="text-xs  text-gray-500">BMI (Body Mass Index)</label><br>
                                    <input type="text" name="bmi" id="bmi"
                                        class="w-72 border outline-none text-xs p-2" disabled>
                                </div>
                                <div>
                                    <label for="bmi_category" class="text-xs  text-gray-500">BMI CATEGORY</label><br>
                                    <input type="text" name="bmi_category" id="bmi_category"
                                        class="w-72 border outline-none text-xs p-2" disabled>
                                </div>
                            </div>
                        </div>


                        <div class="mx-auto h-auto bg-white shadow-md border mt-5" style="width: 98%;">

                            <div class="flex justify-between items-center gap-5 m-5">
                                <div class="w-full">
                                    <label for="chief_complaint[]" class="text-xs text-gray-500">Chief
                                        Complaint</label><br>
                                    <input type="text" name="chief_complaint[]" id="chief_complaint"
                                        class="w-full border outline-none text-xs p-2">
                                </div>
                                <div class="w-full">
                                    <label for="other_details[]" class="text-xs text-gray-500">Other Details</label><br>
                                    <input type="text" name="other_details[]" id="other_details"
                                        class="w-full border outline-none text-xs p-2">
                                </div>
                                <div class="w-20">
                                    <div type="button" id="addButton"
                                        class="text-xs text-center bg-blue-900 p-2.5 mt-5 w-20 text-white rounded-md"
                                        style="cursor: pointer";><i class="fa-solid fa-plus"></i>Add</div>
                                </div>
                            </div>
                            <input type="hidden" name="num_complaints" id="numComplaints" value="1">
                            <div class="mb-10 mx-5 pb-10">
                                <!-- Table responsive wrapper -->
                                <div class="overflow-x-auto bg-white dark:bg-neutral-700">
                                    <!-- Table -->
                                    <table id="dataTable"
                                        class="min-w-full text-left text-xs whitespace-nowrap text-gray-600">
                                        <!-- Table head -->
                                        <thead
                                            class="uppercase tracking-wider border-b-2 dark:border-neutral-600 border-t">
                                            <tr>
                                                <th scope="col" class="px-6 py-3 border-x dark:border-neutral-600">
                                                    Description
                                                </th>
                                                <th scope="col" class="px-6 py-3 border-x dark:border-neutral-600">
                                                    Other
                                                    Details</th>
                                            </tr>
                                        </thead>
                                        <!-- Table body -->
                                        <tbody class="text-xs mb-10" id="tableBody">
                                            <!-- Data rows will be dynamically added here -->
                                        </tbody>
                                    </table>

                                </div>
                            </div>
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
                                <input type="number" name="qty[]" id="qty"
                                    class="w-20 text-xs p-2 outline-none border"">
                            </div>
                        </div>
                        <div class="flex items-center gap-5">
                            <div class="m-2" style="width:85%; height:auto;">
                                <label for="instruction[]">Instruction / Remarks</label><br>
                                <textarea name="instruction[]" id="instruction" class="outline-none border w-full text-xs text-gray-500 h-20" "></textarea>
                            </div>
                            <div style="width:5%; height:auto;">
                                <div id="AddMedicine"
                                    class="text-xs text-center bg-blue-900 p-2.5 mt-5 w-20 text-white rounded-md"
                                    style="cursor: pointer";><i class="fa-solid fa-plus"></i>Add</div>
                            </div>
                        </div>
                        <input type="hidden" name="num_medicine_issuance" id="num_medicine_issuance" value="1">
                        <div class="mb-10 mx-2">
                            <!-- Table responsive wrapper -->
                            <div class="overflow-x-auto bg-white dark:bg-neutral-700">
                                <!-- Table -->
                                <table id="dataTable"
                                    class="min-w-full text-left text-xs whitespace-nowrap text-gray-600">
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
                                <input type="number" name="qty_1[]" id="qty_1"
                                    class="w-20 text-xs p-2 outline-none border"">
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
                        <input type="hidden" name="num_medicine_prescription" id="num_medicine_prescription"
                            value="1">
                        <div class="mb-10 mx-2">
                            <!-- Table responsive wrapper -->
                            <div class="overflow-x-auto bg-white dark:bg-neutral-700">
                                <!-- Table -->
                                <table id="dataTable"
                                    class="min-w-full text-left text-xs whitespace-nowrap text-gray-600">
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

                                    </tbody>

                                </table>

                            </div>
                        </div>
                    </div>
                    <div class="tab-content p-4 hidden" id="tab-content-3">
                        <div class="w-full bg-blue-800 text-sm p-3 mt-3 text-white">
                            Clinical Diagnosis Impression / Treatment Given
                        </div>

                        <div class="flex justify-between items-center mt-5 gap-10 p-2">
                            <div class="" style="width: 90%;">
                                <div>
                                    <label for="diagnosis[]">Clinical Diagnosis</label><br>
                                    <input type="text" name="diagnosis[]" id="diagnosis"
                                        class="w-full outline-none text-xs p-2 rounded-sm border mt-2"">
                                </div>
                            </div>
                            <div class="" style="width: 10%;">
                                <div id="addDiagnosis"
                                    class="text-xs bg-blue-900 p-2.5 mt-6 w-20 text-white rounded-md text-center"
                                    style="cursor: pointer"><i class="fa-solid fa-plus"></i>Add</div>
                            </div>
                        </div>
                        <input type="hidden" name="num_diagnosis" id="num_diagnosis" value="1">
                        <div class="mb-10 mx-2">
                            <!-- Table responsive wrapper -->
                            <div class="overflow-x-auto bg-white dark:bg-neutral-700">
                                <!-- Table -->
                                <table id="dataTable"
                                    class="min-w-full text-left text-xs whitespace-nowrap text-gray-600">
                                    <!-- Table head -->
                                    <thead class="uppercase tracking-wider border-b-2 dark:border-neutral-600 border-t">
                                        <tr>
                                            <th scope="col" class="px-2 py-3 border-x dark:border-neutral-600">
                                                ID
                                            </th>
                                            <th scope="col" class="px-6 py-3 border-x dark:border-neutral-600">
                                                Description
                                            </th>
                                            <th scope="col" class="px-6 py-3 border-x dark:border-neutral-600">
                                                Action
                                            </th>

                                        </tr>
                                    </thead>
                                    <!-- Table body -->
                                    <tbody class="text-xs" id="diagnosisTableBody">

                                    </tbody>

                                </table>

                            </div>
                        </div>

                        <div class="flex justify-between items-center mt-5 gap-10 p-2">
                            <div class="" style="width: 90%;">
                                <div>
                                    <label for="treatment[]">Treatment Given</label><br>
                                    <input type="text" name="treatment[]" id="treatment"
                                        class="w-full outline-none text-xs p-2 rounded-sm border mt-2"">
                                </div>
                            </div>
                            <div class="" style="width: 10%;">
                                <div id="addTreatment"
                                    class="text-xs bg-blue-900 p-2.5 mt-6 w-20 text-white rounded-md text-center"
                                    style="cursor: pointer"><i class="fa-solid fa-plus"></i>Add</div>
                            </div>
                        </div>
                        <input type="hidden" name="num_treatment" id="num_treatment" value="1">
                        <div class="mb-10 mx-2">
                            <!-- Table responsive wrapper -->
                            <div class="overflow-x-auto bg-white dark:bg-neutral-700">
                                <!-- Table -->
                                <table id="dataTable"
                                    class="min-w-full text-left text-xs whitespace-nowrap text-gray-600">
                                    <!-- Table head -->
                                    <thead class="uppercase tracking-wider border-b-2 dark:border-neutral-600 border-t">
                                        <tr>
                                            <th scope="col" class="px-2 py-3 border-x dark:border-neutral-600">
                                                ID
                                            </th>
                                            <th scope="col" class="px-6 py-3 border-x dark:border-neutral-600">
                                                Description
                                            </th>
                                            <th scope="col" class="px-6 py-3 border-x dark:border-neutral-600">
                                                Action
                                            </th>

                                        </tr>
                                    </thead>
                                    <!-- Table body -->
                                    <tbody class="text-xs" id="treatmentTableBody">

                                    </tbody>

                                </table>

                            </div>
                        </div>
                    </div>
                    <div class="tab-content p-4 hidden" id="tab-content-4">
                        <div class="w-full bg-blue-800 text-sm p-3 mt-3 text-white">
                            Injuries / Transfer of care
                        </div>

                        <div class="flex justify-between items-center gap-10 p-2 mt-5">
                            <div class="" style="width: 50%;">
                                <div>
                                    <label for="date[]">Date</label><br>
                                    <input type="date" name="date[]" id="date"
                                        class="w-full outline-none text-xs p-2 rounded-sm border mt-2"">
                                </div>
                            </div>
                            <div class="" style="width: 50%;">
                                <div>
                                    <label for="time[]">Time</label><br>
                                    <input type="time" name="time[]" id="time"
                                        class="w-full outline-none text-xs p-2 rounded-sm border mt-2"">
                                </div>
                            </div>
                        </div>
                        <div class="p-2" style="width:100%;">
                            <div>
                                <label for="injuries[]">Injuries</label><br>
                                <input type="text" name="injuries[]" id="injuries"
                                    class="w-full outline-none text-xs p-2 rounded-sm border mt-2"">
                            </div>
                        </div>
                        <div class="flex justify-between items-center gap-10 p-2">
                            <div class="" style="width: 90%;">
                                <div>
                                    <label for="place_of_incident[]">Place of Incident</label><br>
                                    <input type="text" name="place_of_incident[]" id="place_of_incident"
                                        class="w-full outline-none text-xs p-2 rounded-sm border mt-2"">
                                </div>
                            </div>
                            <div class="" style="width: 10%;">
                                <div id="addInjuries"
                                    class="text-xs bg-blue-900 p-2.5 mt-6 w-20 text-white rounded-md text-center"
                                    style="cursor: pointer"><i class="fa-solid fa-plus"></i>Add</div>
                            </div>
                        </div>
                        <input type="hidden" name="num_injuries" id="num_injuries" value="1">
                        <div class="mb-10 mx-2 mt-3">
                            <!-- Table responsive wrapper -->
                            <div class="overflow-x-auto bg-white dark:bg-neutral-700">
                                <!-- Table -->
                                <table id="dataTable"
                                    class="min-w-full text-left text-xs whitespace-nowrap text-gray-600">
                                    <!-- Table head -->
                                    <thead class="uppercase tracking-wider border-b-2 dark:border-neutral-600 border-t">
                                        <tr>
                                            <th scope="col" class="px-2 py-3 border-x dark:border-neutral-600">
                                                No.
                                            </th>
                                            <th scope="col" class="px-6 py-3 border-x dark:border-neutral-600">
                                                TIme
                                            </th>
                                            <th scope="col" class="px-6 py-3 border-x dark:border-neutral-600">
                                                Date
                                            </th>
                                            <th scope="col" class="px-6 py-3 border-x dark:border-neutral-600">
                                                Injuries
                                            </th>
                                            <th scope="col" class="px-6 py-3 border-x dark:border-neutral-600">
                                                Place Of Incidents
                                            </th>
                                            <th scope="col" class="px-6 py-3 border-x dark:border-neutral-600">
                                                Action
                                            </th>


                                        </tr>
                                    </thead>
                                    <!-- Table body -->
                                    <tbody class="text-xs" id="injuriesTableBody">

                                    </tbody>

                                </table>

                            </div>
                        </div>
                    </div>
                    <div class="tab-content p-4 hidden" id="tab-content-5">
                        <div class="w-full bg-blue-800 text-sm p-3 mt-3 text-white">
                            Vital Signs Upon Discharge
                        </div>

                        <div class="p-10 text-gray-500">
                            Vital Signs Upon Discharge
                        </div>
                        <div class="flex gap-5 justify-center pt-5">
                            <div>
                                <label for="vsud_pulse_rate" class="text-xs">Pulse Rate:</label><br>
                                <input type="number" name="vsud_pulse_rate" id="vsud_pulse_rate"
                                    class="border text-xs p-2 w-72 outline-none"">
                            </div>
                            <div>
                                <label for="vsud_respiratory_rate" class="text-xs">Respiratory Rate:</label><br>
                                <input type="number" name="vsud_respiratory_rate" id="vsud_respiratory_rate"
                                    class="border text-xs p-2 w-72 outline-none"">
                            </div>

                        </div>
                        <div class="flex gap-5 justify-center pt-2">
                            <div>
                                <label for="vsud_blood_pressure" class="text-xs">Blood Pressure:</label><br>
                                <input type="number" name="vsud_blood_pressure" id="vsud_blood_pressure"
                                    class="border text-xs p-2 w-72 outline-none"">
                            </div>
                            <div>
                                <label for="vsud_body_temp" class="text-xs">Body Temperature:</label><br>
                                <input type="number" name="vsud_body_temp" id="vsud_body_temp"
                                    class="border text-xs p-2 w-72 outline-none"">
                            </div>

                        </div>
                        <div class="p-2 mt-5" style="width: 100%;">
                            <div>
                                <label for="vsud_conditional_findings">Conditional Findings</label><br>
                                <input type="text" name="vsud_conditional_findings" id="vsud_conditional_findings"
                                    class="w-full outline-none text-xs p-2 rounded-sm border mt-2"">
                            </div>
                        </div>
                    </div>
                    <div class="tab-content p-4 hidden" id="tab-content-7">
                        <div class="w-full bg-blue-800 text-sm p-3 mt-3 text-white">
                            Discharge Summary
                        </div>
                        <div class="ml-5 mt-5">
                            <label for="assistedBy" class="text-xs">Assisted By:</label>
                            <input type="text" name="assistedBy" id="assistedBy"
                                class="text-xs p-2 outline-none w-full border">
                        </div>
                        <div class="ml-5">
                            <label for="other_assistant" class="text-xs">Other Assistant</label>
                            <input type="text" name="other_assistant" id="other_assistant"
                                class="text-xs p-2 outline-none w-full border">
                        </div>
                        <div class="ml-5">
                            <label for="nurse" class="text-xs">Nurse On Duty 1</label>
                            <select type="text" name="nurse" id="nurse"
                                class="text-xs p-2 outline-none w-full border">
                                <option value="" disabled selected>Select a Nurse</option>

                            </select>
                        </div>
                        <div class="ml-5">
                            <label for="nurse_1" class="text-xs">Nurse On Duty 2</label>
                            <select type="text" name="nurse_1" id="nurse_1"
                                class="text-xs p-2 outline-none w-full border">
                                <option value="" disabled selected>Select a Nurse</option>

                            </select>
                        </div>
                        <div class="ml-5">
                            <label for="transfferofcare" class="text-xs">Transffer of Care</label>
                            <input type="text" name="transfferofcare" id="transfferofcare"
                                class="text-xs p-2 outline-none w-full border">
                        </div>
                        <div class="ml-5">
                            <label for="remarks" class="text-xs">Remarks</label>
                            <textarea name="remarks" id="remarks" class="w-full h-20 border outline-none text-xs"></textarea>
                        </div>
                        <div class="ml-5">
                            <label for="timeout" class="text-xs">Time Out</label><br>
                            <input type="time" name="timeout" id="timeout"
                                class="text-xs p-3 outline-none border w-40">
                        </div>
                        <div class="ml-5 mt-5">
                            <div class="flex gap-5">
                                <input type="checkbox">
                                <label for="#">Is this for annual medical examination? <span>(check if
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

                    <input type="text" class="hidden" name="doctor_id" id="doctor_id"
                        value="{{ $doctorId }}"><br>
                    <input type="text" class="hidden" name="patient_id" id="patient_id"
                        value="{{ $appointments->patient->id }}"><br>
                    <input type="text" class="hidden" name="appointment_id" id="appointment_id"
                        value="{{ $appointments->id }}">
            </form>
        @endif
    @elseif($doctor->department == 'dentist')
        @if ($dentalConsultation)
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
                                <input type="number" name="qty[]" id="qty"
                                    class="w-20 text-xs p-2 outline-none border"">
                            </div>
                        </div>
                        <div class="flex items-center gap-5">
                            <div class="m-2" style="width:85%; height:auto;">
                                <label for="instruction[]">Instruction / Remarks</label><br>
                                <textarea name="instruction[]" id="instruction" class="outline-none border w-full text-xs text-gray-500 h-20" "></textarea>
                            </div>
                            <div style="width:5%; height:auto;">
                                <div id="AddMedicine"
                                    class="text-xs text-center bg-blue-900 p-2.5 mt-5 w-20 text-white rounded-md"
                                    style="cursor: pointer";><i class="fa-solid fa-plus"></i>Add</div>
                            </div>
                        </div>
                        <input type="hidden" name="num_medicine_issuance" id="num_medicine_issuance"
                            value="1">
                        <div class="mb-10 mx-2">
                            <!-- Table responsive wrapper -->
                            <div class="overflow-x-auto bg-white dark:bg-neutral-700">
                                <!-- Table -->
                                <table id="dataTable"
                                    class="min-w-full text-left text-xs whitespace-nowrap text-gray-600">
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
                                            $consultation = \App\Models\DentalConsultation::findOrFail(
                                                $dentalConsultation->id,
                                            );

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
                                <input type="number" name="qty_1[]" id="qty_1"
                                    class="w-20 text-xs p-2 outline-none border"">
                            </div>
                        </div>
                        <div class="flex items-center gap-5">
                            <div class="m-2" style="width:85%; height:auto;">
                                <label for="instruction_1[]">Instruction / Remarks</label><br>
                                <textarea name="instruction_1[]" id="instruction_1"
                                    class="outline-none border w-full text-xs text-gray-500 h-20""></textarea>
                            </div>
                            <div style="width:5%; height:auto;">
                                <div id="AddMedicinePrescription"
                                    class="text-xs bg-blue-900 p-2.5 mt-5 w-20 text-white rounded-md text-center"
                                    style="cursor: pointer";><i class="fa-solid fa-plus"></i>Add</div>
                            </div>
                        </div>
                        <input type="hidden" name="num_medicine_prescription" id="num_medicine_prescription"
                            value="1">
                        <div class="mb-10 mx-2">
                            <!-- Table responsive wrapper -->
                            <div class="overflow-x-auto bg-white dark:bg-neutral-700">
                                <!-- Table -->
                                <table id="dataTable"
                                    class="min-w-full text-left text-xs whitespace-nowrap text-gray-600">
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
                                            $consultation = \App\Models\DentalConsultation::findOrFail(
                                                $dentalConsultation->id,
                                            );

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
                              <div class="m-5"> <input type="checkbox" name="oral_health_condition[]" id="oral_health_condition" value="CALCULUS" {{ str_contains($dentalConsultation->oral_health_condition, 'CALCULUS') ? 'checked' : '' }}><span class="text-sm ml-5">CALCULUS</span><br> </div>
                              <div class="m-5"> <input type="checkbox" name="oral_health_condition[]"id="oral_health_condition" value="CARIES"{{ str_contains($dentalConsultation->oral_health_condition, 'CARIES') ? 'checked' : '' }}><span class="text-sm ml-5">CARIES</span><br> </div>
                              <div class="m-5"> <input type="checkbox" name="oral_health_condition[]"id="oral_health_condition" value="CLEFT PLATE"{{ str_contains($dentalConsultation->oral_health_condition, 'CLEFT PLATE') ? 'checked' : '' }}><span class="text-sm ml-5">CLEFT PLATE</span><br> </div>
                              <div class="m-5"> <input type="checkbox" name="oral_health_condition[]"id="oral_health_condition" value="DEBRIS"{{ str_contains($dentalConsultation->oral_health_condition, 'DEBRIS') ? 'checked' : '' }}><span class="text-sm ml-5">DEBRIS</span><br> </div>
                              <div class="m-5"> <input type="checkbox" name="oral_health_condition[]"id="oral_health_condition" value="GINGIVITIS"{{ str_contains($dentalConsultation->oral_health_condition, 'GINGIVITIS') ? 'checked' : '' }}><span class="text-sm ml-5">GINGIVITIS</span><br> </div>
                              <div class="m-5"> <input type="checkbox" name="oral_health_condition[]"id="oral_health_condition" value="NEOPLASM"{{ str_contains($dentalConsultation->oral_health_condition, 'NEOPLASM') ? 'checked' : '' }}><span class="text-sm ml-5">NEOPLASM</span><br> </div>
                           </div>
                           <div>
                              <div class="m-5"> <input type="checkbox" name="oral_health_condition[]"id="oral_health_condition" value="P.POCKETS"{{ str_contains($dentalConsultation->oral_health_condition, 'P.POCKETS') ? 'checked' : '' }}><span class="text-sm ml-5">P.POCKETS</span><br> </div>
                              <div class="m-5"> <input type="checkbox" name="oral_health_condition[]"id="oral_health_condition" value="ROOT FRAGMENT"{{ str_contains($dentalConsultation->oral_health_condition, 'ROOT FRAGMENT') ? 'checked' : '' }}><span class="text-sm ml-5">ROOT FRAGMENT </span><br> </div>
                           </div>
                        </div>
                        {{-- sr --}}
                        <div class="w-full bg-blue-800 text-sm p-3 mt-3 text-white"> Service Rendered </div>
                        <div class="flex">
                           <div>
                              <div class="m-5"> <input type="checkbox" name="services_rendered[]" id="services_rendered" value="AMALGAM FILLING"{{ str_contains($dentalConsultation->services_rendered, 'AMALGAM FILLING') ? 'checked' : '' }}><span class="text-sm ml-5">AMALGAM FILLING</span><br> </div>
                              <div class="m-5"> <input type="checkbox" name="services_rendered[]"id="services_rendered" value="COMPOSITE FILLING"{{ str_contains($dentalConsultation->services_rendered, 'COMPOSITE FILLING') ? 'checked' : '' }}><span class="text-sm ml-5">COMPOSITE FILLING</span><br> </div>
                              <div class="m-5"> <input type="checkbox" name="services_rendered[]" id="services_rendered"value="CONSULTATION"{{ str_contains($dentalConsultation->services_rendered, 'CONSULTATION') ? 'checked' : '' }}><span class="text-sm ml-5">CONSULTATION</span><br> </div>
                              <div class="m-5"> <input type="checkbox" name="services_rendered[]"id="services_rendered" value="DENTAL CERTIFICATE"{{ str_contains($dentalConsultation->services_rendered, 'DENTAL CERTIFICATE') ? 'checked' : '' }}><span class="text-sm ml-5">DENTAL CERTIFICATE</span><br> </div>
                              <div class="m-5"> <input type="checkbox" name="services_rendered[]" id="services_rendered"value="DENTAL PRO PROPHYLAXIS"{{ str_contains($dentalConsultation->services_rendered, 'DENTAL PRO PROPHYLAXIS') ? 'checked' : '' }}><span class="text-sm ml-5">DENTAL PRO PROPHYLAXIS</span><br> </div>
                              <div class="m-5"> <input type="checkbox" name="services_rendered[]"id="services_rendered" value="EMERGENCY TREATMENT"{{ str_contains($dentalConsultation->services_rendered, 'EMERGENCY TREATMENT') ? 'checked' : '' }}><span class="text-sm ml-5">EMERGENCY TREATMENT</span><br> </div>
                              <div class="m-5"> <input type="checkbox" name="services_rendered[]" id="services_rendered"value="BRIDGE WORK"{{ str_contains($dentalConsultation->services_rendered, 'BRIDGE WORK') ? 'checked' : '' }}><span class="text-sm ml-5">BRIDGE WORK</span><br> </div>
                           </div>
                           <div>
                              <div class="m-5"> <input type="checkbox" name="services_rendered[]" id="services_rendered"value="FLOURIDE THERAPY"{{ str_contains($dentalConsultation->services_rendered, 'FLOURIDE THERAPY') ? 'checked' : '' }}><span class="text-sm ml-5">FLOURIDE THERAPY</span><br> </div>
                              <div class="m-5"> <input type="checkbox" name="services_rendered[]" id="services_rendered"value="ROOT FRAGMENT"{{ str_contains($dentalConsultation->services_rendered, 'ROOT FRAGMENT') ? 'checked' : '' }}><span class="text-sm ml-5">ROOT FRAGMENT </span><br> </div>
                              <div class="m-5"> <input type="checkbox" name="services_rendered[]"id="services_rendered" value="CLEFT PLATE"{{ str_contains($dentalConsultation->services_rendered, 'CLEFT PLATE') ? 'checked' : '' }}><span class="text-sm ml-5">CLEFT PLATE</span><br> </div>
                              <div class="m-5"> <input type="checkbox" name="services_rendered[]" id="services_rendered"value="DENTAL BONDING"{{ str_contains($dentalConsultation->services_rendered, 'DENTAL BONDING') ? 'checked' : '' }}><span class="text-sm ml-5">DENTAL BONDING</span><br> </div>
                              <div class="m-5"> <input type="checkbox" name="services_rendered[]"id="services_rendered" value="DENTURES"{{ str_contains($dentalConsultation->services_rendered, 'DENTURES') ? 'checked' : '' }}><span class="text-sm ml-5">DENTURES</span><br> </div>
                              <div class="m-5"> <input type="checkbox" name="services_rendered[]"id="services_rendered" value="TEETH WHITENING"{{ str_contains($dentalConsultation->services_rendered, 'TEETH WHITENING') ? 'checked' : '' }}><span class="text-sm ml-5">TEETH WHITENING</span><br> </div>
                              <div class="m-5"> <input type="checkbox" name="services_rendered[]" id="services_rendered"value="TOOTH EXTRACTIONS"{{ str_contains($dentalConsultation->services_rendered, 'TOOTH EXTRACTIONS') ? 'checked' : '' }}><span class="text-sm ml-5">TOOTH EXTRACTIONS</span><br> </div>
                           </div>
                        </div>
                    </div>
                    <div class="tab-content hidden" id="tab-content-4">
                        <div class="w-full bg-blue-800 text-sm p-3 mt-3 text-white">
                            Discharge Summary
                        </div>
                        <div class="ml-5">
                            <label for="nurse" class="text-xs">Nurse On Duty 1</label>

                            <select type="text" name="nurse" id="nurse"
                                class="text-xs p-2 outline-none w-full border"
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
                <input type="text" class="hidden" name="doctor_id" id="doctor_id"
                    value="{{ $doctorId }}"><br>
                <input type="text" class="hidden" name="patient_id" id="patient_id"
                    value="{{ $appointments->patient->id }}"><br>
                <input type="text" class="hidden" name="appointment_id" id="appointment_id"
                    value="{{ $appointments->id }}">
            </form>
        @else
          
            <form action="#" id="dentalConsultationForm">
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
                                <input type="number" name="qty[]" id="qty"
                                    class="w-20 text-xs p-2 outline-none border"">
                            </div>
                        </div>
                        <div class="flex items-center gap-5">
                            <div class="m-2" style="width:85%; height:auto;">
                                <label for="instruction[]">Instruction / Remarks</label><br>
                                <textarea name="instruction[]" id="instruction" class="outline-none border w-full text-xs text-gray-500 h-20" "></textarea>
                            </div>
                            <div style="width:5%; height:auto;">
                                <div id="AddMedicine"
                                    class="text-xs text-center bg-blue-900 p-2.5 mt-5 w-20 text-white rounded-md"
                                    style="cursor: pointer";><i class="fa-solid fa-plus"></i>Add</div>
                            </div>
                        </div>
                        <input type="hidden" name="num_medicine_issuance" id="num_medicine_issuance"
                            value="1">
                        <div class="mb-10 mx-2">
                            <!-- Table responsive wrapper -->
                            <div class="overflow-x-auto bg-white dark:bg-neutral-700">
                                <!-- Table -->
                                <table id="dataTable"
                                    class="min-w-full text-left text-xs whitespace-nowrap text-gray-600">
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
                                <input type="number" name="qty_1[]" id="qty_1"
                                    class="w-20 text-xs p-2 outline-none border"">
                            </div>
                        </div>
                        <div class="flex items-center gap-5">
                            <div class="m-2" style="width:85%; height:auto;">
                                <label for="instruction_1[]">Instruction / Remarks</label><br>
                                <textarea name="instruction_1[]" id="instruction_1"
                                    class="outline-none border w-full text-xs text-gray-500 h-20""></textarea>
                            </div>
                            <div style="width:5%; height:auto;">
                                <div id="AddMedicinePrescription"
                                    class="text-xs bg-blue-900 p-2.5 mt-5 w-20 text-white rounded-md text-center"
                                    style="cursor: pointer";><i class="fa-solid fa-plus"></i>Add</div>
                            </div>
                        </div>
                        <input type="hidden" name="num_medicine_prescription" id="num_medicine_prescription"
                            value="1">
                        <div class="mb-10 mx-2">
                            <!-- Table responsive wrapper -->
                            <div class="overflow-x-auto bg-white dark:bg-neutral-700">
                                <!-- Table -->
                                <table id="dataTable"
                                    class="min-w-full text-left text-xs whitespace-nowrap text-gray-600">
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

                                    </tbody>

                                </table>

                            </div>
                        </div>
                    </div>
                    <div class="tab-content hidden" id="tab-content-3">
                        <div class="w-full bg-blue-800 text-sm p-3 mt-3 text-white">
                            Oral Health Condition
                        </div>
                        <div class="flex">
                            <div>
                                <div class="m-5">
                                    <input type="checkbox" name="oral_health_condition[]" value="CALCULUS"><span
                                        class="text-sm ml-5">CALCULUS</span><br>
                                </div>
                                <div class="m-5">
                                    <input type="checkbox" name="oral_health_condition[]" value="CARIES"><span
                                        class="text-sm ml-5">CARIES</span><br>
                                </div>
                                <div class="m-5">
                                    <input type="checkbox" name="oral_health_condition[]" value="CLEFT PLATE"><span
                                        class="text-sm ml-5">CLEFT PLATE</span><br>
                                </div>
                                <div class="m-5">
                                    <input type="checkbox" name="oral_health_condition[]" value="DEBRIS"><span
                                        class="text-sm ml-5">DEBRIS</span><br>
                                </div>
                                <div class="m-5">
                                    <input type="checkbox" name="oral_health_condition[]" value="GINGIVITIS"><span
                                        class="text-sm ml-5">GINGIVITIS</span><br>
                                </div>
                                <div class="m-5">
                                    <input type="checkbox" name="oral_health_condition[]" value="NEOPLASM"><span
                                        class="text-sm ml-5">NEOPLASM</span><br>
                                </div>
                            </div>
                            <div>
                                <div class="m-5">
                                    <input type="checkbox" name="oral_health_condition[]" value="P.POCKETS"><span
                                        class="text-sm ml-5">P.POCKETS</span><br>
                                </div>
                                <div class="m-5">
                                    <input type="checkbox" name="oral_health_condition[]" value="ROOT FRAGMENT"><span
                                        class="text-sm ml-5">ROOT FRAGMENT </span><br>
                                </div>
                                <div class="m-5">
                                    <input type="checkbox" name="oral_health_condition[]" value="CLEFT PLATE"><span
                                        class="text-sm ml-5">CLEFT PLATE</span><br>
                                </div>
                                <div class="m-5">
                                    <input type="checkbox" name="oral_health_condition[]" value="DEBRIS"><span
                                        class="text-sm ml-5">DEBRIS</span><br>
                                </div>
                                <div class="m-5">
                                    <input type="checkbox" name="oral_health_condition[]" value="GINGIVITIS"><span
                                        class="text-sm ml-5">GINGIVITIS</span><br>
                                </div>
                            </div>
                        </div>

                        {{-- sr --}}
                        <div class="w-full bg-blue-800 text-sm p-3 mt-3 text-white">
                            Service Rendered
                        </div>
                        <div class="flex">
                            <div>
                                <div class="m-5">
                                    <input type="checkbox" name="services_rendered[]" value="AMALGAM FILLING"><span
                                        class="text-sm ml-5">AMALGAM FILLING</span><br>
                                </div>
                                <div class="m-5">
                                    <input type="checkbox" name="services_rendered[]" value="COMPOSITE FILLING"><span
                                        class="text-sm ml-5">COMPOSITE FILLING</span><br>
                                </div>
                                <div class="m-5">
                                    <input type="checkbox" name="services_rendered[]" value="CONSULTATION"><span
                                        class="text-sm ml-5">CONSULTATION</span><br>
                                </div>
                                <div class="m-5">
                                    <input type="checkbox" name="services_rendered[]" value="DENTAL CERTIFICATE"><span
                                        class="text-sm ml-5">DENTAL CERTIFICATE</span><br>
                                </div>
                                <div class="m-5">
                                    <input type="checkbox" name="services_rendered[]"
                                        value="DENTAL PRO PROPHYLAXIS"><span class="text-sm ml-5">DENTAL PRO
                                        PROPHYLAXIS</span><br>
                                </div>
                                <div class="m-5">
                                    <input type="checkbox" name="services_rendered[]"
                                        value="EMERGENCY TREATMENT"><span class="text-sm ml-5">EMERGENCY
                                        TREATMENT</span><br>
                                </div>
                                <div class="m-5">
                                    <input type="checkbox" name="services_rendered[]" value="BRIDGE WORK"><span
                                        class="text-sm ml-5">BRIDGE WORK</span><br>
                                </div>
                            </div>
                            <div>
                                <div class="m-5">
                                    <input type="checkbox" name="services_rendered[]" value="FLOURIDE THERAPY"><span
                                        class="text-sm ml-5">FLOURIDE THERAPY</span><br>
                                </div>
                                <div class="m-5">
                                    <input type="checkbox" name="services_rendered[]" value="ROOT FRAGMENT"><span
                                        class="text-sm ml-5">ROOT FRAGMENT </span><br>
                                </div>
                                <div class="m-5">
                                    <input type="checkbox" name="services_rendered[]" value="CLEFT PLATE"><span
                                        class="text-sm ml-5">CLEFT PLATE</span><br>
                                </div>
                                <div class="m-5">
                                    <input type="checkbox" name="services_rendered[]" value="DENTAL BONDING"><span
                                        class="text-sm ml-5">DENTAL BONDING</span><br>
                                </div>
                                <div class="m-5">
                                    <input type="checkbox" name="services_rendered[]" value="DENTURES"><span
                                        class="text-sm ml-5">DENTURES</span><br>
                                </div>
                                <div class="m-5">
                                    <input type="checkbox" name="services_rendered[]" value="TEETH WHITENING"><span
                                        class="text-sm ml-5">TEETH WHITENING</span><br>
                                </div>
                                <div class="m-5">
                                    <input type="checkbox" name="services_rendered[]" value="TOOTH EXTRACTIONS"><span
                                        class="text-sm ml-5">TOOTH EXTRACTIONS</span><br>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-content hidden" id="tab-content-4">
                        <div class="w-full bg-blue-800 text-sm p-3 mt-3 text-white">
                            Discharge Summary
                        </div>
                        <div class="ml-5">
                            <label for="nurse" class="text-xs">Assisted By <span>(nurse 1)</span></label>
                            <select type="text" name="nurse" id="nurse"
                                class="text-xs p-2 outline-none w-full border">
                                <option value="" disabled selected>Select a Nurse</option>

                            </select>
                        </div>
                        <div class="ml-5">
                            <label for="nurse_1" class="text-xs">Assisted By <span>(nurse 2)</label>
                            <select type="text" name="nurse_1" id="nurse_1"
                                class="text-xs p-2 outline-none w-full border">
                                <option value="" disabled selected>Select a Nurse</option>

                            </select>
                        </div>
                        <div class="ml-5">
                            <label for="other_assistant" class="text-xs">Other Assistant</label>
                            <input type="text" name="other_assistant" id="other_assistant"
                                class="text-xs p-2 outline-none w-full border">
                        </div>

                        <div class="ml-5">
                            <label for="dentist_on_duty" class="text-xs">Dentist On Duty</label>
                            <input type="text" name="dentist_on_duty" id="dentist_on_duty"
                                class="text-xs p-2 outline-none w-full border" value="{{ $doctor->name }}" disabled>
                        </div>
                        <div class="ml-5">
                            <label for="follow_up" class="text-xs">Follow Up</label>
                            <input type="text" name="follow_up" id="follow_up"
                                class="text-xs p-2 outline-none w-full border">
                        </div>
                        <div class="ml-5">
                            <label for="remarks" class="text-xs">Remarks</label>
                            <textarea name="remarks" id="remarks" class="w-full h-20 border outline-none text-xs"></textarea>
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
                <input type="text" class="hidden" name="doctor_id" id="doctor_id"
                    value="{{ $doctorId }}"><br>
                <input type="text" class="hidden" name="patient_id" id="patient_id"
                    value="{{ $appointments->patient->id }}"><br>
                <input type="text" class="hidden" name="appointment_id" id="appointment_id"
                    value="{{ $appointments->id }}">
            </form>
        @endif
    @endif


    <script src="{{ asset('asset/js/doctor_consultation/consultation.js') }}"></script>
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
