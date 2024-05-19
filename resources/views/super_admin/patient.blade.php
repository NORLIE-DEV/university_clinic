@extends('layout.superadmin_layout')

@section('content')
    {{-- <div class="m-5 text-xl text-gray-500">
        Patient
    </div>
    <div class="ml-5 mt-5 flex gap-5">

        <div class="w-60 h-32 bg-pink-600 shadow-lg border rounded-lg">
            <div class="flex ">
                <div class="w-14 h-14 rounded-full m-4 mt-10 bg-white flex justify-center items-center">
                    <i class="fa-solid fa-graduation-cap text-2xl text-gray-600"></i>
                </div>
                <div class="flex items-center">
                    <div class="mt-10">
                        <div class="text-white text-xl">Students</div>
                        <a href="/superadmin/patient/student">
                            <button class="text-xs p-2 bg-pink-300 text-pink-900 rounded-sm  mt-4">View All
                                Students</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="w-60 h-32 bg-blue-600 shadow-lg border rounded-lg">
            <div class="flex ">
                <div class="w-14 h-14 rounded-full m-4 mt-10 bg-white flex justify-center items-center">
                    <i class="fa-solid fa-users text-2xl text-gray-600"></i>
                </div>
                <div class="flex items-center">
                    <div class="mt-10">
                        <div class="text-white text-xl">Employee</div>
                        <a href="/superadmin/patient/employee">
                            <button class="text-xs p-2 bg-blue-300 text-blue-900 rounded-sm  mt-4">View All
                                Employees</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <form action="/superadmin/patient_import_data" method="post">
            @csrf
            <button type="submit">
                <div class="w-60 h-40 bg-white rounded-lg shadow-2xl" style="border-bottom: 4px solid rgb(2, 2, 66)">
                    <h1 class="absolute p-2 font-medium text-blue-950">SYNC</h1>
                    <div class="flex justify-center">
                        <img src="{{ asset('asset/img/sc.png') }}" class="w-44" alt="sync">
                    </div>
                </div>
            </button>
        </form>
    </div> --}}
    <form action="/superadmin/patient_import_data" method="post">
        @csrf
        <button id="my-btn" class="icon-btn">
            <i class="fa fa-refresh" aria-hidden="true"></i>
        </button>
    </form>
    <div class="w-full h-auto p-5 items-center flex justify-between">
        <h1 class=" text-xl text-gray-400"><i class="fa-solid fa-hospital-user"></i><span class="ml-1"></span>Student
            Patient
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
                            Patient Type
                        </th>
                        <th scope="col" class="border dark:border-neutral-600 border-gray-300 text-center">
                            STATUS
                        </th>
                    </tr>
                </thead>

                <!-- Table body -->
                <tbody class="text-xs">
                    @foreach ($patients as $key => $patient)
                        @if ($patient)
                            <tr class="border-b dark:border-neutral-600 hover:bg-neutral-100 dark:hover:bg-neutral-300">
                                <th scope="row"
                                    class=" border dark:border-neutral-600 border-gray-300 font-extralight text-center text-xs">
                                    {{ $patient->student->id ?? ($patient->employee->id ?? '') }}

                                </th>
                                <th scope="row"
                                    class="px-2 py-2 border dark:border-neutral-600 border-gray-300 font-extralight text-center">
                                    {{ $patient->student->first_name ?? ($patient->employee->first_name ?? '') }}
                                    {{ $patient->student->middle_name ?? $patient->employee->middle_name }}
                                    {{ $patient->student->last_name ?? ($patient->employee->last_name ?? '') }}
                                </th>
                                <th scope="row"
                                    class="px-2 py-2 border dark:border-neutral-600 border-gray-300 font-extralight text-center">
                                    {{ $patient->student->email ?? ($patient->employee->email ?? '') }}
                                </th>

                                <th scope="row"
                                    class="px-2 py-2 border dark:border-neutral-600 border-gray-300 font-extralight text-center">
                                    {{ $patient->student->contact_number ?? ($patient->employee->contact_number ?? '') }}
                                </th>
                                <th scope="row"
                                    class="px-2 py-2 border dark:border-neutral-600 border-gray-300 font-extralight text-center">

                                    @if (isset($patient->student) && $patient->student->type === 'student')
                                        <div class="text-xs p-2 bg-pink-600 text-white">
                                            Student
                                        </div>
                                    @elseif(isset($patient->employee) && $patient->employee->type === 'employee')
                                        <div class="text-xs p-2 bg-blue-600 text-white">
                                            Employee
                                        </div>
                                    @endif
                                </th>
                                @php
                                    $status = $patient->student->status ?? ($patient->employee->status ?? '');
                                    $bgClass = 'bg-red-500';
                                    if (
                                        isset($patient->student) &&
                                        in_array(strtolower($patient->student->status), ['active'])
                                    ) {
                                        $bgClass = 'bg-green-500';
                                    } elseif (
                                        isset($patient->employee) &&
                                        in_array(strtolower($patient->employee->status), ['active'])
                                    ) {
                                        $bgClass = 'bg-green-500';
                                    }
                                @endphp

                                <th scope="row"
                                    class="px-2 py-2 border dark:border-neutral-600 border-gray-300 font-extralight text-center text-white {{ $bgClass }}">
                                    {{ $status }}
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
