@extends('layout.superadmin_layout')

@section('content')
    @if (session('updateSuccess'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Doctor Update Successful',
                text: 'Sucessfully Update',
                timer: 2000,
                showConfirmButton: false
            });
        </script>
    @endif
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
                    <thead
                        class="uppercase tracking-wider bg-gray-700 text-white border-b-2 dark:border-neutral-600 border-t text-xs">
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

                    <tbody class="text-xs">
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
                                    <button onclick="confirmDelete('doctor', '{{ $doctor->id }}')"
                                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-2 rounded mr-2 text-xs">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
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
    <script>
        function confirmDelete(model, id) {
            //alert(id);
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    // If user confirms deletion, send a DELETE request
                    fetch("{{ route('delete.data', ['model' => ':model', 'id' => ':id']) }}".replace(':model',
                            model).replace(':id', id), {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            }
                        })
                        .then(response => {
                            if (response.ok) {
                                return response.json();
                            }
                            throw new Error('Network response was not ok.');
                        })
                        .then(data => {
                            // Handle response data
                            Swal.fire({
                                title: "Deleted!",
                                text: "Your record has been deleted.",
                                icon: "success"
                            }).then(() => {
                                // Reload the page after the success message is closed
                                window.location.reload();
                            });
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            // Display error message if needed
                        });
                }
            });
        }
    </script>
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
                        Swal.fire({
                            icon: 'success',
                            title: 'Doctor Successfully Added',
                            text: 'Added Sucessfully',
                            timer: 2000,
                            showConfirmButton: false
                        });
                        setTimeout(function() {
                            // $("#addSuccess").hide();
                            var newUrl = window.location.href.split('?')[0];
                            history.replaceState(null, null, newUrl);
                        }, 4000);
                    }
                } catch (error) {
                    console.error('Error in showSuccessModal:', error);
                }
            }
        });
    </script>
@endsection
