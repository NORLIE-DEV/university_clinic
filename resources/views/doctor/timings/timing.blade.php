@extends('layout.doctor_layout')

@section('content')
    <div class="bg-white shadow p-10" style="width:98%; height:auto; margin:10px auto;">
        <div class="text-xl font-normal text-gray-500">
            Doctor Timings
        </div>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <form action="/create_timing" method="POST">
            @csrf
            <div class="flex justify-between items-center gap-3">
                <div class="mt-5">
                    <label for="day" class="text-gray-500">Select a day</label><br>
                    <select name="day" id="day" class=" rounded-md mt-2 text-xs p-3 text-gray-500 outline-none"
                        style="border:1px solid black; width:150px;">
                        <option value="monday">Monday</option>
                        <option value="tuesday">Tuesday</option>
                        <option value="wednesday">Wednesday</option>
                        <option value="thursday">Thursday</option>
                        <option value="friday">Friday</option>
                        <option value="saturday">Saturday</option>
                        <option value="sunday">Sunday</option>
                    </select>
                </div>
                <div class="mt-5">
                    <label for="start_time" class="text-gray-500">Shift</label><br>
                    <select name="shift" id="shift" class="text-xs p-3 outline-none rounded-md mt-2 text-gray-500"
                        style="border:1px solid black; width:150px;">
                        <option value="Shift 1">Shift 1</option>
                        <option value="Shift 2">Shift 2</option>
                    </select>
                </div>
                <div class="mt-5">
                    <label for="start_time" class="text-gray-500">Start Time:</label><br>
                    <input type="text" id="start_time" class="text-xs p-3 outline-none mt-2 rounded-md"
                        style="border:1px solid black; width:150px;" name="start_time" placeholder="00:00">
                </div>
                <div class="mt-5">
                    <label for="end_time" class="text-gray-500">End Time:</label><br>
                    <input type="text" id="end_time" class="text-xs p-3 outline-none mt-2 rounded-md"
                        style="border:1px solid black;width:150px;" name="end_time" placeholder="00:00">
                </div>
                <div class="mt-5">
                    <label for="shift" class="text-gray-500"e>Avg Consultation time</label><br>
                    <select name="consultation_time" id="consultation_time"
                        class="text-xs p-3 outline-none rounded-md mt-2 text-gray-500"
                        style="border:1px solid black; width:150px;">
                        <option value="15">15 Minutes</option>
                        <option value="30">30 Minutes</option>
                    </select>
                </div>
                <div class="flex items-center mt-5">
                    <button type="submit" id="generateButtons"
                        class="bg-blue-500  mt-7 text-white rounded-md shadow-lg text-xs p-3 w-20">ADD</button>
                </div>
            </div>
        </form>
        <div class="mt-10">
            <table class="w-full text-left text-xs whitespace-nowrap border-collapse text-gray-500 border-1 font-thin">
                <!-- Table head -->
                <thead class="uppercase tracking-wider border-b-2 dark:border-neutral-600 border-t font-light">
                    <tr>
                        <th scope="col"
                            class="border p-3 dark:border-neutral-600 border-gray-300 text-center font-semibold">
                            DAY
                        </th>
                        <th scope="col"
                            class="border  dark:border-neutral-600 border-gray-300 text-center font-semibold">
                            Shift
                        </th>
                        <th scope="col" class="border dark:border-neutral-600 border-gray-300 text-center font-semibold">
                            START TIME
                        </th>
                        <th scope="col" class="border dark:border-neutral-600 border-gray-300 text-center font-semibold">
                            END TIME
                        </th>
                        <th scope="col" class="border dark:border-neutral-600 border-gray-300 text-center font-semibold">
                            AVG TIME
                        </th>
                        <th scope="col" class="border dark:border-neutral-600 border-gray-300 text-center font-semibold">
                            ACTION
                        </th>

                    </tr>
                </thead>

                <tbody>
                    @forelse ($timings as $timing)
                        <tr class="border-b dark:border-neutral-600 hover:bg-neutral-100 dark:hover:bg-neutral-300">
                            <th scope="row"
                                class="px-6 py-4 border dark:border-neutral-600 border-gray-300 font-extralight text-center">
                                {{ $timing->day }}
                            </th>

                            <th scope="row"
                                class="px-6 py-4 border dark:border-neutral-600 border-gray-300 font-extralight text-center">
                                {{ $timing->shift }}
                            </th>
                            <th scope="row"
                                class="px-6 py-4 border dark:border-neutral-600 border-gray-300 font-extralight text-center">
                                {{ $timing->start_time }}
                            </th>
                            <th scope="row"
                                class="px-6 py-4 border dark:border-neutral-600 border-gray-300 font-extralight text-center">
                                {{ $timing->end_time }}
                            </th>
                            <th scope="row"
                                class="px-6 py-4 border dark:border-neutral-600 border-gray-300 font-extralight text-center">
                                {{ $timing->average_consultation_time }}
                            </th>


                            <th scope="row" class="px-6 py-4 border dark:border-neutral-600 border-gray-300 text-center">
                                <a href="/updatedoctor/{{ $timing->id }}" id="update-doctor">
                                    <button
                                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-2">Edit</button></a>
                                <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded mr-2"
                                    id="delete_doctor" value="{{ $timing->id }}">Delete</button>
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

    <script>
        $(document).ready(function() {

            $('#start_time').timepicker({
                'step': 30,
                'timeFormat': 'H:i'
            });

            $('#end_time').timepicker({
                'step': 30,
                'timeFormat': 'H:i'
            });

            // $('#generateButtons').click(function() {
            //     var startTime = $('#start_time').val();
            //     var endTime = $('#end_time').val();
            //     var consultationTime = parseInt($('#consultation_time').val());
            //     var buttonContainer = $('#buttonContainer');

            //     // Remove existing buttons
            //     buttonContainer.empty();

            //     var start = new Date('2024-01-01 ' + startTime);
            //     var end = new Date('2024-01-01 ' + endTime);
            //     var interval = consultationTime * 60000;

            //     var time = start.getTime();
            //     while (time <= end.getTime()) {
            //         var button = $('<button>').text(new Date(time).toLocaleTimeString([], {
            //             hour: '2-digit',
            //             minute: '2-digit'
            //         }));
            //         buttonContainer.append(button);
            //         time += interval;
            //     }
            // });

            // // Update buttons when consultation time changes
            // // $('#consultation_time').change(function() {
            // //     $('#generateButtons').trigger('click');
            // // });
        });
    </script>
@endsection
