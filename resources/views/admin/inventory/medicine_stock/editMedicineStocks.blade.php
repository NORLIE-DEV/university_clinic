@extends('layout.admin_layout')

@section('content')
    <div class="flex items-center justify-between">
        <div class="ml-7 mt-5 mb-3 text-xl font-semibold text-blue-950">
            Edit Medicine Stock
        </div>
        <div class="mr-8">
            <a href="/admin/medicine_stocks">
                <button class="bg-blue-950 text-white text-xs p-2 w-24 rounded-md">Back</button>
            </a>
        </div>
    </div>
    <div class=" m-auto bg-white h-[550px] rounded-lg shadow" style="width: 94%;">

        <form action="/medicineStocks/{{ $medicinesStocks->id }}" id="medicineStockForm" method="POST"
            enctype="multipart/form-data">
            @method('PUT')
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
                        class="border border-gray-500 p-2 text-sm rounded-md outline-none"
                        value="{{ $medicinesStocks->batch_id }}" style="width: 90%"><br>
                </div>
            </div>
            <div class="flex w-full items-center m-7">
                <div class="w-1/4">
                    <label for="date_recieve" class="font-semibold">Date Recieved<span class="text-red-500">*</span></label>
                </div>
                <div class="w-full">
                    <input type="date" name="date_recieve" id="date_recieve"
                        class="border border-gray-500 p-2 text-sm rounded-md outline-none"
                        value="{{ $medicinesStocks->date_recieve }}" style="width: 90%">
                </div>
            </div>
            <div class="flex w-full items-center m-7">
                <div class="w-1/4">
                    <label for="expiration_date" class="font-semibold">Expiration Date <span
                            class="text-red-500">*</span></label>
                </div>
                <div class="w-full">
                    <input type="date" name="expiration_date" id="expiration_date"
                        class="border border-gray-500 p-2 text-sm rounded-md outline-none"
                        value="{{ $medicinesStocks->expiration_date }}" style="width: 90%">
                </div>
            </div>
            <div class="flex w-full items-center m-7">
                <div class="w-1/4">
                    <label for="quantity" class="font-semibold">Quantity <span class="text-red-500">*</span></label>
                </div>
                <div class="w-full">
                    <input type="number" name="quantity" id="quantity"
                        class="border border-gray-500 p-2 text-sm rounded-md outline-none"
                        value="{{ $medicinesStocks->quantity }}" style="width: 90%">
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
            // Populate the supplier dropdown
            $.ajax({
                url: '/getmedicine',
                type: 'GET',
                success: function(data) {
                    var options = '';
                    var specificSupplierId = "{{ $medicinesStocks->medicine_id }}";
                    $.each(data, function(key, medicine) {
                        if (medicine.id === specificSupplierId) {
                            options += '<option value="' + medicine.id + '" selected>' +
                                medicine.name +
                                '</option>';
                        } else {
                            options += '<option value="' + medicine.id + '">' + medicine.name +
                                '</option>';
                        }
                    });
                    $('#medicine_id').html(options);
                }
            });
        });
    </script>
@endsection
