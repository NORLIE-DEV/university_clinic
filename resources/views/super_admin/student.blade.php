@extends('layout.superadmin_layout')

@section('content')
    <div class="mt-10 mx-4 flex items-center justify-between bg-gray-400 gap-2 rounded-sm p-3 overflow-x-hidden" style="width: 97%">
            <form action="/import-excel" method="POST" enctype="multipart/form-data" class="flex">
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
    <div class="overflow-x-auto bg-white m-4 rounded-md mb-10">
        <!-- Table -->
        <div class="">
            <table id="myTable" class="w-full text-left text-lg whitespace-nowrap p-2 border-collapse">
                <!-- Table head -->
                <thead class="uppercase tracking-wider border-b-2 dark:border-neutral-600 border-t text-xs">
                    <tr>
                        <th scope="col" class="border p-2  dark:border-neutral-600 border-gray-300 text-center">
                            PATIENT NAME
                        </th>

                        <th scope="col" class="border dark:border-neutral-600 border-gray-300 text-center">
                            EMAIL
                        </th>
                        <th scope="col" class="border dark:border-neutral-600 border-gray-300 text-center">
                            CONTACT NUMBER
                        </th>
                        <th scope="col" class="border dark:border-neutral-600 border-gray-300 text-center">
                            Patient Type
                        </th>
                        <th scope="col" class="border dark:border-neutral-600 border-gray-300 text-center">
                            STUDENT/EMPLOYEE ID
                        </th>
                        <th scope="col" class="border dark:border-neutral-600 border-gray-300 text-center">
                            ACTION
                        </th>

                    </tr>
                </thead>

                <!-- Table body -->
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
@endsection
