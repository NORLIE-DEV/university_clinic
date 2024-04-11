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
                    <div class="day-container-wrapper flex gap-y-10 flex-wrap justify-start">
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
                                    <div class="flex justify-between items-center">
                                        <h3 class="text-lg font-bold">
                                            <span class="text-blue-950 p-3"><i
                                                    class="fa-solid fa-calendar-plus"></i></span>{{ $nextOccurrences[$day]->locale('en')->formatLocalized('%B %d, %Y') }}
                                        </h3>
                                        <div class="bg-gray-600 p-3 w-24 text-center rounded-lg shadow-lg text-white">
                                            {{ ucfirst($day) }}
                                        </div>
                                    </div>
                                    <hr class="mt-5">
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
                                            <div class="text-xl font-medium text-blue-950 m-3">
                                                {{ $timing->start_time }} - {{ $timing->end_time }}
                                            </div>
                                            @if (
                                                $numSlots > 0 &&
                                                    !($currentDate === $nextOccurrences[$day]->format('Y-m-d') && $currentTime >= $endTime->format('H:i')))
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
                                                                    ? 'bg-gray-600'
                                                                    : 'bg-blue-950';
                                                            $buttonDisabled =
                                                                $appointmentStatus === 'booked' ? 'disabled' : '';
                                                        @endphp
                                                        <div class="slot-info mb-3">
                                                            <button
                                                                class="text-white px-4 py-1 rounded-full shadow-md appointment-button {{ $buttonColor }}"
                                                                data-appointment-id="{{ $appointmentId }}"
                                                                data-appointment-info="{{ $appointmentInfoJson }}"
                                                                {{ $buttonDisabled }}>
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
                                        <div class="flex justify-center p-5">
                                            <div class="m-3 p-3 text-sm"><span
                                                    class="w-5 h-5 bg-blue-950  text-blue-950 m-1">A3</span>Available</div>
                                            <div class="m-3 p-3 text-sm"><span
                                                    class="w-5 h-5 bg-gray-500  text-gray-500 m-1">A3</span>Not Available
                                            </div>
                                        </div>
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




        <div id="appointment_modal" class="fixed z-10 inset-0 hidden bg-gray-500 bg-opacity-75">
            <div class="flex items-center justify-center min-h-screen p-4">
                <div class="bg-white rounded-lg shadow-lg" style="width: 600px; max-height: 600px; overflow-y: auto;">
                    <div class="sticky top-0">
                        <input type="hidden" id="doctor_id" value="">
                        <div class="flex gap-5 items-center justify-center bg-white shadow-lg pt-5 pb-5 sticky top-0">
                            <h1 class="text-xl font-bold text-center text-blue-900" id="modal_title">Review Request</h1>
                            <div class="absolute right-0">
                                <button class="p-1 mr-5 bg-gray-500 text-sm w-8 rounded-sm shadow-lg text-white"
                                    id="close">X</button>
                            </div>
                        </div>
                        <div>
                            <hr class=" w-full" style="border-width: 1.5px;">
                        </div>
                        <div class="flex items-center gap-5 m-8">
                            <img src="{{ asset('asset/img/79794414_111016303724059_5940762222245445632_n-800x800.png') }}"
                                class="w-10" alt="">
                            <span class="text-lg font-medium">UNC Health Services</span>
                        </div>
                        <div class="m-5">
                            <hr class="mt-5" style="border-width: 1.5px;">
                        </div>
                        <div class="ml-5 font-medium">
                            <h1 class="text-blue-950 font-bold">Date, Time &amp; Address</h1>
                            <div class="m-3 text-blue-950">
                                <div class="flex items-center text-xs mt-3 font-thin w-60">
                                    <div>
                                        <i class="fa-solid fa-calendar text-md"></i>
                                    </div>
                                    <div class="ml-5">
                                        <span id="modal_day"></span>
                                        <span id="modal_date"></span>
                                    </div>
                                </div>
                                <div class="flex items-center text-xs mt-3 font-thin w-60">
                                    <div>
                                        <i class="fa-solid fa-clock text-md"></i>
                                    </div>
                                    <div class="ml-5">
                                        <span id="modal_start_time"></span>
                                        <span id="modal_end_time"></span>
                                    </div>
                                </div>
                                <div class="flex items-center text-xs mt-3 font-thin w-60">
                                    <div>
                                        <i class="fa-solid fa-location-dot text-md "></i>
                                    </div>
                                    <div class="ml-5">
                                        <span>Jaime Hernandez St. Avenue Naga City, Philippines</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="m-5">
                            <hr class="mt-5" style="border-width: 1.5px;">
                        </div>
                        <div class=" m-5 font-medium">
                            <h1 class="text-blue-950 font-bold">Your contact info</h1>
                            <div class="m-3 text-gray-500">
                                <label for="full_name" class="text-xs">Full name</label>
                                <input type="text" name="full_name" id="full_name"
                                    class=" w-full text-xs font-light p-3 border mt-2 outline-none rounded-md"
                                    value="{{ $user->first_name }} {{ $user->last_name }}">
                            </div>
                            <div class="m-3 text-gray-500">
                                <label for="phone_number" class="text-xs">Phone number <span>(optional)</span> </label>
                                <input type="text" name="phone_number" id="phone_number"
                                    class=" w-full text-xs font-light p-3 border mt-2 outline-none rounded-md">
                            </div>
                            <div class="m-3 text-gray-500">
                                <label for="notes" class="text-xs">Appointment notes
                                    <span>(optional)</span></label><br>
                                <textarea name="notes" id="notes" class="outline-none border w-full mt-2 text-xs font-light h-20 p-3"></textarea>
                                <p class="text-xs font-thin">Let UNC health services know if you have a special request.
                                </p>
                            </div>
                        </div>
                        <div class="m-3 pb-5">
                            <button id="confirm_appointment"
                                class="bg-blue-500 text-white w-full px-4 py-2 rounded-md">Confirm Appointment</button>
                        </div>
                    </div>

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
                    .doctorId;

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
                       // alert(response.available);
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

            $('#close').click(function() {
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

                var phone_number = $('#phone_number').val();
                var full_name = $('#full_name').val();
                var notes = $('#notes').val();

                var startTimeFormatted = formatTime(startTime);
                var endTimeFormatted = formatTime(endTime);


                alert(startTimeFormatted);
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
                        phone_number: phone_number,
                        full_name: full_name,
                        notes: notes,

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
                var timeComponents = time.split(':');
                var hours = parseInt(timeComponents[0], 10);
                var minutes = parseInt(timeComponents[1], 10);

                // Extract meridiem from the last two characters of the string
                var meridiem = time.slice(-2);

                // Convert hours to 24-hour format if necessary
                if (meridiem === 'PM' && hours !== 12) {
                    hours += 12;
                } else if (meridiem === 'AM' && hours === 12) {
                    hours = 0;
                }

                // Format hours and minutes with leading zeros
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
            padding: 2rem;
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            max-width: 100%;
            overflow-x: auto;
            justify-content: start;
        }

        .bg-white {
            scrollbar-width: none;

            -ms-overflow-style: none;
        }

        .bg-white::-webkit-scrollbar {
            display: none;
        }
    </style>
@endsection
