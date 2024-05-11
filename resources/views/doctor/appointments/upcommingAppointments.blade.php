@extends('layout.doctor_layout')

@section('content')
    <div class="bg-white m-3 flex justify-between items-center shadow-xl">
        <div class="p-3 mb-2 text-gray-500"><i class="fa-solid fa-calendar-check"></i> Upcomming Appointments</div>
        <ul class="flex m-3 text-xs">
            <li class="p-2"><a href="/doctor_index/allappointments"
                    class="p-3 bg-blue-600 text-white rounded-md shadow-md "><span><i
                            class="fa-solid fa-calendar-check"></i></span> Todays
                    Appointments</a></li>
            <li class="p-2"><a href="/doctor_index/completed_appointments"
                    class="p-3  bg-green-600 text-white rounded-md shadow-md "><span><i
                            class="fa-solid fa-clipboard-check"></i></span>
                    Appointments Completed</a></li>
            <li class="p-2"><a href="/doctor_index/upcomming_appointments"
                    class="p-3 bg-teal-600 text-white rounded-md shadow-md "><span><i
                            class="fa-solid fa-calendar-check"></i></span> Upcomming
                    Appointments</a></li>
            <li class="p-2"><a href="/doctor_index/appointments_history"
                    class="p-3  bg-gray-600 text-white rounded-md shadow-md "><span><i class="fa-solid fa-clock"></i></span>
                    Appointments
                    History</a></li>

        </ul>
    </div>
    <div class=" rounded-md shadow-xl p-3" style="width: 100%; height:100vh;">

        <!-- Table responsive wrapper -->
        <div class="overflow-x-auto bg-white shadow-xl dark:bg-neutral-700 p-5">
            <!-- Table -->
            <table class="min-w-full border text-left text-xs shadow-xl whitespace-nowrap tableContainer"
                id="allappointmentTable">

                <!-- Table head -->
                <thead class="uppercase tracking-wider border-b-2 dark:border-neutral-600 border-t ">
                    <tr class="text-[#00ACBA]">
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
                                @if ($appointment->appointment_status === 'booked')
                                    <div class="text-xs p-2 bg-blue-600 rounded-sm text-white text-center">
                                        {{ $appointment->appointment_status }}</div>
                                @elseif ($appointment->appointment_status === 'completed')
                                    <div class="text-xs p-2 bg-green-600 rounded-sm text-white text-center">
                                        {{ $appointment->appointment_status }}</div>
                                @elseif ($appointment->appointment_status === 'cancelled')
                                    <div class="text-xs p-2 bg-gray-600 rounded-sm text-white text-center">
                                        {{ $appointment->appointment_status }}</div>
                                @elseif ($appointment->appointment_status === 'patient not available')
                                    <div class="text-xs p-2 bg-red-600 rounded-sm text-white text-center">
                                        {{ $appointment->appointment_status }}</div>
                                @endif
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
