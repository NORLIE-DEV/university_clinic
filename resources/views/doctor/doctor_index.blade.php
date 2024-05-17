@extends('layout.doctor_layout')

@section('content')
    <div class="m-5 flex justify-between items-center">
        <div style="width: 80%;">
            <div class="font-medium text-xl">Welcome Dr.<span>{{ $doctor->name }}</span></div>
            <div class="text-sm text-gray-500">Have a nice day at great work</div>
        </div>
        <div style="width:20%;">
            <div class="bg-white w-40 h-10 shadow-lg rounded-lg float-end">
                @php
                    use Carbon\Carbon;
                    // Set the timezone to Asia/Manila (Philippines)
                    date_default_timezone_set('Asia/Manila');
                    $currentDate = Carbon::now()->format('F d, Y');
                @endphp
                <div class="text-center">
                    <div class="flex items-center p-2 justify-center font-medium">
                        {{ $currentDate }}<i class="fa-solid fa-calendar-days ml-3 text-[#00ACBA]"></i>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="flex  justify-between m-5">
        <div class="w-60 h-28 bg-blue-400 rounded-md shadow-xl">
            <div class="flex ">
                <div class="w-14 h-14 rounded-full m-4 mt-7 bg-white flex justify-center items-center">
                    <i class="fa-regular fa-calendar text-3xl text-blue-400"></i>
                </div>
                <div class="flex items-center">
                    <div>
                        <div class="text-3xl text-white font-medium">{{ $appointmentCount }}</div>
                        <div class="text-white">Appointments</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="w-60 h-28 bg-teal-400 rounded-md shadow-xl gap-10">
            <div class="flex">
                <div class="w-14 h-14 rounded-full m-4 mt-7 bg-white flex justify-center items-center">
                    <i class="fa-regular fa-calendar-days text-3xl text-blue-400"></i>
                </div>
                <div class="flex items-center">
                    <div class="mt-5">
                        <div class="text-3xl text-white font-medium">{{ $upcommingappointmentCount }}</div>
                        <div class="text-white text-md"> Upcomming <br> <span>Appointments</span></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="w-60 h-28 bg-violet-700 rounded-md shadow-xl">
            <div class="flex ">
                <div class="w-14 h-14 rounded-full m-4 mt-7 bg-white flex justify-center items-center">
                    <i class="fa-regular fa-calendar text-3xl text-blue-400"></i>
                </div>
                <div class="flex items-center">
                    <div>
                        <div class="text-3xl text-white font-medium">48</div>
                        <div class="text-white">Appointments</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="w-60 h-28 bg-blue-500 rounded-md shadow-xl">
            <div class="flex ">
                <div class="w-14 h-14 rounded-full m-4 mt-7 bg-white flex justify-center items-center">
                    <i class="fa-regular fa-calendar text-3xl text-blue-400"></i>
                </div>
                <div class="flex items-center">
                    <div>
                        <div class="text-3xl text-white font-medium">48</div>
                        <div class="text-white">Appointments</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="flex justify-between m-5">
        <div class="w-80 h-60 bg-[#fff] rounded-lg shadow-xl">
            <div class="flex justify-between m-5">
                <div class="font-medium text-gray-700">Todays Appointment</div>
                <div><a href="/doctor_index/allappointments" class="text-[#00ACBA]">See all</a></div>
            </div>
            <hr class="border border-5 m-3">

            @php
                use App\Models\Appointment;
                $doctorId = Auth::id();
                $appointments = Appointment::where('doctor_id', $doctorId)
                    ->whereDate('date', '=', now()->toDateString())
                    ->get();
                $default_profile = 'https://api.dicebear.com/7.x/adventurer-neutral/svg?';
            @endphp

            @php
                $date = now()->toDateString();
            @endphp
            @php $count = 0; @endphp
            @if ($date === now()->toDateString())
                @if ($appointments->isEmpty())
                    <div class="flex justify-center mt-5">
                        <img src="{{ asset('asset/img/logo/error (1).png') }}" class="w-20 h-20" alt="warning">
                    </div>
                    <div class="text-center text-gray-500">
                        No Appointments Today
                    </div>
                @else
                    @foreach ($appointments as $appointment)
                        @if ($count < 2)
                            <div class="flex justify-between m-4 items-center border p-3 rounded-md shadow-lg">
                                <div class="font-medium">
                                    {{ $appointment->patient->student->first_name ?? $appointment->patient->employee->last_name }}
                                    {{ $appointment->patient->student->last_name ?? $appointment->patient->employee->last_name }}
                                    @if ($appointment->patient->student)
                                        <div class="text-xs font-normal text-gray-500">Student</div>
                                    @else
                                        <div>Employee</div>
                                    @endif
                                </div>
                                <div class="text-[#00ACBA]">
                                    <div class="bg-[#CDE0FF] p-2 rounded-md text-xs w-20 text-center">
                                        {{ \Carbon\Carbon::parse($appointment->start_time)->format('g:i A') }}
                                    </div>
                                </div>
                            </div>
                            @php $count++; @endphp
                        @endif
                    @endforeach
                @endif
            @else
                <p>No appointments for {{ $date }}.</p>
            @endif



        </div>
        <div class="w-80 h-60 bg-[#fff] rounded-lg shadow-xl">

            <div class="flex justify-between m-5">
                <div class="font-medium text-gray-700">Upcomming Appointments</div>
                <div><a href="/doctor_index/allappointments" class="text-[#00ACBA]">See all</a></div>
            </div>
            <hr class="border border-5 m-3">

            @php
                $doctorId = Auth::id();
                $appointments = Appointment::where('doctor_id', $doctorId)
                    ->whereDate('date', '>', now()->toDateString())
                    ->get();
                $default_profile = 'https://api.dicebear.com/7.x/adventurer-neutral/svg?';
            @endphp

            @php
                $date = now()->toDateString();
            @endphp
            @php $count = 0; @endphp
            @if ($date === now()->toDateString())
                @if ($appointments->isEmpty())
                    <div class="flex justify-center mt-5">
                        <img src="{{ asset('asset/img/logo/error (1).png') }}" class="w-20 h-20" alt="warning">
                    </div>
                    <div class="text-center text-gray-500">
                        No Upcomming Appointments Today
                    </div>
                @else
                    @foreach ($appointments as $appointment)
                        @if ($count < 2)
                            <div class="flex justify-between m-4 items-center border p-3 rounded-md shadow-lg">
                                <div class="font-medium">
                                    {{ $appointment->patient->student->first_name ?? $appointment->patient->employee->last_name }}
                                    {{ $appointment->patient->student->last_name ?? $appointment->patient->employee->last_name }}
                                    @if ($appointment->patient->student)
                                        <div class="text-xs font-normal text-gray-500">Student</div>
                                    @else
                                        <div>Employee</div>
                                    @endif
                                </div>
                                <div class="text-[#00ACBA]">
                                    <div class="bg-[#CDE0FF] p-2 rounded-md text-xs w-20 text-center">
                                        {{ \Carbon\Carbon::parse($appointment->date)->format('M j, Y') }}
                                    </div>
                                </div>
                            </div>
                            @php $count++; @endphp
                        @endif
                    @endforeach
                @endif
            @else
                <p>No appointments for {{ $date }}.</p>
            @endif

        </div>
        <div class="w-80 h-60 bg-[#fff] rounded-lg shadow-xl">

        </div>
    </div>
@endsection
