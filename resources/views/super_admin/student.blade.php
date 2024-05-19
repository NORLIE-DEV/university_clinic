@extends('layout.superadmin_layout')

@section('content')
    <div class=" bg-white shadow-sm mt-2 flex items-center justify-between gap-2 rounded-sm p-3 overflow-x-hidden"
        style="width: 100%">
        <div class="ml-2">
            <h1 class="text-xl text-gray-500"><i class="fa-solid fa-graduation-cap"></i><span class="ml-2"></span>STUDENT
            </h1>
        </div>
        <form action="/import-excel/student" method="POST" enctype="multipart/form-data" class="flex">
            @csrf
            <div class="flex justify-end w-full">
                <div class="border p-2 bg-gray-200">
                    <input type="file"name="file" id="file" class="text-blue-600 text-xs w-72 inputfile">
                    <button type="submit" class=" bg-blue-600 text-white text-xs p-2 ">Import</button>
                </div>
            </div>
            <style>
                input[type="file"] {
                    position: relative;
                }

                input[type="file"]::file-selector-button {
                    width: 136px;
                    color: transparent;
                }

                input[type="file"]::before {
                    position: absolute;
                    pointer-events: none;
                    top: 10px;
                    left: 16px;
                    height: 20px;
                    width: 20px;
                    content: "";
                    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='%230964B0'%3E%3Cpath d='M18 15v3H6v-3H4v3c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2v-3h-2zM7 9l1.41 1.41L11 7.83V16h2V7.83l2.59 2.58L17 9l-5-5-5 5z'/%3E%3C/svg%3E");
                }

                input[type="file"]::after {
                    position: absolute;
                    pointer-events: none;
                    top: 11px;
                    left: 40px;
                    color: #0964b0;
                    content: "Upload File";
                }

                input[type="file"]::file-selector-button {
                    border-radius: 4px;
                    padding: 0 16px;
                    height: 40px;
                    cursor: pointer;
                    background-color: white;
                    border: 1px solid rgba(0, 0, 0, 0.16);
                    box-shadow: 0px 1px 0px rgba(0, 0, 0, 0.05);
                    margin-right: 16px;
                    transition: background-color 200ms;
                }

                input[type="file"]::file-selector-button:hover {
                    background-color: #f3f4f6;
                }

                input[type="file"]::file-selector-button:active {
                    background-color: #e5e7eb;
                }
            </style>
        </form>
    </div>

    {{-- <div class="flex items-center justify-between mr-10" style="">
        <h1 class="p-5 mt-5 text-2xl font-bold text-blue-950">Student List</h1>
        <div>
            <a href="/superadmin/addstudent" class="bg-blue-950 rounded p-2.5 text-xs shadow font-mono text-white mr-5"><i
                    class="fa-solid fa-graduation-cap"></i><span class="ml-2"></span>Add Student</a>
        </div>
    </div> --}}

    <!-- Table responsive wrapper -->

    @if (session('updateSuccess'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Update Successful',
                text: 'The student information has been updated successfully!',
                timer: 2000,
                showConfirmButton: false
            });
        </script>
    @endif
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Import Successful',
                text: 'Success Data Imported',
                timer: 2000,
                showConfirmButton: false
            });
        </script>
    @endif
    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Upload Unsuccessfull',
                text: 'The Student information has not successfully uploaded',
                timer: 2000,
                showConfirmButton: true
            });
        </script>
    @endif
    <div class="overflow-x-auto bg-white shadow-xl rounded-md mb-10 m-5 p-5">
        <!-- Table -->
        <div class="text-xs">
            <table id="studentTable" class=" text-left text-xs whitespace-nowrap border-collapse p-2">
                <!-- Table head -->
                <thead
                    class="uppercase tracking-wider border-b-2 p-2 bg-gray-700 text-white dark:border-neutral-600 border-t text-xs">
                    <tr>
                        <th scope="col" class="border p-3  dark:border-neutral-600 border-gray-300 text-center ">
                            STUDENT ID
                        </th>

                        <th scope="col" class="border dark:border-neutral-600 border-gray-300 text-center">
                            NAME
                        </th>

                        <th scope="col" class="border dark:border-neutral-600 border-gray-300 text-center">
                            EMAIL
                        </th>
                        <th scope="col" class="border dark:border-neutral-600 border-gray-300 text-center">
                            DEPARTMENT
                        </th>
                        <th scope="col" class="border dark:border-neutral-600 border-gray-300 text-center">
                            LEVEL
                        </th>
                        <th scope="col" class="border dark:border-neutral-600 border-gray-300 text-center">
                            COURSE
                        </th>
                        <th scope="col" class="border dark:border-neutral-600 border-gray-300 text-center">
                            S/Y
                        </th>
                        <th scope="col" class="border dark:border-neutral-600 border-gray-300 text-center">
                            STATUS
                        </th>
                        <th scope="col" class="border dark:border-neutral-600 border-gray-300 text-center">
                            ACTION
                        </th>

                    </tr>
                </thead>

                <!-- Table body -->
                <tbody class="text-xs">

                    @forelse ($students as $student)
                        <tr class="border-b dark:border-neutral-600 hover:bg-neutral-100 dark:hover:bg-neutral-300">
                            <th scope="row"
                                class=" border dark:border-neutral-600 border-gray-300 font-extralight text-center text-xs">
                                {{ $student->id }}
                            </th>


                            <th scope="row"
                                class="px-2 py-2 border dark:border-neutral-600 border-gray-300 font-extralight text-center">
                                {{ $student->first_name }} {{ $student->middle_name }} {{ $student->last_name }}
                            </th>
                            <th scope="row"
                                class="px-2 py-2 border dark:border-neutral-600 border-gray-300 font-extralight text-center">
                                {{ $student->email }}
                            </th>
                            <th scope="row"
                                class="px-2 py-2 border dark:border-neutral-600 border-gray-300 font-extralight text-center">
                                {{ $student->student_department }}
                            </th>
                            <th scope="row"
                                class="px-2 py-2 border dark:border-neutral-600 border-gray-300 font-extralight text-center">
                                {{ $student->student_level }}
                            </th>
                            <th scope="row"
                                class="px-2 py-2 border dark:border-neutral-600 border-gray-300 font-extralight text-center">
                                {{ $student->course }}
                            </th>
                            <th scope="row"
                                class="px-2 py-2 border dark:border-neutral-600 border-gray-300 font-extralight text-center">
                                {{ $student->school_year_enrolled }}
                            </th>
                            <th
                                scope="row"class="px-2 py-2 border dark:border-neutral-600 border-gray-300 font-extralight
                                                                                                                                                                                                                                                                                    @if ($student->status === 'active' || $student->status === 'Active') bg-green-500
                                        @else bg-red-500 @endif
                                                                                                                                                                                                                                                                                    text-center text-white">
                                {{ $student->status }}
                            </th>

                            <th scope="row" class="px-2 py-2 border dark:border-neutral-600 border-gray-300 text-center">
                                <a href="/update_student/{{ $student->id }}" id="update-student">
                                    <button
                                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-2 rounded mr-2 text-xs"><i
                                            class="fa-solid fa-pen-to-square"></i></button></a>
                                <button onclick="confirmDelete('student', {{ $student->id }})"
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

    <script>
        function confirmDelete(model, id) {
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
            $('#studentTable').DataTable();

        })
    </script>
@endsection
