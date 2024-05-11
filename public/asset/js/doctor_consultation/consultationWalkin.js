$(document).ready(function () {
    $(".tab").click(function () {
        $(".tab").removeClass("active-tab");
        $(this).addClass("active-tab");
        $(".tab-content").addClass("hidden");
        var tabId = $(this).attr("id");
        var tabNumber = tabId.split("-")[1];
        $("#tab-content-" + tabNumber).removeClass("hidden");
    });
    // $(".tab-bed-rest").click(function () {
    //     $(".tab-bed-rest").removeClass("tab-bed-rest-active");
    //     $(this).addClass("tab-bed-rest-active");
    //     $(".tab-bed-rest-content").addClass("hidden");
    //     var tabrestId = $(this).attr("id");
    //     var tabrestNumber = tabrestId.split("-")[3];
    //     $("#tab-bed-rest-content-" + tabrestNumber).removeClass("hidden");
    // });

    $("#blood_pressure").on("input", function () {
        var bloodPressure = $(this).val();
        var category = calculateBloodPressureCategory(bloodPressure);
        $("#bp_category").val(category);
    });

    function calculateBloodPressureCategory(bloodPressure) {
        if (bloodPressure < 120) {
            return "Normal";
        } else if (bloodPressure >= 120 && bloodPressure <= 129) {
            return "Elevated";
        } else if (bloodPressure >= 130 && bloodPressure <= 139) {
            return "High Blood Pressure (Stage 1)";
        } else if (bloodPressure >= 140 && bloodPressure <= 180) {
            return "High Blood Pressure (Stage 2)";
        } else {
            return "Hypertensive Crisis";
        }
    }

    // BMI

    $("#height, #weight").on("input", function () {
        calculateBMI();
    });

    function calculateBMI() {
        var height = parseFloat($("#height").val());
        var weight = parseFloat($("#weight").val());

        if (!isNaN(height) && !isNaN(weight) && height > 0 && weight > 0) {
            var bmi = weight / ((height / 100) * (height / 100));
            $("#bmi").val(bmi.toFixed(2));

            var category = "";
            if (bmi < 18.5) {
                category = "Underweight";
            } else if (bmi >= 18.5 && bmi < 25) {
                category = "Normal weight";
                0;
            } else if (bmi >= 25 && bmi < 30) {
                category = "Overweight";
            } else {
                category = "Obese";
            }
            $("#bmi_category").val(category);
        } else {
            $("#bmi").val("");
            $("#bmi_category").val("");
        }
    }
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    // Assestment / Chief Complaints

    var rowCounter = 1;
    function removeChiefComplaints() {
        $(this).closest("tr").remove();
    }

    $("#addButton").click(function () {
        // Rest of your code
        var chiefComplaint = $("#chief_complaint").val();
        var otherDetails = $("#other_details").val();

        // Append selected medicine to the table with delete button
        var row = $(
            "<tr>" +
                "<td>" +
                chiefComplaint +
                "</td>" +
                "<td>" +
                otherDetails +
                "</td>" +
                '<td><button class="removeChiefComplaints text-white bg-red-500 ">Remove</button></td>' +
                "</tr>"
        );
        rowCounter++;
        row.find(".removeChiefComplaints").click(removeChiefComplaints);
        $("#tableBody").append(row);

        $("#chief_complaint").val(" ");
        $("#other_details").val(" ");
    });

    $(".remove-row").on("click", function () {
        $(this).closest("tr").remove();
    });

    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    // getmedicine
    $.ajax({
        url: "/getMedicine",
        type: "GET",
        success: function (response) {
            var medicine = response.medicines;
            var select = $("#medicine");
            $.each(medicine, function (index, medicine) {
                select.append(
                    $("<option>", {
                        value: medicine.id,
                        text: medicine.name,
                        name: "medicine[]",
                    })
                );
            });
            var select = $("#medicine_1");
            $.each(medicine, function (index, medicine) {
                select.append(
                    $("<option>", {
                        value: medicine.id,
                        text: medicine.name,
                        name: "medicine_1[]",
                    })
                );
            });
        },
        error: function (xhr, status, error) {
            console.error(error);
        },
    });

    function handleDeleteButtonClick() {
        $(this).closest("tr").remove();
    }

    //////////////////////////////////////////////////////// MEDICINE ISSUANCE /////////////////////////////////////////////
    var medicineIssuanceCounter = 1;
    $("#AddMedicine").click(function () {
        var medicineId = $("#medicine").val();
        var medicineName = $("#medicine option:selected").text();
        var quantity = $("#qty").val();
        var instruction = $("#instruction").val();

        // Append selected medicine to the table with delete button
        var row = $(
            "<tr>" +
                "<td>" +
                medicineName +
                "</td>" +
                "<td>" +
                quantity +
                "</td>" +
                "<td>" +
                instruction +
                "</td>" +
                '<td><button class="deleteBtn text-white bg-red-500 ">Remove</button></td>' +
                "</tr>"
        );
        medicineIssuanceCounter++;
        // Add delete button click event handler
        row.find(".deleteBtn").click(handleDeleteButtonClick);

        $("#medicineIssuanceTableBody").append(row);
        // Clear input fields after adding medicine
        $("#medicine").val("#");
        $("#qty").val("");
        $("#instruction").val("");
    });

    //////////////////////////////////////////////////////// MEDICINE PRESCRIPTION /////////////////////////////////////////////
    var medicinePrescreptionCounter = 1;
    $("#AddMedicinePrescription").click(function () {
        //  alert(2);
        var medicineId = $("#medicine_1").val();
        var medicineName1 = $("#medicine_1 option:selected").text();
        var quantity1 = $("#qty_1").val();
        var instruction1 = $("#instruction_1").val();

        // Append selected medicine to the table with delete button
        var row = $(
            "<tr>" +
                "<td>" +
                medicineName1 +
                "</td>" +
                "<td>" +
                quantity1 +
                "</td>" +
                "<td>" +
                instruction1 +
                "</td>" +
                '<td><button class="deleteBtn text-white bg-red-500 ">Remove</button></td>' +
                "</tr>"
        );
        medicinePrescreptionCounter++;
        // Add delete button click event handler
        row.find(".deleteBtn").click(handleDeleteButtonClick);

        $("#tablePrescriptionBody").append(row);

        // Clear input fields after adding medicine
        $("#medicine_1").val("#");
        $("#qty_1").val("");
        $("#instruction_1").val("");
    });

    ///////////////////////////// DIAGNOSIS ///////////////////////////////
    var diagnosisCounter = 1;
    $("#addDiagnosis").click(function () {
        var diagnosis = $("#diagnosis").val();
        // Append selected medicine to the table with delete button
        var row = $(
            "<tr>" +
                "<td>" +
                diagnosis +
                "</td>" +
                '<td><button class="removeChiefComplaints text-white bg-red-500 ">Remove</button></td>' +
                "</tr>"
        );
        diagnosisCounter++;
        row.find(".removeChiefComplaints").click(removeChiefComplaints);
        $("#diagnosisTableBody").append(row);
        var formData = {
            diagnosis: diagnosis,
        };
        console.log(formData);
        $("#diagnosis").val(" ");
    });

    ///////////////////////////// TREATMENT ///////////////////////////////
    var treatmentCounter = 1;
    $("#addTreatment").click(function () {
        var treatment = $("#treatment").val();
        // Append selected medicine to the table with delete button
        var row = $(
            "<tr>" +
                "<td>" +
                treatment +
                "</td>" +
                '<td><button class="removeChiefComplaints text-white bg-red-500 ">Remove</button></td>' +
                "</tr>"
        );
        treatmentCounter++;
        row.find(".removeChiefComplaints").click(removeChiefComplaints);
        $("#treatmentTableBody").append(row);
        var formData = {
            treatment: treatment,
        };
        console.log(formData);
        $("#treatment").val(" ");
    });

    ////////////////////////////////// TRANSFER OF CARE ////////////////////////////
    var injuriesCounter = 1; // Move this variable outside the click event handler if it needs to retain its value between clicks

    $("#addInjuries").click(function () {
        var time = $("#time").val();
        var date = $("#date").val();
        var injuries = $("#injuries").val();
        var place_of_incident = $("#place_of_incident").val();

        // Calculate formatted time inside the click event handler function
        var timeParts = time.split(":");
        var hours = parseInt(timeParts[0]);
        var minutes = timeParts[1];

        var period = hours >= 12 ? "PM" : "AM";

        if (hours > 12) {
            hours -= 12;
        } else if (hours === 0) {
            hours = 12;
        }

        var formattedTime = hours + ":" + minutes + " " + period;

        // Append selected medicine to the table with delete button
        var row = $(
            "<tr>" +
                "<td>" +
                formattedTime +
                "</td>" +
                "<td>" +
                date +
                "</td>" +
                "<td>" +
                injuries +
                "</td>" +
                "<td>" +
                place_of_incident +
                "</td>" +
                '<td><button class="removeChiefComplaints text-white bg-red-500 ">Remove</button></td>' +
                "</tr>"
        );
        injuriesCounter++;
        row.find(".removeChiefComplaints").click(removeChiefComplaints);
        $("#injuriesTableBody").append(row);
        var formData = {
            treatment: treatment,
        };
        console.log(formData);
        $("#time").val(" ");
        $("#date").val(" ");
        $("#injuries").val(" ");
        $("#place_of_incident").val(" ");
    });

    var selectedNurseId = $("#nurse").data("selected-nurse");
    var selectedNurseId_1 = $("#nurse_1").data("selected-nurse_1");
    // getNurses
    $.ajax({
        url: "/getNurse",
        type: "GET",
        success: function (response) {
            var nurse = response.nurses;
            var select = $("#nurse");
            select.empty();
            $.each(nurse, function (index, nurse) {
                var option = $("<option>", {
                    value: nurse.id,
                    text: nurse.name,
                    // Set selected attribute if nurse ID matches the selected nurse ID
                    selected: nurse.id === selectedNurseId,
                });
                select.append(option);
            });
            var select_1 = $("#nurse_1");
            select_1.empty();
            $.each(nurse, function (index, nurse) {
                var option = $("<option>", {
                    value: nurse.id,
                    text: nurse.name,
                    // Set selected attribute if nurse ID matches the selected nurse ID
                    selected: nurse.id === selectedNurseId_1,
                });
                select_1.append(option);
            });
        },
        error: function (xhr, status, error) {
            console.error(error);
        },
    });

    //store
    $("#medicalConsultationWalkinForm").submit(function (e) {
        // alert(2);
        e.preventDefault();
        //////////////////////////////////////////////////////////////////////////////////////////

        var chiefComplaints = [];
        $("#dataTable #tableBody tr").each(function () {
            var chiefComplaint = $(this).find("td:eq(0)").text();
            var otherDetails = $(this).find("td:eq(1)").text();
            chiefComplaints.push({
                chiefComplaint: chiefComplaint,
                otherDetails: otherDetails,
            });
        });

        // alert(JSON.stringify(chiefComplaints));

        var medicineIssuance = [];
        $("#dataTable #medicineIssuanceTableBody tr").each(function () {
            var medicine = $(this).find("td:eq(0)").text();
            var qty = $(this).find("td:eq(1)").text();
            var instruction = $(this).find("td:eq(2)").text();
            medicineIssuance.push({
                medicine: medicine,
                qty: qty,
                instruction: instruction,
            });
        });

        // alert(JSON.stringify(medicineIssuance));

        var medicinePrescription = [];
        $("#dataTable #tablePrescriptionBody tr").each(function () {
            var medicine_1 = $(this).find("td:eq(0)").text();
            var qty_1 = $(this).find("td:eq(1)").text();
            var instruction_1 = $(this).find("td:eq(2)").text();
            medicinePrescription.push({
                medicine: medicine_1,
                qty: qty_1,
                instruction: instruction_1,
            });
        });
        //alert(JSON.stringify(medicinePrescription));

        var clinicalDiagnosis = [];
        $("#dataTable #diagnosisTableBody tr").each(function () {
            var diagnosis = $(this).find("td:eq(0)").text();
            clinicalDiagnosis.push({
                diagnosis: diagnosis,
            });
        });
        // alert(JSON.stringify(clinicalDiagnosis));

        var treatmentGiven = [];
        $("#dataTable #treatmentTableBody tr").each(function () {
            var treatment = $(this).find("td:eq(0)").text();
            treatmentGiven.push({
                treatment: treatment,
            });
        });
        // alert(JSON.stringify(treatmentGiven));

        var injuries = [];
        $("#dataTable #injuriesTableBody tr").each(function () {
            var date = $(this).find("td:eq(0)").text();
            var time = $(this).find("td:eq(1)").text();
            var injurie = $(this).find("td:eq(2)").text();
            var place_of_incident = $(this).find("td:eq(3)").text();
            injuries.push({
                date: date,
                time: time,
                injurie: injurie,
                place_of_incident: place_of_incident,
            });
        });
        // alert(JSON.stringify(injuries));

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        // Create a new FormData object
        var formData = new FormData();

        // Append all the form fields to the FormData object
        formData.append("doctor_id", $("#doctor_id").val());
        formData.append("appointment_id", $("#appointment_id").val());
        formData.append("patient_id", $("#patient_id").val());
        formData.append("nurse_id_1", $("#nurse").val());
        formData.append("nurse_id_2", $("#nurse_1").val());

        formData.append("pulse_rate", $("#pulse_rate").val());
        formData.append("respiratory_rate", $("#respiratory_rate").val());
        formData.append("height", $("#height").val());
        formData.append("blood_pressure", $("#blood_pressure").val());
        formData.append("body_temp", $("#body_temp").val());
        formData.append("weight", $("#weight").val());

        // Convert JSON objects to strings and append them to FormData
        formData.append("chief_complaints", JSON.stringify(chiefComplaints));
        formData.append("medicine_issuance", JSON.stringify(medicineIssuance));
        formData.append(
            "medicine_prescription",
            JSON.stringify(medicinePrescription)
        );
        formData.append(
            "clinical_diagnosis",
            JSON.stringify(clinicalDiagnosis)
        );
        formData.append("treatment_given", JSON.stringify(treatmentGiven));
        formData.append("injuries", JSON.stringify(injuries));

        formData.append("vsud_pulse_rate", $("#vsud_pulse_rate").val());
        formData.append(
            "vsud_respiratory_rate",
            $("#vsud_respiratory_rate").val()
        );
        formData.append("vsud_blood_pressure", $("#vsud_blood_pressure").val());
        formData.append("vsud_body_temp", $("#vsud_body_temp").val());
        formData.append(
            "vsud_conditional_findings",
            $("#vsud_conditional_findings").val()
        );

        formData.append("assistedBy", $("#assistedBy").val());
        formData.append("other_assistant", $("#other_assistant").val());
        formData.append("transfferofcare", $("#transfferofcare").val());
        formData.append("remarks", $("#remarks").val());
        formData.append("timeout", $("#timeout").val());

        formData.append("consultation_method", $("#consultation_method").val());

        alert($("#consultation_method").val());

        // Now, you can send the formData to your backend

        //  var formData = new FormData(this);
        $.ajax({
            type: "POST",
            url: "/store_medicalConsultaionWalkin",
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                window.location.reload();
            },
            error: function (xhr) {
                var errorMessage = xhr.responseText;
                console.log(errorMessage);
                alert(errorMessage);
            },
        });
    });

    $("#consultationWalkinFormUpdate").submit(function (e) {
        // alert(2);
        e.preventDefault();
        //////////////////////////////////////////////////////////////////////////////////////////

        var chiefComplaints = [];
        $("#dataTable #tableBody tr").each(function () {
            var chiefComplaint = $(this).find("td:eq(0)").text();
            var otherDetails = $(this).find("td:eq(1)").text();
            chiefComplaints.push({
                chiefComplaint: chiefComplaint,
                otherDetails: otherDetails,
            });
        });

        // alert(JSON.stringify(chiefComplaints));

        var medicineIssuance = [];
        $("#dataTable #medicineIssuanceTableBody tr").each(function () {
            var medicine = $(this).find("td:eq(0)").text();
            var qty = $(this).find("td:eq(1)").text();
            var instruction = $(this).find("td:eq(2)").text();
            medicineIssuance.push({
                medicine: medicine,
                qty: qty,
                instruction: instruction,
            });
        });

        // alert(JSON.stringify(medicineIssuance));

        var medicinePrescription = [];
        $("#dataTable #tablePrescriptionBody tr").each(function () {
            var medicine_1 = $(this).find("td:eq(0)").text();
            var qty_1 = $(this).find("td:eq(1)").text();
            var instruction_1 = $(this).find("td:eq(2)").text();
            medicinePrescription.push({
                medicine: medicine_1,
                qty: qty_1,
                instruction: instruction_1,
            });
        });
        //alert(JSON.stringify(medicinePrescription));

        var clinicalDiagnosis = [];
        $("#dataTable #diagnosisTableBody tr").each(function () {
            var diagnosis = $(this).find("td:eq(0)").text();
            clinicalDiagnosis.push({
                diagnosis: diagnosis,
            });
        });
        // alert(JSON.stringify(clinicalDiagnosis));

        var treatmentGiven = [];
        $("#dataTable #treatmentTableBody tr").each(function () {
            var treatment = $(this).find("td:eq(0)").text();
            treatmentGiven.push({
                treatment: treatment,
            });
        });
        // alert(JSON.stringify(treatmentGiven));

        var injuries = [];
        $("#dataTable #injuriesTableBody tr").each(function () {
            var date = $(this).find("td:eq(0)").text();
            var time = $(this).find("td:eq(1)").text();
            var injurie = $(this).find("td:eq(2)").text();
            var place_of_incident = $(this).find("td:eq(3)").text();
            injuries.push({
                date: date,
                time: time,
                injurie: injurie,
                place_of_incident: place_of_incident,
            });
        });

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        const data = {
            nurse_id_1: $("#nurse").val(),
            nurse_id_2: $("#nurse_1").val(),
            pulse_rate: $("#pulse_rate").val(),
            respiratory_rate: $("#respiratory_rate").val(),
            height: $("#height").val(),
            blood_pressure: $("#blood_pressure").val(),
            body_temp: $("#body_temp").val(),
            weight: $("#weight").val(),

            vsud_pulse_rate: $("#vsud_pulse_rate").val(),
            vsud_respiratory_rate: $("#vsud_respiratory_rate").val(),
            vsud_blood_pressure: $("#vsud_blood_pressure").val(),
            vsud_body_temp: $("#vsud_body_temp").val(),
            vsud_conditional_findings: $("#vsud_conditional_findings").val(),

            chief_complaints: JSON.stringify(chiefComplaints),
            medicine_issuance: JSON.stringify(medicineIssuance),
            medicine_prescription: JSON.stringify(medicinePrescription),
            clinical_diagnosis: JSON.stringify(clinicalDiagnosis),
            treatment_given: JSON.stringify(treatmentGiven),
            injuries: JSON.stringify(injuries),
            // Add other data collections here...

            assistedBy: $("#assistedBy").val(),
            other_assistant: $("#other_assistant").val(),
            transfferofcare: $("#transfferofcare").val(),
            remarks: $("#remarks").val(),
            timeout: $("#timeout").val(),
        };

        var consultation_id = $("#consultation_id").val();

        $.ajax({
            type: "PUT",
            url: "/update_medicalconsultation/" + consultation_id,
            data: JSON.stringify(data), // Convert data to JSON string
            contentType: "application/json", // Set content type to JSON
            dataType: "json",
            success: function (response) {
                window.location.reload();
            },
            error: function (xhr) {
                var errorMessage = xhr.responseText;
                console.log(errorMessage);
                //alert(errorMessage);
            },
        });
    });

    // add dental consulation walkin
    $("#dentalConsultationForm").submit(function (e) {
        // alert(2);
        e.preventDefault();
        //////////////////////////////////////////////////////////////////////////////////////////

        // alert(JSON.stringify(chiefComplaints));

        var medicineIssuance = [];
        $("#dataTable #medicineIssuanceTableBody tr").each(function () {
            var medicine = $(this).find("td:eq(0)").text();
            var qty = $(this).find("td:eq(1)").text();
            var instruction = $(this).find("td:eq(2)").text();
            medicineIssuance.push({
                medicine: medicine,
                qty: qty,
                instruction: instruction,
            });
        });

        // alert(JSON.stringify(medicineIssuance));

        var medicinePrescription = [];
        $("#dataTable #tablePrescriptionBody tr").each(function () {
            var medicine_1 = $(this).find("td:eq(0)").text();
            var qty_1 = $(this).find("td:eq(1)").text();
            var instruction_1 = $(this).find("td:eq(2)").text();
            medicinePrescription.push({
                medicine: medicine_1,
                qty: qty_1,
                instruction: instruction_1,
            });
        });
        //alert(JSON.stringify(medicinePrescription))

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        // Create a new FormData object
        var formData = new FormData(this);

        // Append all the form fields to the FormData object

        formData.append("nurse_id_1", $("#nurse").val());
        formData.append("nurse_id_2", $("#nurse_1").val());
        formData.append("medicine_issuance", JSON.stringify(medicineIssuance));
        formData.append(
            "medicine_prescription",
            JSON.stringify(medicinePrescription)
        );

        alert($("#consultation_method").val());

        // Now, you can send the formData to your backend

        //  var formData = new FormData(this);
        $.ajax({
            type: "POST",
            url: "/store_dentalConsultaionWalkin",
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                window.location.reload();
            },
            error: function (xhr) {
                var errorMessage = xhr.responseText;
                console.log(errorMessage);
                alert(errorMessage);
            },
        });
    });

    $("#dentalConsultationFormUpdate").submit(function (e) {
        // alert(2);
        e.preventDefault();
        //////////////////////////////////////////////////////////////////////////////////////////

        // alert(JSON.stringify(chiefComplaints));

        // alert(JSON.stringify(chiefComplaints));

        var medicineIssuance = [];
        $("#dataTable #medicineIssuanceTableBody tr").each(function () {
            var medicine = $(this).find("td:eq(0)").text();
            var qty = $(this).find("td:eq(1)").text();
            var instruction = $(this).find("td:eq(2)").text();
            medicineIssuance.push({
                medicine: medicine,
                qty: qty,
                instruction: instruction,
            });
        });

        // alert(JSON.stringify(medicineIssuance));

        var medicinePrescription = [];
        $("#dataTable #tablePrescriptionBody tr").each(function () {
            var medicine_1 = $(this).find("td:eq(0)").text();
            var qty_1 = $(this).find("td:eq(1)").text();
            var instruction_1 = $(this).find("td:eq(2)").text();
            medicinePrescription.push({
                medicine: medicine_1,
                qty: qty_1,
                instruction: instruction_1,
            });
        });
        //alert(JSON.stringify(medicinePrescription));

        const checkedOralHealthConditions = [];
        const checkboxes = document.querySelectorAll(
            'input[name="oral_health_condition[]"]'
        );

        checkboxes.forEach((checkbox) => {
            if (checkbox.checked) {
                checkedOralHealthConditions.push(checkbox.value);
            }
        });

        const checkedServicesRendered = [];
        const checkboxesServiceRendered = document.querySelectorAll(
            'input[name="services_rendered[]"]'
        );

        checkboxesServiceRendered.forEach((checkbox) => {
            if (checkbox.checked) {
                checkedServicesRendered.push(checkbox.value);
            }
        });

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        //var FormData = new FormData(this)
        const data = {
            nurse_id_1: $("#nurse").val(),
            nurse_id_2: $("#nurse_1").val(),
            doctor_id: $("#doctor_id").val(),
           
            medicine_issuance: JSON.stringify(medicineIssuance),
            medicine_prescription: JSON.stringify(medicinePrescription),

            oral_health_condition: checkedOralHealthConditions,
            services_rendered: checkedServicesRendered,

            other_assistant: $("#other_assistant").val(),
            follow_up: $("#follow_up").val(),
            remarks: $("#remarks").val(),
            consultation_method: $("#consultation_method").val(),
        };

        console.log(data);
        var consultation_id = $("#consultation_id").val();

        $.ajax({
            type: "PUT",
            url: "/update_dentalconsultation_walkin/" + consultation_id,
            data: JSON.stringify(data), // Convert data to JSON string
            contentType: "application/json", // Set content type to JSON
            dataType: "json",
            success: function (response) {
                window.location.reload();
            },
            error: function (xhr) {
                var errorMessage = xhr.responseText;
                console.log(errorMessage);
                //alert(errorMessage);
            },
        });
    });

    $("#backButton").click(function () {
        window.history.back();
    });
    $(window).on("popstate", function (event) {
        window.location.reload();
    });
});
