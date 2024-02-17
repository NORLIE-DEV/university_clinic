@extends('layout.superadmin_layout')

@section('content')
    {{-- @if (Session::has('duplicateEntries'))
        <div class="alert alert-warning">
            <ul>
                @foreach (Session::get('duplicateEntries') as $message)
                    <li>{{ $message }}</li>
                @endforeach
            </ul>
        </div>
    @endif --}}
    <div class="flex items-center justify-between mr-10" style="">
        <h1 class="p-2 mt-5 ml-2 text-xl font-bold">Patient List</h1>
        <div>
            <a href="/addpatient" class="bg-green-500 rounded p-2 text-xs shadow font-mono text-white mr-5">Add Patient</a>
        </div>
    </div>

    <!-- Table responsive wrapper -->
    <div class="overflow-x-auto bg-white m-4 rounded-md mb-10 text-xs">
        <!-- Table -->
        <div class="">
            <table id="studentPatientTable" class="w-full text-left text-xs whitespace-nowrap p-2 border-collapse">
                <!-- Table head -->
                <thead class="uppercase tracking-wider border-b-2 dark:border-neutral-600 border-t ">
                    <tr class="text-xs">
                        <th scope="col" class="border dark:border-neutral-600 border-gray-300 text-center">
                            ID
                        </th>
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
                            STATUS
                        </th>

                        <th scope="col" class="border dark:border-neutral-600 border-gray-300 text-center">
                            ACTION
                        </th>

                    </tr>
                </thead>

                <!-- Table body -->
                <tbody class="text-xs">
                    @foreach ($patients as $key => $patient)
                        @if ($patient->student)
                            <tr class="border-b dark:border-neutral-600 hover:bg-neutral-100 dark:hover:bg-neutral-300">
                                <th scope="row"
                                    class=" border dark:border-neutral-600 border-gray-300 font-extralight text-center text-xs">
                                    {{ $patient->student->id }}
                                </th>
                                <th scope="row"
                                    class="px-2 py-2 border dark:border-neutral-600 border-gray-300 font-extralight text-center">
                                    {{ $patient->student->first_name }} {{ $patient->student->middle_name }}
                                    {{ $patient->student->last_name }}
                                </th>
                                <th scope="row"
                                    class="px-2 py-2 border dark:border-neutral-600 border-gray-300 font-extralight text-center">
                                    {{ $patient->student->email }}
                                </th>
                                <th scope="row"
                                    class="px-2 py-2 border dark:border-neutral-600 border-gray-300 font-extralight text-center">
                                    {{ $patient->student->contact_number }}
                                </th>


                                <th scope="row"class="px-2 py-2 border dark:border-neutral-600 border-gray-300 font-extralight
                                                                        @if ($patient->student->status === 'active' || $patient->student->status === 'Active') bg-green-500
                                    @else bg-red-500 @endif
                                                                        text-center text-white">
                                    {{ $patient->student->status }}
                                </th>


                                <th scope="row"
                                    class="px-2 py-2 border dark:border-neutral-600 border-gray-300 text-center">
                                    <a href="/updatedoctor/{{ $patient->student->student_id }}" id="update-doctor">
                                        <button
                                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-2 rounded mr-2 text-xs"><i
                                                class="fa-solid fa-pen-to-square"></i></button></a>
                                    <button
                                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-2 rounded mr-2 text-xs"
                                        id="delete_doctor" value="{{ $patient->student->student_id }}"><i
                                            class="fa-solid fa-trash"></i></button>
                                    <button
                                        class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-2 rounded text-xs"><i
                                            class="fa-solid fa-users-viewfinder"></i></button>
                                </th>
                            </tr>
                        @elseif ($key !== count($patients) - 1)
                            <p>No associated student</p>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#studentPatientTable').DataTable();
        })
    </script>
@endsection
