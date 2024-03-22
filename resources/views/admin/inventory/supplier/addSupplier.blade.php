@extends('layout.admin_layout')

@section('content')
    <div class="flex items-center justify-between">
        <div class="ml-7 mt-5 mb-3 text-xl font-semibold text-blue-950">
            Add Supplier
        </div>
        <div class="mr-8">
            <a href="/admin/supplier">
                <button class="bg-blue-950 text-white text-xs p-2 w-24 rounded-md">Back</button>
            </a>
        </div>
    </div>
    <div class=" m-auto bg-white h-[550px] rounded-lg shadow" style="width: 94%;">

        <form action="#" id="supplierForm">
            @csrf
            <div class="text-xl m-4 p-3 text-blue-950 font-semibold">
                Supplier
            </div>
            <div class="flex w-full items-center m-7">
                <div class="w-1/4">
                    <label for="name" class="font-semibold">Supplier Name <span class="text-red-500">*</span></label>
                </div>
                <div class="w-full">
                    <input type="text" name="name" id="name"
                        class="border border-gray-500 p-2 text-sm rounded-md outline-none" style="width: 90%">
                </div>
            </div>
            <div class="flex w-full items-center m-7">
                <div class="w-1/4">
                    <label for="contact_number" class="font-semibold">Contact Number <span
                            class="text-red-500">*</span></label>

                </div>
                <div class="w-full">
                    <input type="text" name="contact_number" id="contact_number"
                        class="border border-gray-500 p-2 text-sm rounded-md outline-none" style="width: 90%"><br>
                    <span id="cpNumber_err"></span>
                </div>
            </div>
            <div class="flex w-full items-center m-7">
                <div class="w-1/4">
                    <label for="email" class="font-semibold">Email <span class="text-red-500">*</span></label>
                </div>
                <div class="w-full">
                    <input type="email" name="email" id="email"
                        class="border border-gray-500 p-2 text-sm rounded-md outline-none" style="width: 90%">
                </div>
            </div>
            <div class="flex w-full m-7">
                <div class="w-1/4">
                    <label for="address" class="font-semibold">Address <span class="text-red-500">*</span></label>
                </div>
                <div class="w-full">
                    <textarea name="address" class="border border-gray-500 rounded-md" id="address" style="width: 90%; height:150px;"></textarea>
                </div>
            </div>
            <div class="flex w-full m-7">
                <div class="w-1/4">
                </div>
                <div class="w-full">
                    <input type="submit" class="bg-blue-500 text-sm text-white p-2 rounded-md w-36">
                </div>
            </div>

        </form>

    </div>
    <script>
        $(document).ready(function() {
            $("#supplierForm").submit(function(e) {
                e.preventDefault();

                const cpNumber = $("#contact_number").val();
                alert(cpNumber);
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

                $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                });
                var formData = new FormData(this);

                $.ajax({
                    type: "POST",
                    url: "/store_supplier",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        // alert(response);
                        window.location.href = "/admin/supplier?success=true";
                    },
                    error: function(xhr) {
                        var errorMessage = xhr.responseText;
                        // console.log(errorMessage); // Log the error message
                        alert(errorMessage); // Display the error message
                    },
                });
            });
        });
    </script>
@endsection
