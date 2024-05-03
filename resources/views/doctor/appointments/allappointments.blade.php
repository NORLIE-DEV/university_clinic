@extends('layout.doctor_layout')

@section('content')
    <div class="bg-white border rounded-md shadow-xl p-3" style="width: 95%; height:auto; margin:1rem auto;">
        <div class="p-3 my-10 font-medium">My Appointments</div>
        <!-- Table responsive wrapper -->
        <div class="overflow-x-auto bg-white dark:bg-neutral-700">

            <!-- Table -->
            <table class="min-w-full text-left text-xs whitespace-nowrap " id="allappointmentTable">

                <!-- Table head -->
                <thead class="uppercase tracking-wider border-b-2 dark:border-neutral-600 border-t">
                    <tr>
                        <th scope="col" class="px-6 py-4 border-x dark:border-neutral-600">
                            Appoinment Id
                        </th>
                        <th scope="col" class="px-6 py-4 border-x dark:border-neutral-600">
                            Appoinment Date
                        </th>
                        <th scope="col" class="px-6 py-4 border-x dark:border-neutral-600">
                            Patient Name
                        </th>
                        <th scope="col" class="px-6 py-4 border-x dark:border-neutral-600">
                            Email
                        </th>
                        <th scope="col" class="px-6 py-4 border-x dark:border-neutral-600">
                            Phone
                        </th>
                        <th scope="col" class="px-6 py-4 border-x dark:border-neutral-600">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-4 border-x dark:border-neutral-600">
                            Action
                        </th>
                    </tr>
                </thead>

                <!-- Table body -->
                <tbody>
                    @forelse ($appointments as $appointment)
                        <tr class="border-b dark:border-neutral-600 hover:bg-neutral-100 dark:hover:bg-neutral-600">
                            <th scope="row" class="px-6 py-4 border-x dark:border-neutral-600 text-left border-b-2">
                                {{ $appointment->id }}
                            </th>
                            <td class="px-6 py-4 border-x dark:border-neutral-600  border-b-2">
                                {{ $appointment->date }}
                            </td>
                            <td class="px-6 py-4 border-x dark:border-neutral-600  border-b-2">
                                @if ($appointment->patient && $appointment->patient->student)
                                    {{ $appointment->patient->student->first_name }}
                                    {{ $appointment->patient->student->last_name }}
                                @elseif($appointment->patient && $appointment->patient->employee)
                                    {{ $appointment->patient->employee->first_name }}
                                    {{ $appointment->patient->employee->last_name }}
                                @else
                                    N/A
                                @endif
                            </td>
                            <td class="px-6 py-4 border-x dark:border-neutral-600 border-b-2">
                                @if ($appointment->patient && $appointment->patient->student)
                                    {{ $appointment->patient->student->email }}
                                @elseif($appointment->patient && $appointment->patient->employee)
                                    {{ $appointment->patient->employee->email }}
                                @else
                                    N/A
                                @endif
                            </td>
                            <td class="px-6 py-4 border-x dark:border-neutral-600 border-b-2">
                                @if ($appointment->patient && $appointment->patient->student)
                                    {{ $appointment->patient->student->contact_number }}
                                @elseif($appointment->patient && $appointment->patient->employee)
                                    {{ $appointment->patient->employee->contact_number }}
                                @else
                                    N/A
                                @endif
                            </td>
                            <td class="px-6 py-4 border-x dark:border-neutral-600 border-b-2">
                                <div class="text-xs p-2 bg-blue-600 rounded-sm text-white text-center">
                                    {{ $appointment->appointment_status }}</div>
                            </td>
                            <td class="px-6 py-4 border-x dark:border-neutral-600 flex justify-center border-b-2">
                                <a href="/doctor_index/view/{{$appointment->id}}">
                                    <button class="text-xs p-2 bg-blue-950 rounded-md shadow-lg text-white"><i
                                            class="fa-solid fa-users-viewfinder"></i><span> View</span></button>
                                </a>
                            </td>
                        </tr>
                    @empty
                    @endforelse

                </tbody>

            </table>

        </div>
    </div>

    <script>
        $('document').ready(function() {

            $("#allappointmentTable").DataTable();
        });
    </script>
@endsection
