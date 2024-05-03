@extends('layout.admin_layout')

@section('content')
    <div class="flex items-center justify-between">
        <div class="ml-7 mt-5 mb-3 text-xl font-semibold text-blue-950">
            Add Medicine
        </div>
        <div class="mr-8">
            <a href="/admin/medicine_inventory">
                <button class="bg-blue-950 text-white text-xs p-2 w-24 rounded-md">Back</button>
            </a>
        </div>
    </div>
    <div class=" m-auto bg-white h-auto rounded-lg shadow" style="width: 94%;">

        <form action="#" id="medicineForm">
            @csrf
            <div class="text-xl m-4 p-3 text-blue-950 font-semibold">
                Medicine
            </div>
            <div class="flex w-full items-center m-7">
                <div class="w-1/4">
                    <label for="name" class="font-semibold">Name <span class="text-red-500">*</span></label>
                </div>
                <div class="w-full">
                    <input type="text" name="name" id="name"
                        class="border border-gray-500 p-2 text-sm rounded-md outline-none" style="width: 90%">
                </div>
            </div>
            <div class="flex w-full items-center m-7">
                <div class="w-1/4">
                    <label for="generic_name" class="font-semibold">Generic Name <span class="text-red-500">*</span></label>
                </div>
                <div class="w-full">
                    <input type="text" name="generic_name" id="generic_name"
                        class="border border-gray-500 p-2 text-sm rounded-md outline-none" style="width: 90%">
                </div>
            </div>
            <div class="flex w-full items-center m-7">
                <div class="w-1/4">
                    <label for="dosage" class="font-semibold">Medicine Dosage <span class="text-red-500">*</span></label>
                </div>
                <div class="w-full">
                    <input type="text" name="dosage" id="dosage"
                        class="border border-gray-500 p-2 text-sm rounded-md outline-none" style="width: 90%">
                </div>
            </div>
            <div class="flex w-full items-center m-7">
                <div class="w-1/4">
                    <label for="medicine_types" class="font-semibold">Medicine Types <span
                            class="text-red-500">*</span></label>
                </div>
                <div class="w-full">
                    <select type="text" name="medicine_types" id="medicine_types"
                        class="border border-gray-500 p-2 text-sm rounded-md outline-none" style="width: 90%">
                        <option value="liquid">Liquid</option>
                        <option value="tablet">Tablet/Capsule</option>
                        <option value="capsule">Sache</option>
                    </select>
                </div>
            </div>
            <div class="flex w-full items-center m-7">
                <div class="w-1/4">
                    <label for="supplier_id" class="font-semibold">Supplier <span class="text-red-500">*</span></label>
                </div>
                <div class="w-full">
                    <select type="text" name="supplier_id" id="supplier_id"
                        class="border border-gray-500 p-2 text-sm rounded-md outline-none" style="width: 90%">
                        <option value="none">None</option>
                    </select>
                </div>
            </div>
            <div class="flex w-full m-7">
                <div class="w-1/4">
                    <label for="description" class="font-semibold">Description <span class="text-red-500">*</span></label>
                </div>
                <div class="w-full">
                    <textarea name="description" class="border border-gray-500 rounded-md" id="description"
                        style="width: 90%; height:150px;"></textarea>
                </div>
            </div>
            <div class="flex w-full m-7 ">
                <div class="w-1/4">
                </div>
                <div class="w-full mb-5">
                    <input type="submit" class="bg-blue-500 text-sm text-white p-2 rounded-md w-36">
                </div>
            </div>

        </form>
    </div>

    <script>
        $(document).ready(function() {
            // Populate the supplier dropdown
            $.ajax({
                url: '/getsupplier',
                type: 'GET',
                success: function(data) {
                    var options = '';
                    $.each(data, function(key, supplier) {
                        options += '<option value="' + supplier.id + '">' + supplier.name +
                            '</option>';
                    });
                    $('#supplier_id').html(options);
                }
            });

            $("#medicineForm").submit(function(e) {
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                });
                var formData = new FormData(this);

                $.ajax({
                    type: "POST",
                    url: "/store_medicine",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        // alert(response);
                        window.location.href = "/admin/medicine_inventory?success=true";
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
