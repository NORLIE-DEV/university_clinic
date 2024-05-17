@extends('layout.doctor_layout')

@section('content')
    <div class="bg-white shadow-lg mt-5 mx-auto" style="width: 98%; height:auto;">
        <div class="flex justify-end p-3 text-xs">
            <button onclick="window.history.back()"
                class="bg-blue-900 p-2 w-10 text-center text-white rounded-sm shadow-md">X</button>
        </div>
        <form id="sickleaveform">
            <div class="text-center py-3 font-medium text-gray-500">
                MEDICAL CERTIFICATE DATA ENTRY
            </div>
            <hr class="mt-3">
            <div class="pt-10 px-10 font-medium text-gray-500 text-md">
                MEDICAL CERTIFICATE DETAILS
            </div>
            <div class="flex justify-end">
                <div class="">
                    <label for="certificateID" class=" text-gray-500">CERTIFICATE NO.</label>
                    <input type="text" id="certificateID" name="certificateID" class=" font-medium mt-4" disabled>
                </div>
            </div>
            <div class="flex justify-between items-center m-5">
                <div class="px-5 p-2 w-1/2">
                    <label for="#" class=" text-gray-500 text-sm">Patient Name </label><br>
                    <input type="text"class="mt-2 uppercase text-xs p-2.5 border w-full"
                        value="{{ $patient->student->first_name ?? ($patient->employee->first_name ?? '') }} {{ $patient->student->last_name ?? ($patient->employee->last_name ?? '') }}
                    "disabled>
                </div>
                <div class="px-5 p-2 w-1/2">
                    <label for="date_issue" class=" text-gray-500 text-sm">Date Issue</label><br>
                    <input type="date" name="date_issue" id="date_issue" class="mt-2 text-xs p-2.5 border w-full">
                </div>
            </div>
            <div class="flex justify-between items-center m-5">
                <div class="w-1/2 px-5 p-2">
                    <label for="absent_from" class="text-sm text-gray-500">Absent From</label><br>
                    <input type="date" name="absent_from" id="absent_from" class="text-xs p-2.5 w-full border mt-2">
                </div>
                <div class="w-1/2 px-5 p-2">
                    <label for="absent_to" class="text-sm text-gray-500">Absent To</label><br>
                    <input type="date" name="absent_to" id="absent_to" class="w-full text-xs p-2.5 border mt-2">
                </div>
                <div class="w-1/2 px-5 p-2">
                    <label for="number_days_absent" class="text-sm text-gray-500">Number Days of Absent</label><br>
                    <input type="number" name="number_days_absent" id="number_days_absent"
                        class="outline-none w-full text-xs p-2.5 border mt-2" min="1">
                </div>
            </div>
            <div class="flex justify-between items-center mx-5">
                <div class="px-5 p-2 w-full">
                    <label for="reason" class="text-sm text-gray-500">Reason of Absence</label><br>
                    <textarea name="reason" id="reason" class="outline-none border w-full p-3 text-xs mt-2 h-32"></textarea>
                </div>
            </div>
            <div class="flex justify-between items-center mx-5">
                <div class="px-5 p-2 w-full">
                    <label for="findings" class="text-sm text-gray-500">Clinical Findings</label><br>
                    <textarea name="findings" id="findings" class="outline-none border w-full p-3 text-xs mt-2 h-32"></textarea>
                </div>
            </div>
            <div class="flex justify-between items-center mx-5">
                <div class="px-5 p-2 w-full">
                    <label for="remarks" class="text-sm text-gray-500">Remarks</label><br>
                    <textarea name="remarks" id="remarks" class="outline-none border w-full p-3 text-xs mt-2 h-32"></textarea>
                </div>
            </div>
            <div class="px-5 mt-5 hidden">
                <label for="doctor_id" class="font-medium text-gray-500">DOCTOR NO.</label>
                <input type="text" id="doctor_id" name="doctor_id" value="{{ $doctorId }}" class=" font-medium mt-4"
                    disabled>
            </div>
            <div class="px-5 mt-5 hidden">
                <label for="patient_id" class="font-medium text-gray-500">PATIENT NO.</label>
                <input type="text" id="patient_id" name="patient_id" value="{{ $patient->id }}"
                    class=" font-medium mt-4" disabled>
            </div>
            <div class="flex justify-end m-4">
                <button type="submit"
                    class="mr-5 text-xs p-3 bg-blue-950 text-white mb-3 w-20 rounded-sm shadow-md">SAVE</button>
            </div>

        </form>
    </div>

    <script>
        $(document).ready(function() {
            generateCertificateID();

            function generateCertificateID() {

                var randomNum = Math.floor(Math.random() * 9999999) + 1;
                var paddedNum = randomNum.toString().padStart(7, '0');
                var certificateID = 'CERT-' + paddedNum;
                $('#certificateID').val(certificateID);
            }


            $("#sickleaveform").submit(function(e) {
                alert(2);
                e.preventDefault();
                //////////////////////////////////////////////////////////////////////////////////////////

                $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                });
                var formData = new FormData(this);

                formData.append("doctor_id", $("#doctor_id").val());
                formData.append("certificateID", $("#certificateID").val());
                formData.append("patient_id", $("#patient_id").val());

                console.log(formData);
                $.ajax({
                    type: "POST",
                    url: "/store_sickleave_data",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        window.location.reload();
                    },
                    error: function(xhr) {
                        var errorMessage = xhr.responseText;
                        alert(errorMessage);
                    },
                });
            });
        });
    </script>
@endsection
