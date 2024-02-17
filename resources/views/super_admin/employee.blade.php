@extends('layout.superadmin_layout')

@section('content')
    <div class="mt-10 mx-4 flex items-center justify-between bg-gray-400 gap-2 rounded-sm p-3 overflow-x-hidden"
        style="width: 97%">
        <form action="/import-excel/employee" method="POST" enctype="multipart/form-data" class="flex">
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
        <h1 class="p-5 mt-5 text-2xl font-bold text-blue-950">Employee List</h1>
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
                    <tr class="text-xs">
                        <th scope="col" class="border p-2  dark:border-neutral-600 border-gray-300 text-center ">
                            EMPLOYEE ID
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
                            POSITION
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
                    @forelse ($employees as $employee)
                        <tr class="border-b dark:border-neutral-600 hover:bg-neutral-100 dark:hover:bg-neutral-300">
                            <th scope="row"
                                class=" border dark:border-neutral-600 border-gray-300 font-extralight text-center text-xs">
                                {{ $employee->id }}
                            </th>


                            <th scope="row"
                                class="px-2 py-2 border dark:border-neutral-600 border-gray-300 font-extralight text-center">
                                {{ $employee->first_name }} {{ $employee->middle_name }} {{ $employee->last_name }}
                            </th>
                            <th scope="row"
                                class="px-2 py-2 border dark:border-neutral-600 border-gray-300 font-extralight text-center">
                                {{ $employee->email }}
                            </th>
                            <th scope="row"
                                class="px-2 py-2 border dark:border-neutral-600 border-gray-300 font-extralight text-center">
                                {{ $employee->employee_department }}
                            </th>
                            <th scope="row"
                                class="px-2 py-2 border dark:border-neutral-600 border-gray-300 font-extralight text-center">
                                {{ $employee->employee_position }}
                            </th>

                            <th scope="row"class="px-2 py-2 border dark:border-neutral-600 border-gray-300 font-extralight
                                                @if ($employee->status === 'active' || $employee->status === 'Active') bg-green-500
                                    @else bg-red-500 @endif
                                                text-center text-white">
                                {{ $employee->status }}
                            </th>


                            <th scope="row" class="px-2 py-2 border dark:border-neutral-600 border-gray-300 text-center">
                                <a href="/updatedoctor/{{ $employee->id }}" id="update-doctor">
                                    <button
                                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-2 rounded mr-2 text-xs"><i
                                            class="fa-solid fa-pen-to-square"></i></button></a>
                                <button
                                    class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-2 rounded mr-2 text-xs"
                                    id="delete_doctor" value="{{ $employee->id }}"><i
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
@endsection
