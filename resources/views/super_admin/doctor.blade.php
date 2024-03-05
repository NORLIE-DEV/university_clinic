@extends('layout.superadmin_layout')

@section('content')
    <div class="bg-white border rounded-2xl shadow-xl m-4 ml-2" style="width:98%; height:auto;">
        <div class="mt-2 items-center w-full p-4 flex justify-between">
            <h1 class="text-xl font-medium text-gray-600">Doctor List</h1>
            <a href="/superadmin/doctor/createDoctor" class="bg-blue-900 text-white p-2 text-xs rounded-md font-semibold"><i
                    class="fa-solid fa-square-pen text-white"></i><span class="ml-2"></span>Add Doctor</a>
        </div>
        <div class="overflow-x-auto bg-white m-4 rounded-md mb-10">
            <!-- Table -->
            <div class="">
                <table id="doctorTable" class="w-full text-left text-xs whitespace-nowrap p-1 border-collapse">
                    <!-- Table head -->
                    <thead class="uppercase tracking-wider border-b-2 dark:border-neutral-600 border-t text-xs">
                        <tr>
                            <th scope="col" class="border p-1  dark:border-neutral-600 border-gray-300 text-center">
                                DEPARTMENT
                            </th>

                            <th scope="col" class="border dark:border-neutral-600 border-gray-300 text-center">
                                NAME
                            </th>
                            <th scope="col" class="border dark:border-neutral-600 border-gray-300 text-center">
                                PHONENUMBER
                            </th>
                            <th scope="col" class="border dark:border-neutral-600 border-gray-300 text-center">
                                EMAIL
                            </th>
                            <th scope="col" class="border dark:border-neutral-600 border-gray-300 text-center">
                                GENDER
                            </th>
                            <th scope="col" class="border dark:border-neutral-600 border-gray-300 text-center">
                                STATUS
                            </th>
                            <th scope="col" class="border dark:border-neutral-600 border-gray-300 text-center">
                                ACTION
                            </th>

                        </tr>
                    </thead>

                    <tbody class="text-sm">
                        @forelse ($doctors as $doctor)
                            <tr class="border-b dark:border-neutral-600 hover:bg-neutral-100 dark:hover:bg-neutral-300">
                                <th scope="row"
                                    class="px-2 py-1 border dark:border-neutral-600 border-gray-300 font-extralight text-center">
                                    {{ $doctor->department }}
                                </th>
                                <th scope="row"
                                    class="px-2 py-2 border dark:border-neutral-600 border-gray-300 font-extralight text-center">
                                    {{ $doctor->name }}
                                </th>

                                <th scope="row"
                                    class="px-2 py-2 border dark:border-neutral-600 border-gray-300 font-extralight text-center">
                                    {{ $doctor->phone_number }}
                                </th>
                                <th scope="row"
                                    class="px-2 py-2 border dark:border-neutral-600 border-gray-300 font-extralight text-center">
                                    {{ $doctor->email }}
                                </th>
                                <th scope="row"
                                    class="px-2 py-2 border dark:border-neutral-600 border-gray-300 font-extralight text-center">
                                    {{ $doctor->gender }}
                                </th>
                                <th
                                    scope="row"class="px-2 py-2 border dark:border-neutral-600 border-gray-300 font-extralight
                                                                                                                                                                                                            @if ($doctor->status === 'active') bg-green-500
                                                @else bg-red-500 @endif
                                                                                                                                                                                                            text-center text-white">
                                    {{ $doctor->status }}
                                </th>


                                <th scope="row"
                                    class="px-2 py-2 border dark:border-neutral-600 border-gray-300 text-center">
                                    <a href="/updatedoctor/{{ $doctor->id }}" id="update-doctor">
                                        <button
                                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-2 rounded mr-2 text-xs"><i
                                                class="fa-solid fa-pen-to-square"></i></button></a>
                                    <button
                                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-2 rounded mr-2 text-xs"
                                        id="delete_doctor" value="{{ $doctor->id }}"><i
                                            class="fa-solid fa-trash"></i></button>
                                    <button
                                        class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-2 rounded text-xs"><i
                                            class="fa-solid fa-users-viewfinder"></i></button>
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
    </div>


    {{-- ADD SUCCESS --}}
    <div class="fixed z-50 inset-0 hidden" id="addSuccess">
        <div class="fixed inset-0 bg-gray-500 opacity-40" id="add_overlay"></div>
        <div class="bg-white rounded m-auto fixed inset-0 z-10 " style="max-height:250px; width:500px">
            <button type="button" id="addModalClose"
                class="text-gray-400 absolute top-2.5 right-2.5 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                data-modal-toggle="deleteModal">
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                        clip-rule="evenodd"></path>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="flex justify-center mt-10">
                <img src="{{ asset('asset/img/Animation - 1707813219352.gif') }}" class="h-20 w-20" alt="delete">
            </div>
            <h4 class="text-center font-normal text-gray-400 mt-4">Doctor Successfully Added!</h4>
            <div class="flex items-center justify-center">
                <button class="p-2 bg-blue-600 text-white w-22 flex justify-center mt-5 rounded-md shadow-lg"
                    id="close_successModalMessage">OK</button>
            </div>
        </div>
    </div>

    {{-- UPDATE SUCCESS --}}
    <div class="fixed z-50 inset-0 hidden" id="updateSuccess">
        <div class="fixed inset-0 bg-gray-500 opacity-40" id="update_overlay"></div>
        <div class="bg-white rounded m-auto fixed inset-0 z-10 " style="max-height:250px; width:500px">
            <button type="button" id="addModalClose"
                class="text-gray-400 absolute top-2.5 right-2.5 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                data-modal-toggle="deleteModal">
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                        clip-rule="evenodd"></path>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>

            <div class="flex justify-center mt-10">
                <img src="{{ asset('asset/img/Animation - 1707813219352.gif') }}" class="h-20 w-20" alt="delete">
            </div>
            <h4 class="text-center font-normal text-gray-400 mt-4">Doctor Successfully Added!</h4>
            <div class="flex items-center justify-center">
                <button class="p-2 bg-blue-600 text-white w-22 flex justify-center mt-5 rounded-md shadow-lg"
                    id="close_updateModalMessage">OK</button>
            </div>
        </div>
    </div>
    @include('super_admin.doctor.modal.delete_doctor')
    <script>
        $(document).ready(function() {
            $('#doctorTable').DataTable();

            $(document).on("click", "#delete_doctor", function(e) {
                e.preventDefault();
                const doctor_id = $(this).val();
                $("#delete_id").val(doctor_id);
                $("#deleteModal").removeClass('hidden');
            });


            $("#delete_overlay1, #deleteModalClose1, #cancelDeletemeModal").click(function() {
                $("#deleteModal").addClass('hidden');
            });


            showSuccessModal();

            function showSuccessModal() {
                try {
                    var urlParams = new URLSearchParams(window.location.search);
                    if (urlParams.has('success') && urlParams.get('success') === 'true') {
                        $("#addSuccess").show();
                        setTimeout(function() {
                            $("#addSuccess").hide();
                            var newUrl = window.location.href.split('?')[0];
                            history.replaceState(null, null, newUrl);
                        }, 4000);
                    }
                } catch (error) {
                    console.error('Error in showSuccessModal:', error);
                }
            }

            $("#close_successModalMessage").click(function() {
                $("#addSuccess").hide();
                var newUrl = window.location.href.split('?')[0];
                history.replaceState(null, null, newUrl);
            });

            showUpdateModal();

            function showUpdateModal() {

                try {
                    var urlParams = new URLSearchParams(window.location.search);
                    if (urlParams.has('updateSuccess') && urlParams.get('updateSuccess') === 'true') {
                        alert(2);
                        $("#updateSuccess").show();
                        setTimeout(function() {
                            $("#updateSuccess").addClass('hidden');
                            var newUrl = window.location.href.split('?')[0];
                            history.replaceState(null, null, newUrl);
                        }, 4000);
                    }
                } catch (error) {
                    console.error('Error in showUpdateModal:', error);
                }
            }

            $("#close_updateModalMessage").click(function() {
                $("#updateSuccess").addClass('hidden');
                var newUrl = window.location.href.split('?')[0];
                history.replaceState(null, null, newUrl);
            });

        });
    </script>
@endsection
