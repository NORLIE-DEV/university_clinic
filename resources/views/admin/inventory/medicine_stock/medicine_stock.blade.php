@extends('layout.admin_layout')

@section('content')
    <div class="ml-7 mt-5 text-xl font-semibold text-blue-950">
        Medicines Stock List
    </div>
    <div class="ml-7 mb-5 text-gray-500">
        <a href="/admin_inventory_index">Index</a><span> / </span><a href="#">Medicine Stock List</a>
    </div>
    <div class=" m-auto bg-white h-[500px] rounded-lg shadow" style="width: 95%;">
        <div class="p-5">
            <a href="/admin/add_medicine_stocks">
                <button class="text-sm bg-blue-900 text-white p-2 rounded-sm">Add New Medicine Stocks</button>
            </a>
        </div>
        <div class="m-auto h-14 rounded-t border-t-2 border-t-green-600 bg-green-200 items-center hidden" id="addsuccess"
            style="width:95%;">
            <h1 class="ml-2 font-semibold text-green-800 p-3">Medicine Stocks Successfully Added!</h1>
        </div>

        @if (session('success'))
            <div class="m-auto h-14 rounded-t border-t-2 border-t-green-600 bg-green-200 items-center" id="editsuccess"
                style="width:95%;">
                <h1 class="ml-2 font-semibold text-green-800 p-3">Medicine Stocks Successfully Updated!</h1>
            </div>
        @endif
        <div class="m-5">
            <table id="tableMedicineStock" class="">
                <thead class="uppercase tracking-wider p-2  text-xs ">
                    <tr>

                        <th scope="col" class="  text-center">
                            NAME
                        </th>
                        <th scope="col" class="  text-center">
                            MEDICINE TYPES
                        </th>
                        <th scope="col" class="  text-center">
                            DOSAGE
                        </th>
                        <th scope="col" class="  text-center">
                            QUANTITY
                        </th>
                        <th scope="col" class="  text-center">
                            DATE RECIEVE
                        </th>
                        <th scope="col" class="  text-center">
                            EXPIRATION DATE
                        </th>
                        <th scope="col" class="  text-center">
                            CREATED AT
                        </th>
                        <th scope="col" class="  text-center">
                            ACTION
                        </th>
                    </tr>
                </thead>
                <tbody class="text-sm">
                    @forelse ($medicine_stocks as $medicine_stock)
                        <tr class="dark:border-neutral-600 hover:bg-neutral-100 dark:hover:bg-neutral-300">
                            <th scope="row"
                                class="px-2 py-2 border-t border-b dark:border-neutral-600 border-gray-300 font-extralight text-left">
                                {{ $medicine_stock->medicine->name }}
                            </th>
                            <th scope="row"
                                class="px-2 py-2 border-t border-b dark:border-neutral-600 border-gray-300 font-extralight text-left">
                                {{ $medicine_stock->medicine->medicine_types }}
                            </th>
                            <th scope="row"
                                class="px-2 py-2 border-t border-b dark:border-neutral-600 border-gray-300 font-extralight text-left">
                                {{ $medicine_stock->medicine->dosage }}
                            </th>
                            <th scope="row"
                                class="px-2 py-2 border-t border-b dark:border-neutral-600 border-gray-300 font-extralight text-left">
                                {{ $medicine_stock->quantity }}
                            </th>
                            <th scope="row"
                                class="px-2 py-2 border-t border-b dark:border-neutral-600 border-gray-300 font-extralight text-left">
                                {{ $medicine_stock->date_recieve }}
                            </th>
                            <th scope="row"
                                class="px-2 py-2 border-t border-b dark:border-neutral-600 border-gray-300 font-extralight text-left">
                                {{ $medicine_stock->expiration_date }}
                            </th>
                            <th scope="row"
                                class="px-2 py-2 border-t border-b dark:border-neutral-600 border-gray-300 font-extralight text-left">
                                {{ $medicine_stock->created_at }}
                            </th>
                            <th scope="row"
                                class="px-2 py-2 border-t border-b dark:border-neutral-600 border-gray-300 text-left">
                                <a href="/updatemedicine/{{ $medicine_stock->id }}" id="update-doctor">
                                    <button
                                        class="bg-green-500 hover:bg-green700 text-white font-bold py-2 px-2 rounded mr-2 text-xs"><i
                                            class="fa-solid fa-pen-to-square"></i></button>
                                </a>
                                <button
                                    class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-2 rounded mr-2 text-xs"
                                    id="delete_medicine" value="{{ $medicine_stock->id }}"><i
                                        class="fa-solid fa-trash"></i></button>
                            </th>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 border dark:border-neutral-600 border-gray-300">
                                No data available.
                            </td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
        </div>
    </div>
    @include('admin.inventory.medicine.modal.delete')
    <script>
        $(document).ready(function() {
            $("#tableMedicineStock").DataTable();

            showSuccessModal();
            updateSuccess();
            deleteSupplier();

            function showSuccessModal() {
                try {
                    var urlParams = new URLSearchParams(window.location.search);
                    if (urlParams.has('success') && urlParams.get('success') === 'true') {
                        $("#addsuccess").show();
                        setTimeout(function() {
                            $("#addsuccess").hide();
                            var newUrl = window.location.href.split('?')[0];
                            history.replaceState(null, null, newUrl);
                        }, 10000);
                    }
                } catch (error) {
                    console.error('Error in showSuccessModal:', error);
                }
            }

            function updateSuccess() {

                var addSuccessElement = $('#editsuccess');
                if (addSuccessElement.length > 0) {
                    setTimeout(function() {
                        addSuccessElement.fadeOut(500, function() {
                            addSuccessElement.remove();
                        });
                    }, 5000);
                }
            }

            function deleteSupplier() {
                $(document).on("click", "#delete_medicine", function(e) {
                    e.preventDefault();
                    const supplier_id = $(this).val();
                    $("#delete_id").val(supplier_id);
                    $("#deleteModal").removeClass('hidden');
                });


                $("#delete_overlay1, #deleteModalClose1, #cancelDeletemeModal").click(function() {
                    $("#deleteModal").addClass('hidden');
                });
            }
        });
    </script>
@endsection
