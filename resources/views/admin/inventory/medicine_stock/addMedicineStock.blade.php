@extends('layout.admin_layout')

@section('content')
    <div class="flex items-center justify-between">
        <div class="ml-7 mt-5 mb-3 text-xl font-semibold text-blue-950">
            Add Medicine Stock
        </div>
        <div class="mr-8">
            <a href="/admin/medicine_stocks">
                <button class="bg-blue-950 text-white text-xs p-2 w-24 rounded-md">Back</button>
            </a>
        </div>
    </div>
    <div class=" m-auto bg-white h-[550px] rounded-lg shadow" style="width: 94%;">

        <form action="#" id="medicineStockForm">
            @csrf
            <div class="text-xl m-4 p-3 text-blue-950 font-semibold">
                Medicines Stock
            </div>
            <div class="flex w-full items-center m-7">
                <div class="w-1/4">
                    <label for="medicine_id" class="font-semibold">Medicine Name <span class="text-red-500">*</span></label>
                </div>
                <div class="w-full">
                    <select type="text" name="medicine_id" id="medicine_id"
                        class="border border-gray-500 p-2 text-sm rounded-md outline-none" style="width: 90%">
                        <option value="#">None</option>
                    </select>
                </div>
            </div>
            <div class="flex w-full items-center m-7">
                <div class="w-1/4">
                    <label for="batch_id" class="font-semibold">Bacth ID<span class="text-red-500">*</span></label>

                </div>
                <div class="w-full">
                    <input type="text" name="batch_id" id="batch_id"
                        class="border border-gray-500 p-2 text-sm rounded-md outline-none" style="width: 90%"><br>
                </div>
            </div>
            <div class="flex w-full items-center m-7">
                <div class="w-1/4">
                    <label for="date_recieve" class="font-semibold">Date Recieved<span class="text-red-500">*</span></label>
                </div>
                <div class="w-full">
                    <input type="date" name="date_recieve" id="date_recieve"
                        class="border border-gray-500 p-2 text-sm rounded-md outline-none" style="width: 90%">
                </div>
            </div>
            <div class="flex w-full items-center m-7">
                <div class="w-1/4">
                    <label for="expiration_date" class="font-semibold">Expiration Date <span
                            class="text-red-500">*</span></label>
                </div>
                <div class="w-full">
                    <input type="date" name="expiration_date" id="expiration_date"
                        class="border border-gray-500 p-2 text-sm rounded-md outline-none" style="width: 90%">
                </div>
            </div>
            <div class="flex w-full items-center m-7">
                <div class="w-1/4">
                    <label for="quantity" class="font-semibold">Quantity <span class="text-red-500">*</span></label>
                </div>
                <div class="w-full">
                    <input type="number" name="quantity" id="quantity"
                        class="border border-gray-500 p-2 text-sm rounded-md outline-none" style="width: 90%">
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

            // Populate the medicine dropdown
            $.ajax({
                url: '/getmedicine',
                type: 'GET',
                success: function(data) {
                    var options = '';
                    $.each(data, function(key, medicine) {
                        options += '<option value="' + medicine.id + '">' + medicine.name +
                            '</option>';
                    });
                    $('#medicine_id').html(options);
                }
            });

            $("#medicineStockForm").submit(function(e) {
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                });
                var formData = new FormData(this);

                $.ajax({
                    type: "POST",
                    url: "/store_medicine_stock",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        // alert(response);
                        window.location.href = "/admin/medicine_stocks?success=true";
                    },
                    error: function(xhr) {
                        var errorMessage = xhr.responseText;
                        console.log(errorMessage); // Log the error message
                        alert(errorMessage); // Display the error message
                    },
                });
            });
        });
    </script>
@endsection
