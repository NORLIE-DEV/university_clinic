@extends('layout.doctor_layout')

@section('content')
    <div class="bg-white shadow-lg mt-5 mx-auto" style="width: 98%; height:auto;">
        <div class="flex justify-end p-3 text-xs">
            <button onclick="window.history.back()"
                class="bg-blue-900 p-2 w-10 text-center text-white rounded-sm shadow-md">X</button>
        </div>
        <form id="sickleaveform">

            <div class="text-center py-5 font-medium text-gray-500">
                MEDICAL CERTIFICATE DATA ENTRY
            </div>
            <hr>
            <div class="pt-10 px-5">
                <!-- Patient Information -->
                Medical Certificate Details
            </div>
            <div class="px-5 mt-5">
                <label for="certificateID" class="font-medium text-gray-500">CERTIFICATE NO.</label>
                <input type="text" id="certificateID" name="certificateID" class=" font-medium mt-4" disabled>
            </div>
            <div class="px-5 mt-5">
                <label for="doctor_id" class="font-medium text-gray-500">DOCTOR NO.</label>
                <input type="text" id="doctor_id" name="doctor_id" value="{{ $doctorId }}" class=" font-medium mt-4"
                    disabled>
            </div>
            <div class="px-5 mt-5">
                <label for="patient_id" class="font-medium text-gray-500">PATIENT NO.</label>
                <input type="text" id="patient_id" name="patient_id" value="{{ $patient->id }}"
                    class=" font-medium mt-4" disabled>
            </div>
            <div class="px-5">
                <label for="#" class="font-medium text-gray-500">PATIENT NAME :</label>
                <input type="text"class="font-medium mt-4 uppercase"
                    value="{{ $patient->student->first_name ?? ($patient->employee->first_name ?? '') }} {{ $patient->student->last_name ?? ($patient->employee->last_name ?? '') }}
                    "disabled>
            </div>
            <div class="px-5 mt-4">
                <div>
                    <label for="absent_from" class="font-medium text-gray-500">ABSENT FROM :</label>
                    <input type="date" name="absent_from" id="absent_from">
                </div>
                <div>
                    <label for="absent_to" class="font-medium text-gray-500">ABSENT TO :</label>
                    <input type="date" name="absent_to" id="absent_to">
                </div>
                <div>
                    <label for="date_issue" class="font-medium text-gray-500">DATE ISSUE</label>
                    <input type="date" name="date_issue" id="date_issue">
                </div>
                <div>
                    <label for="number_days_absent" class="font-medium text-gray-500">NUMBER DAY OF ABSENT</label>
                    <input type="number" name="number_days_absent" id="number_days_absent">
                </div>
                <div>
                    <label for="reason" class="font-medium text-gray-500">REASON OF ABSENCE</label>
                    <textarea rows="6" cols="80" name="reason" id="reason"></textarea>
                </div>
                <div>
                    <label for="findings" class="font-medium text-gray-500">CLINICAL FINDING(S)</label>
                    <textarea rows="6" cols="80" name="findings" id="findings"></textarea>
                </div>
                <div>
                    <label for="remarks" class="font-medium text-gray-500">REMARKS</label>
                    <textarea rows="6" cols="80" name="remarks" id="remarks"></textarea>
                </div>
            </div>

            <button type="submit">SAVE</button>
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
