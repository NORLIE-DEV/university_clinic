$(document).ready(function () {
    $("#upload").change(function () {
        var reader = new FileReader();
        reader.onload = function (e) {
            $("#image-preview").attr("src", e.target.result);
        };
        reader.readAsDataURL(this.files[0]);
    });
    $("#id").blur(function () {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        var error_email = "";
        var student_id = $("#id").val();
        //  alert(student_id);

        $.ajax({
            url: "/studentID_available/student",
            method: "POST",
            data: {
                student_id: student_id,
            },
            success: function (result) {
                // alert(result);
                if (result === "unique") {
                    // alert(1)
                    $("#error_student_id").html(
                        '<label class="text-xs" style="color:green;">Student ID Available</label>'
                    );
                    $("#email").removeClass("has-error");
                    $("#submit").attr("disabled", false);
                } else {
                    // alert(2)
                    $("#error_student_id").html(
                        '<label class="text-red-500 text-xs">Student not Available</label>'
                    );
                    $("#email").addClass("has-error");
                    $("#submit").attr("disabled", "disabled");
                }
            },
        });
    });

    $("#email").blur(function () {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        var error_email = "";
        var email = $("#email").val();

        //console.log(email);
        $.ajax({
            url: "/email_available/student",
            method: "POST",
            data: {
                email: email,
            },
            success: function (result) {
                if (result === "unique") {
                    $("#error_email").html(
                        '<label class="text-green-500 text-xs">Email Available</label>'
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

    $("#password, #password_confirmation").on("keyup", function () {
        var password = $("#password").val();
        var confirmPassword = $("#password_confirmation").val();
        // alert(2);
        if (password === confirmPassword) {
            $("#passwordMatch").html("Passwords match").css("color", "green");
        } else {
            $("#passwordMatch")
                .html("Passwords do not match")
                .css("color", "red");
        }
    });

    $("#studentForm").submit(function (e) {
        e.preventDefault();
        //  alert(2);
        const cpNumber = $("#contact_number").val();
        if (/[^0-9]/.test(cpNumber)) {
            $("#cpNumber_err").html(
                '<label class="text-red-500 text-xs">Invalid Phone Number (contains non-numeric characters)</label>'
            );
            return;
        }
        if (cpNumber.length !== 11) {
            $("#cpNumber_err").html(
                '<label class="text-red-500 text-xs">Invalid Phone Number (not exactly 11 digits)</label>'
            );
            alert(11);
            return;
        }
        $("#cpNumber_err").html("");

        /////////////////////////////////////////////////////////////////////////
        const cpNumber1 = $("#emergency_contact_number").val();
        console.log("Emergency Contact Number:", cpNumber1);
        if (/[^0-9]/.test(cpNumber1)) {
            $("#error_emergencyNumber").html(
                '<label class="text-red-500 text-xs">Invalid Phone Number (contains non-numeric characters)</label>'
            );
            return;
        }
        if (cpNumber1.length !== 11) {
            $("#error_emergencyNumber").html(
                '<label class="text-red-500 text-xs">Invalid Phone Number (not exactly 11 digits)</label>'
            );
            return;
        }
        $("#error_emergencyNumber").html("");

        //////////////////////////////////////////////////////////////////////////////////////////

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        var formData = new FormData(this);

        $.ajax({
            type: "POST",
            url: "/store_student",
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                // alert(response);
                window.location.href = "/superadmin/student?success=true";
            },
            error: function (xhr) {
                var errorMessage = xhr.responseText;
                // console.log(errorMessage); // Log the error message
                alert(errorMessage); // Display the error message
            },
        });
    });
});
