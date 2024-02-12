$(document).ready(function () {
    //  alert(2);
    $("#email").prop("disabled", true);

    //   image
    $("#upload").change(function () {
        var reader = new FileReader();
        reader.onload = function (e) {
            $("#image-preview").attr("src", e.target.result);
        };
        reader.readAsDataURL(this.files[0]);
    });
});
