@extends('layout.superadmin_layout')

@section('content')
    <div class="mt-10 mx-4 flex items-center justify-between bg-gray-400 gap-2 rounded-sm p-3 overflow-x-hidden"
        style="width: 97%">
        <form action="/import-excel/student" method="POST" enctype="multipart/form-data" class="flex">
            @csrf
            <div>
                <a href="/export-users" class=" bg-blue-500 text-white rounded-md shadow-lg text-xs">Export to Excel FIle</a>
                {{-- <button class="p-2 bg-red-500 text-white rounded-md shadow-lg">Export to PDF FIle</button> --}}
            </div>
            <div>
                <label for="file" class="text-white text-xs">Import File</label>
                <input type="file"name="file" id="file" class="text-white text-xs">
                <button type="submit" class=" bg-orange-600 text-white rounded-lg text-xs">Import</button>
            </div>
        </form>
    </div>

    <div class="flex items-center justify-between mr-10" style="">
        <h1 class="p-5 mt-5 text-2xl font-bold text-blue-950">Student List</h1>
        <div>
            <a href="/addpatient" class="bg-blue-950 rounded p-2 text-xs shadow font-mono text-white mr-5">Add Patient</a>
        </div>
    </div>

    <!-- Table responsive wrapper -->
    <div class="overflow-x-auto bg-white rounded-md mb-10 m-2">
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
                                <a href="/updatedoctor/{{ $student->id }}" id="update-doctor">
                                    <button
                                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-2 rounded mr-2 text-xs"><i
                                            class="fa-solid fa-pen-to-square"></i></button></a>
                                <button
                                    class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-2 rounded mr-2 text-xs"
                                    id="delete_doctor" value="{{ $student->id }}"><i
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
    <script>
        $(document).ready(function() {
            $('#studentTable').DataTable();

        })
    </script>
@endsection
