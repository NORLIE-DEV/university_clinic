@extends('layout.admin_layout')

@section('content')
    <div class="ml-7 mt-5 mb-3 text-xl font-semibold text-blue-950">
        Supplier List
    </div>
    <div class="ml-7 mb-5 text-gray-500">
        <a href="/admin_inventory_index">Index</a><span> / </span><a href="#">Supplier List</a>
    </div>
    <div class="m-auto h-14 rounded-t border-t-2 border-t-green-600 bg-green-200 items-center hidden" id="addsuccess"
        style="width:95%;">
        <h1 class="ml-2 font-semibold text-green-800 p-3">Supplier Successfully Added!</h1>
    </div>

    @if (session('success'))
        <div class="m-auto h-14 rounded-t border-t-2 border-t-green-600 bg-green-200 items-center" id="editsuccess"
            style="width:95%;">
            <h1 class="ml-2 font-semibold text-green-800 p-3">Supplier Successfully Updated!</h1>
        </div>
    @endif
    <div class=" m-auto bg-white h-[500px] rounded-lg shadow mt-2" style="width: 95%;">
        <div class="p-5">
            <a href="/admin/add_supplier">
                <button class="text-sm bg-blue-900 text-white p-2 rounded-sm">Add New Supplier</button>
            </a>
        </div>
        <div class="m-5">
            <table id="tableMedicine" class="">
                <thead class="uppercase tracking-wider p-2  text-xs text-center">
                    <tr>
                        <th scope="col" class="  text-center">
                            NAME
                        </th>

                        <th scope="col" class="  text-center">
                            CONTACT NUMBER
                        </th>
                        <th scope="col" class="  text-center">
                            EMAIL
                        </th>
                        <th scope="col" class="  text-center">
                            ADDRESS
                        </th>
                        <th scope="col" class="  text-center">
                            ACTION
                        </th>

                    </tr>
                </thead>
                <tbody class="text-sm">
                    @forelse ($suppliers as $supplier)
                        <tr class="dark:border-neutral-600 hover:bg-neutral-100 dark:hover:bg-neutral-300">
                            <th scope="row"
                                class="px-2 py-2 border-t border-b dark:border-neutral-600 border-gray-300 font-extralight text-left">
                                {{ $supplier->name }}
                            </th>

                            <th scope="row"
                                class="px-2 py-2 border-t border-b dark:border-neutral-600 border-gray-300 font-extralight text-left">
                                {{ $supplier->contact_number }}
                            </th>
                            <th scope="row"
                                class="px-2 py-2 border-t border-b dark:border-neutral-600 border-gray-300 font-extralight text-left">
                                {{ $supplier->email }}
                            </th>
                            <th scope="row"
                                class="px-2 py-2 border-t border-b dark:border-neutral-600 border-gray-300 font-extralight text-left">
                                {{ $supplier->address }}
                            </th>
                            <th scope="row"
                                class="px-2 py-2 border-t border-b dark:border-neutral-600 border-gray-300 text-left">
                                <a href="/updatesupplier/{{ $supplier->id }}" id="update-doctor">
                                    <button
                                        class="bg-green-500 hover:bg-green700 text-white font-bold py-2 px-2 rounded mr-2 text-xs"><i
                                            class="fa-solid fa-pen-to-square"></i></button>
                                </a>
                                <button
                                    class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-2 rounded mr-2 text-xs"
                                    id="delete_supplier" value="{{ $supplier->id }}"><i
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
    @include('admin.inventory.supplier.modal.delete')
    <script>
        $(document).ready(function() {
            $("#tableMedicine").DataTable();

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
                $(document).on("click", "#delete_supplier", function(e) {
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
