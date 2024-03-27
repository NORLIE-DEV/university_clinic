$(document).ready(function () {
    // $('#parent-checkboxes-father input[type="checkbox"]').change(function () {
    //     if ($(this).prop("checked")) {
    //         $('#parent-checkboxes-father input[type="checkbox"]')
    //             .not(this)
    //             .prop("checked", false);
    //         if ($(this).val() === "Father") {
    //             alert("You selected Father.");
    //         } else {
    //             alert("You selected StepFather.");
    //         }
    //     }
    // });

    // $('#parent-checkboxes-mother input[type="checkbox"]').change(function () {
    //     if ($(this).prop("checked")) {
    //         $('#parent-checkboxes-mother input[type="checkbox"]')
    //             .not(this)
    //             .prop("checked", false);
    //         if ($(this).val() === "Mother") {
    //             alert("You selected Mother.");
    //         } else {
    //             alert("You selected StepMother.");
    //         }
    //     }
    // });

    $("#others").prop("disabled", true);

    $('#illness input[type="checkbox"]').change(function () {
        if ($(this).prop("checked")) {
            // alert($(this).val() + " selected!");

            // Check if the selected value is "others"
            if ($(this).val() === "others") {
                alert("Others selected!");
                $("#others").prop("disabled", false); // Enable the textbox
            } else {
                $("#others").prop("disabled", true); // Disable the textbox
            }
        }
    });

    $("#medicalHistoryForm").submit(function (e) {
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
            url: "/add_medicalhistory",
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                alert("MEDICAL HISTORY SUCCESSULLY ADDED!");
                location.reload();
            },
            error: function (xhr) {
                var errorMessage = xhr.responseText;
                console.log(errorMessage); // Log the error message
                alert(errorMessage); // Display the error message
            },
        });
    });
});
