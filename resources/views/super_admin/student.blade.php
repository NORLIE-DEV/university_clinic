@extends('layout.superadmin_layout')

@section('content')
    <div class=" shadow-lg  mt-2 flex items-center justify-between bg-blue-950 gap-2 rounded-sm p-3 overflow-x-hidden"
        style="width: 100%">
        <div class="ml-2">
            <h1 class="font-bold text-white"><i class="fa-solid fa-graduation-cap"></i><span class="ml-2"></span>STUDENT</h1>
        </div>
        <form action="/import-excel/student" method="POST" enctype="multipart/form-data" class="flex">
            @csrf
            <div class="flex justify-end w-full">
                <div>
                    <label for="file" class="text-white text-xs">Import File</label>
                    <input type="file"name="file" id="file" class="text-white text-xs">
                    <button type="submit" class=" bg-blue-600 text-white rounded-lg text-xs p-2 ">Import</button>
                </div>
            </div>
        </form>
    </div>

    <div class="flex items-center justify-between mr-10" style="">
        <h1 class="p-5 mt-5 text-2xl font-bold text-blue-950">Student List</h1>
        <div>
            <a href="/superadmin/addstudent" class="bg-blue-950 rounded p-2.5 text-xs shadow font-mono text-white mr-5"><i
                    class="fa-solid fa-graduation-cap"></i><span class="ml-2"></span>Add Student</a>
        </div>
    </div>

    <!-- Table responsive wrapper -->
    <div class="overflow-x-auto bg-white shadow-xl rounded-md mb-10 m-5 p-5">
        <!-- Table -->
        <div class="text-xs">
            <table id="studentTable" class=" text-left text-xs whitespace-nowrap border-collapse p-2">
                <!-- Table head -->
                <thead class="uppercase tracking-wider border-b-2 p-2 dark:border-neutral-600 border-t text-xs">
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
                                <button
                                    class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-2 rounded mr-2 text-xs"
                                    id="delete_student" value="{{ $student->id }}"><i
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
            <h4 class="text-center font-normal text-gray-400 mt-4">Student Successfully Added!</h4>
            <div class="flex items-center justify-center">
                <button class="p-2 bg-blue-600 text-white w-22 flex justify-center mt-5 rounded-md shadow-lg"
                    id="close_successModalMessage">OK</button>
            </div>
        </div>
    </div>

    @include('super_admin.student.modal.delete_student')
    <script>
        $(document).ready(function() {
            $('#studentTable').DataTable();

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

            //delete
            $(document).on("click", "#delete_student", function(e) {
                e.preventDefault();
                const student_id = $(this).val();
                $("#delete_id").val(student_id);
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
        })
    </script>
@endsection
