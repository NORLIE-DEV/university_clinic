@extends('layout.patient_layout')

@section('content')
    <div class="">
        <div class="w-full backgroundimg" style="height: 25vh;">
            <div class="overlay">
                <div class="flex items-center justify-between">
                    <div class="text-left text-white pt-6">
                        <div class="m-4 p-5">
                            <h1 class="text-3xl font-medium">Booked</h1>
                            @if ($current_doctor->department == 'dentist')
                                <div class="mt-3 text-gray-200 ">
                                    <a href="/patient_index">Home</a> <span class="text-gray-200">/ <a
                                            href="/patient/department">Department</a> / <a
                                            href="/patient/department/dental">Dental</a> <span>/
                                            Dr.{{ $current_doctor->name }}</span></span>
                                </div>
                            @else
                                <div class="mt-3 text-gray-200 ">
                                    <a href="/patient_index">Home</a> <span class="text-gray-200">/ <a
                                            href="/patient/department">Department</a> / <a
                                            href="/patient/department/medical">Medical</a> <span>/
                                            Dr.{{ $current_doctor->name }}</span></span>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div>
                        <div class="bg-blue-900 text-white text-sm p-5 mt-10 mr-10 shadow-lg rounded-sm">
                            <span><i class="fa-solid fa-phone"></i></span> Call Us : 09917802070
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bg-white shadow-lg rounded-md border-2 border-l-blue-950"
        style="width: 90%; height:auto; margin:10px auto;">
        <div class="flex">
            <div class="p-3" style="width:20%;">
                @php
                    //    $default_profile = "https://api.dicebear.com/7.x/initials/".$student->first_name."-".$student->last_name.".svg";
                    // echo $default_profile,'<br>';
                    $default_profile = 'https://api.dicebear.com/7.x/adventurer-neutral/svg';
                @endphp
                <div class="mt-10 ml-5">
                    <img class="m-auto"id="image-preview"
                        style="width:200px; height:180px;"src="{{ $current_doctor->image ? asset('storage/doctor/' . $doctor->image) : $default_profile }}">
                </div>
            </div>
            <div class="p-10" style="width:70%;">
                <div class="mt-5">
                    <h1 class="text-2xl text-blue-950 font-medium">Dr. {{ $current_doctor->name }}</h1>
                    <h2 class="text-gray-500 text-md">{{ $current_doctor->designation }}</h2>
                </div>
                <div class="mt-4 ">
                    <h1 class="text-gray-500"> Qualification :<span> {{ $current_doctor->qualification }}</span></h1>
                </div>
                <div class="">
                    <h1 class="text-gray-500"> Speciallization :<span> {{ $current_doctor->specialization }}</span></h1>
                </div>
                <div class="flex mt-4 gap-5 items-center">
                    <div class="bg-white shadow p-3 text-xs">Im a {{ $current_doctor->department }}</div>
                    @if ($current_doctor->department == 'dentist')
                        <div class="text-xs">
                            <a href="/patient/department/dental">
                                <button class="bg-blue-950 rounded-md text-white  p-3">Select other doctor</button>
                            </a>
                        </div>
                    @else
                        <div class="text-xs">
                            <a href="/patient/department/medical">
                                <button class="bg-blue-950 text-white rounded-md p-3">Select other doctor</button>
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- schedule --}}
    <div class="mt-24">

        @php
            use Carbon\Carbon;
            $days = ['sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'];
            $today = Carbon::now();

            $nextOccurrences = [];

            foreach ($days as $day) {
                $selectedDayIndex = array_search($day, $days);
                $nextDayIndex = $selectedDayIndex - $today->dayOfWeek;
                if ($nextDayIndex <= 0) {
                    $nextDayIndex += 7;
                }
                $nextOccurrences[$day] = $today->copy()->addDays($nextDayIndex);
            }

            $addedDays = [];
        @endphp

        @foreach ($doctors as $doctor)
            @if ($doctor->id === $current_doctor->id)
                <div class="doctor-schedule mt-4">
                    <div class="day-container-wrapper flex flex-wrap">
                        @php
                            $doctorHasTiming = false;
                        @endphp
                        @foreach ($days as $day)
                            @php
                                $timingsForDay = $doctor->timings->where('day', $day);
                                $currentDateTime = \Carbon\Carbon::now();
                                $currentDate = $currentDateTime->format('Y-m-d');
                                $currentTime = $currentDateTime->format('H:i');
                            @endphp

                            @if ($timingsForDay->count() > 0)
                                <div class="day-container bg-white border shadow-xl p-5 ml-10 text-xs"
                                    style="width: 45%;height:auto;">
                                    <h3 class="text-lg font-bold">{{ ucfirst($day) }} -
                                        {{ $nextOccurrences[$day]->format('Y-m-d') }}</h3>
                                    <div class="day-details">
                                        @foreach ($timingsForDay as $index => $timing)
                                            @php
                                                $doctorHasTiming = true;
                                                $startTime = \Carbon\Carbon::createFromFormat(
                                                    'H:i:s',
                                                    $timing->start_time,
                                                );
                                                $endTime = \Carbon\Carbon::createFromFormat('H:i:s', $timing->end_time);
                                                $avgTime = $timing->average_consultation_time ?? 30;
                                                $numSlots =
                                                    $startTime->diffInMinutes($endTime) > 0 && $avgTime > 0
                                                        ? $startTime->diffInMinutes($endTime) / $avgTime
                                                        : 0;
                                            @endphp

                                            @if ($numSlots > 0)
                                                <h4 class="text-md font-bold mt-4">Shift {{ $index + 1 }}</h4>
                                                <div class="slot-container">
                                                    @for ($i = 0; $i < $numSlots; $i++)
                                                        @php
                                                            $slotStartTime = $startTime
                                                                ->copy()
                                                                ->addMinutes($i * $avgTime);
                                                            $slotEndTime = $slotStartTime->copy()->addMinutes($avgTime);
                                                            $appointmentId = "appointment_$day" . "_$i";
                                                            $appointmentInfo = [
                                                                'date' => $nextOccurrences[$day]->format('Y-m-d'),
                                                                'day' => ucfirst($day),
                                                                'startTime' => $slotStartTime->format('h:i A'),
                                                                'endTime' => $slotEndTime->format('h:i A'),
                                                                'doctorId' => $doctor->id,
                                                            ];
                                                            $appointmentInfoJson = json_encode($appointmentInfo);
                                                            $appointmentsForSlot = \App\Models\Appointment::where(
                                                                'date',
                                                                $appointmentInfo['date'],
                                                            )
                                                                ->where('start_time', $appointmentInfo['startTime'])
                                                                ->where('end_time', $appointmentInfo['endTime'])
                                                                ->where('doctor_id', $appointmentInfo['doctorId'])
                                                                ->get();
                                                            $appointmentStatus = $appointmentsForSlot->isEmpty()
                                                                ? 'available'
                                                                : 'booked';
                                                            $buttonColor =
                                                                $appointmentStatus === 'booked'
                                                                    ? 'bg-gray-500'
                                                                    : 'bg-blue-950';

                                                            // Check if the current time is past the end time of the slot
                                                            if (
                                                                $nextOccurrences[$day]->format('Y-m-d') ===
                                                                    $currentDate &&
                                                                $currentTime >= $slotEndTime->format('H:i')
                                                            ) {
                                                                $appointmentStatus = 'past';
                                                                $buttonColor = 'bg-gray-500';
                                                            }
                                                        @endphp
                                                        <div class="slot-info mb-3">
                                                            <button
                                                                class="text-white px-4 py-1 rounded-full shadow-md appointment-button {{ $buttonColor }}"
                                                                data-appointment-id="{{ $appointmentId }}"
                                                                data-appointment-info="{{ $appointmentInfoJson }}"
                                                                @if ($appointmentStatus !== 'available') disabled @endif>
                                                                {{ $slotStartTime->format('h:i A') }} -
                                                                {{ $slotEndTime->format('h:i A') }}
                                                            </button>
                                                        </div>
                                                    @endfor
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                    <div>
                                     <hr>
                                    </div>
                                </div>

                            @endif
                        @endforeach
                        @if (!$doctorHasTiming)
                            <div class="day-container bg-white border shadow-xl p-5 ml-10 text-xs"
                                style="width: 45%;height:400px;">
                                <p class="text-lg font-bold">No schedule set</p>
                            </div>
                        @endif
                    </div>
                </div>
            @endif
        @endforeach




        <div id="appointment_modal" class="fixed z-10 inset-0 overflow-y-auto hidden bg-gray-500 bg-opacity-75">
            <div class="flex items-center justify-center min-h-screen p-4">
                <div class="bg-white p-6 rounded-lg shadow-md" style="width: 700px; height:500px;">
                    <div>
                        <input type="hidden" id="doctor_id" value="">
                        <h1 class="text-xl font-bold mb-4" id="modal_title">Appointment Slot</h1>
                        <p id="modal_date"></p>
                        <p id="modal_day"></p>
                        <p id="modal_start_time"></p>
                        <p id="modal_end_time"></p>
                        <input type="text" id="start_time_input" readonly>
                    </div>
                    <input type="text" value="{{ $user->first_name }} {{ $user->last_name }}">
                    <input type="text" value="{{ $user->email }}">
                    <input type="text" value="{{ $user->contact_number }}">
                    <button id="confirm_appointment" class="bg-blue-500 text-white px-4 py-2 rounded-md">Confirm
                        Appointment</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('.appointment-button').click(function() {
                var appointmentInfo = $(this).data('appointment-info');
                var startTime = appointmentInfo.startTime;
                var endTime = appointmentInfo.endTime;
                var date = appointmentInfo.date;
                var day = appointmentInfo.day;
                var doctorId = appointmentInfo
                    .doctorId; // Assuming the doctor ID is available in the appointmentInfo

                // Set the doctor ID value in the hidden input field
                $('#doctor_id').val(doctorId);

                $('#modal_date').text('Date: ' + date);
                $('#modal_day').text('Day: ' + day);
                $('#modal_start_time').text('Start Time: ' + startTime);
                $('#modal_end_time').text('End Time: ' + endTime);
                $('#start_time_input').val(startTime);
                // $('#appointment_modal').show();

                // Check slot availability
                $.ajax({
                    url: '/check-availability',
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        date: date,
                        startTime: startTime,
                        endTime: endTime,
                        doctorId: doctorId,
                    },
                    success: function(response) {
                        alert(response.available);
                        if (response.available) {
                            // Slot is available, show the appointment modal
                            $('#modal_date').text('Date: ' + date);
                            $('#modal_day').text('Day: ' + day);
                            $('#modal_start_time').text('Start Time: ' + startTime);
                            $('#modal_end_time').text('End Time: ' + endTime);
                            $('#start_time_input').val(startTime);
                            $('#appointment_modal').show();
                        } else {
                            $(this).prop('disabled', true).addClass('slotbooked').text(
                                'Slot Booked');
                            if (response.message) {
                                alert(response.message);
                            }
                        }
                    },
                    error: function(xhr, status, error) {
                        // Handle error response
                        console.error(xhr.responseText);
                        alert('Error occurred while checking availability');
                    }
                });
            });

            $('#close_modal').click(function() {
                $('#appointment_modal').hide();
            });

            // BOOKING
            $('#confirm_appointment').click(function() {
                // Gather appointment data
                var date = $('#modal_date').text().split(': ')[1];
                var startTime = $('#modal_start_time').text().split(': ')[1];
                var endTime = $('#modal_end_time').text().split(': ')[1];
                var doctorId = $('#doctor_id')
                    .val();

                var startTimeFormatted = formatTime(startTime);
                var endTimeFormatted = formatTime(endTime);

                alert(startTimeFormatted);
                alert(doctorId);
                alert(endTimeFormatted);


                $.ajax({
                    url: '/make-appointment',
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        date: date,
                        start_time: startTimeFormatted,
                        end_time: endTimeFormatted,
                        doctor_id: doctorId,

                    },
                    success: function(response) {
                        location.reload();
                        $('#appointment_modal').hide();
                    },
                    error: function(xhr, status, error) {
                        // Handle error response
                        console.error(xhr.responseText);
                        alert('Error occurred while making appointment');
                    }
                });
            });

            function formatTime(time) {
                var components = time.split(' ');
                var timePart = components[0];
                var meridiem = components[1];

                var timeComponents = timePart.split(':');
                var hours = parseInt(timeComponents[0], 10);
                var minutes = parseInt(timeComponents[1], 10);
                if (meridiem === 'PM' && hours !== 12) {
                    hours += 12;
                }
                var formattedTime = hours.toString().padStart(2, '0') + ':' + minutes.toString().padStart(2, '0');
                return formattedTime;
            }


        });
    </script>

    <style>
        .backgroundimg {
            z-index: 1;
            position: relative;
            background: url('https://img.freepik.com/free-photo/serious-asia-male-doctor-wear-protective-mask-using-clipboard-is-delivering-great-news-talk-discuss-results_7861-3123.jpg?w=1060&t=st=1712630659~exp=1712631259~hmac=b8450e72ac20678f0526f8d1c825c14efc9f407594b890a94d774994e3a1de91') no-repeat center center/cover;
        }

        .overlay {
            position: absolute;
            z-index: 2;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.6);
        }

        .slot-container {
            margin-top: 2rem;
            padding: 2rem;
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            max-width: 100%;
            overflow-x: auto;
            justify-content: start;
        }
    </style>
@endsection
