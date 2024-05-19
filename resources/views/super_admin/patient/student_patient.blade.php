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

    <div class="w-full h-auto p-5 items-center flex justify-between">
        <h1 class=" text-xl text-gray-400"><i class="fa-solid fa-hospital-user"></i><span class="ml-1"></span>Student Patient
            List</h1>
        <a href="/superadmin/patient">
            <button class="text-xs p-3 bg-gray-600 w-20 text-white rounded-sm">Back</button>
        </a>
    </div>
    <!-- Table responsive wrapper -->
    <div class="overflow-x-auto bg-white shadow-xl p-5 m-4 rounded-md mb-10 text-xs">
        <!-- Table -->
        <div class="">
            <table id="studentPatientTable" class="w-full text-left text-xs whitespace-nowrap p-2 border-collapse">
                <!-- Table head -->
                <thead
                    class="uppercase tracking-wider border-b-2 bg-gray-700 font-light text-white dark:border-neutral-600 border-t ">
                    <tr class="text-xs">
                        <th scope="col" class="  border dark:border-neutral-600 border-gray-300 text-center">
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

                            </tr>
                        @elseif ($key !== count($patients) - 1)
                            {{-- <p>No associated student</p> --}}
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
