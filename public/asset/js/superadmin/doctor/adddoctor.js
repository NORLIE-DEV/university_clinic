$(document).ready(function () {
    $("#upload").change(function () {
        var reader = new FileReader();
        reader.onload = function (e) {
            $("#image-preview").attr("src", e.target.result);
        };
        reader.readAsDataURL(this.files[0]);
    });
    $("#email").blur(function () {
        // alert(2);
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        var error_email = "";
        var email = $("#email").val();

        $.ajax({
            url: "/email_available/doctor",
            method: "POST",
            data: {
                email: email,
            },
            success: function (result) {
               // alert(result);
                if (result === "unique") {
                    $("#error_email").html(
                        '<label class="text-xs" style="color:green;">Email Available</label>'
                    );
                    $("#email").removeClass("has-error");
                    $("#submit").attr("disabled", false);
                } else {
                    $("#error_email").html(
                        '<label class="text-red-500 text-xs">Email not Available</label>'
                    );
                    $("#email").addClass("has-error");
                    $("#submit").attr("disabled", "disabled");
                }
            },
        });
    });

    $("#doctorForm").submit(function (e) {
        // alert(2);
        e.preventDefault();
        //  alert(2);
        const cpNumber = $("#phone_number").val();
        // alert(cpNumber);
        // Check if cpNumber contains non-numeric characters
        if (/[^0-9]/.test(cpNumber)) {
            $("#cpNumber_err").html(
                '<label class="text-red-500 text-xs">Invalid Phone Number (contains non-numeric characters)</label>'
            );
            return;
        }
        // Check if cpNumber is not exactly 11 digits
        if (cpNumber.length !== 11) {
            $("#cpNumber_err").html(
                '<label class="text-red-500 text-xs">Invalid Phone Number (not exactly 11 digits)</label>'
            );
            // alert(11);
            return;
        }
        // If the code reaches here, the phone number is valid
        $("#cpNumber_err").html("");

        //////////////////////////////////////////////////////////////////////////////////////////

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        var formData = new FormData(this);

        $.ajax({
            type: "POST",
            url: "/store_doctor",
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                // Handle success response here
                // alert("success");
                $("#successModal").show();
                location.reload();

                clearTextBox();
            },
            error: function (xhr) {
                var errorMessage = xhr.responseText;
                // console.log(errorMessage); // Log the error message
                alert(errorMessage); // Display the error message
                console.log(errorMessage);
            },
        });
    });
});
