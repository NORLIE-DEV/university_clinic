@extends('layout.superadmin_layout')

@section('content')
    <div class="bg-white border rounded-2xl shadow-xl mt-5 ml-2" style="width:98%; height:80vh;">
        <div class="mt-2 items-center w-full p-4 flex justify-between">
            <h1 class="text-xl font-medium text-gray-600">Doctor List</h1>
            <a href="/superadmin/doctor/createDoctor" class="bg-blue-900 text-white p-2 text-xs rounded-md font-semibold"><i
                    class="fa-solid fa-square-pen text-white"></i><span class="ml-2"></span>Add Doctor</a>
        </div>
        <div class="overflow-x-auto bg-white m-4 rounded-md mb-10">
            <!-- Table -->
            <div class="">
                <table id="doctorTable" class="w-full text-left text-xs whitespace-nowrap p-2 border-collapse">
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
                                    class="px-2 py-2 border dark:border-neutral-600 border-gray-300 font-extralight text-center">
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
                                <th scope="row"class="px-2 py-2 border dark:border-neutral-600 border-gray-300 font-extralight
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
                                                class="fa-solid fa-pen-to-square"></i>Edit</button></a>
                                    <button
                                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-2 rounded mr-2 text-xs"
                                        id="delete_doctor" value="{{ $doctor->id }}"><i class="fa-solid fa-trash"></i>Delete</button>
                                    <button
                                        class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-2 rounded text-xs"><i class="fa-solid fa-users-viewfinder"></i>View</button>
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
        $(document).ready(function() {
            $('#doctorTable').DataTable();

            // $(document).on("click", "#delete_doctor", function(e) {
            //     e.preventDefault();
            //     const doctor_id = $(this).val();
            //     $("#delete_id").val(doctor_id);
            //     $("#deleteModal").show();
            // });
            // $("#delete_overlay1").click(function() {
            //     $("#deleteModal").hide();
            // });
            // $("#deleteModalClose1").click(function() {
            //     $("#deleteModal").hide();
            // });
            // $("#cancelDeletemeModal").click(function() {
            //     $("#deleteModal").hide();
            // });
        });
    </script>
@endsection
