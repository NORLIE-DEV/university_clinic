$(document).ready(function () {
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

    $("#nurseForm").submit(function (e) {
        // alert(2);
        e.preventDefault();
        //////////////////////////////////////////////////////////////////////////////////////////

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        var formData = new FormData(this);

        $.ajax({
            type: "POST",
            url: "/store_nurse",
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                window.location.href = "/superadmin/nurse?success=true";
            },
            error: function (xhr) {
                var errorMessage = xhr.responseText;
            },
        });
    });
});
