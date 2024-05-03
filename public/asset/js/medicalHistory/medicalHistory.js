$(document).ready(function () {
    $("#medicalHistoryForm").submit(function (e) {
        e.preventDefault();

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
