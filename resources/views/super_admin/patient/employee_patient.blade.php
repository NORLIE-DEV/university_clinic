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
    {{-- <div class="flex items-center justify-between mr-10" style="">
        <h1 class="p-2 mt-5 ml-2 text-xl font-bold">Patient List</h1>
        <div>
            <a href="/addpatient" class="bg-green-500 rounded p-2 text-xs shadow font-mono text-white mr-5">Add Patient</a>
        </div>
    </div> --}}
  
    <div class="w-full h-auto p-5 items-center flex justify-between">
        <h1 class=" text-xl text-gray-400"><i class="fa-solid fa-hospital-user"></i><span class="ml-1"></span>Employee
            Patient
            List</h1>
        <a href="/superadmin/patient">
            <button class="text-xs p-3 bg-gray-600 w-20 text-white rounded-sm">Back</button>
        </a>
    </div>

    <!-- Table responsive wrapper -->
    <div class="overflow-x-auto bg-white m-10 rounded-md mb-10 text-xs">
        <!-- Table -->
        <div class="">
            <table id="studentPatientTable" class="w-full text-lefttext-xs whitespace-nowrap p-2 border-collapse">
                <!-- Table head -->
                <thead
                    class="uppercase tracking-wider border-b-2  bg-gray-700 text-white  dark:border-neutral-600 border-t ">
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

                    </tr>
                </thead>

                <!-- Table body -->
                <tbody class="text-xs">
                    @foreach ($patients as $key => $patient)
                        @if ($patient->employee)
                            <tr class="border-b dark:border-neutral-600 hover:bg-neutral-100 dark:hover:bg-neutral-300">
                                <th scope="row"
                                    class=" border dark:border-neutral-600 border-gray-300 font-extralight text-center text-xs">
                                    {{ $patient->employee->id }}
                                </th>
                                <th scope="row"
                                    class="px-2 py-2 border dark:border-neutral-600 border-gray-300 font-extralight text-center">
                                    {{ $patient->employee->first_name }} {{ $patient->employee->middle_name }}
                                    {{ $patient->employee->last_name }}
                                </th>
                                <th scope="row"
                                    class="px-2 py-2 border dark:border-neutral-600 border-gray-300 font-extralight text-center">
                                    {{ $patient->employee->email }}
                                </th>
                                <th scope="row"
                                    class="px-2 py-2 border dark:border-neutral-600 border-gray-300 font-extralight text-center">
                                    {{ $patient->employee->contact_number }}
                                </th>


                                <th scope="row"class="px-2 py-2 border dark:border-neutral-600 border-gray-300 font-extralight
                                                                                        @if ($patient->employee->status === 'active' || $patient->employee->status === 'Active') bg-green-500
                                    @else bg-red-500 @endif
                                                                                        text-center text-white">
                                    {{ $patient->employee->status }}
                                </th>
                            </tr>
                        @elseif ($key !== count($patients) - 1)
                            {{-- <p>No associated employee</p> --}}
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
