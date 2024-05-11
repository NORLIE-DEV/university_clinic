@extends('layout.doctor_layout')

@section('content')
    <div class="mx-auto bg-[#fff] border mt-5 shadow rounded-md" style="width: 95%; height:auto;">
        <div class="flex justify-between p-3 items-center">
            <div class="font-medium text-gray-500">View Appointment</div>
            <div>
                <a href="/doctor_index/allappointments">
                    <button class="text-xs p-3 w-20 bg-blue-950 rounded-md text-white">Back</button>
                </a>
            </div>
        </div>
    </div>
    <div class="mx-auto bg-[#fff] border mt-5 shadow rounded-md" style="width: 95%; height:auto;">
        <div>
            <div class="p-3 m-4 font-medium text-gray-500">Appointment Details</div>
            <div class="flex justify-between">
                <div class="m-4 p-3">
                    <label for="#" class="text-sm text-gray-400">Appointment Number</label><br>
                    <input type="text"
                        class="outline-none border w-64 mt-2 text-xs p-2 rounded-md text-gray-500 font-medium"
                        value="{{ $appointments->id }}" disabled>
                </div>
                <div class="m-4 p-3">
                    <label for="#" class="text-sm text-gray-400">Appointment Date</label><br>
                    <input type="text"
                        class="outline-none border w-64 mt-2 text-xs p-2 rounded-md text-gray-500 font-medium"
                        value="{{ $appointments->date }}" disabled>
                </div>
                <div class="m-4 p-3">
                    <label for="#" class="text-sm text-gray-400">Appointment Time</label><br>
                    <input type="text"
                        class="outline-none border w-64 mt-2 text-xs p-2 rounded-md text-gray-500 font-medium"
                        value="{{ $appointments->start_time }}" disabled>
                </div>
            </div>
        </div>

    </div>
    <div class="mx-auto pb-5 bg-[#fff] border shadow rounded-md mt-5" style="width: 95%; height:auto;">
        <div>
          <div class="flex justify-between items-center">
            <div class="p-3 m-4 font-medium text-gray-500">Patient Detail</div>
            <div class="m-3">
                <a href="/doctor_index/testPatient/{{$appointments->id}}">
                    <button class="text-xs bg-blue-950 text-white p-3 rounded-md">Examine Patient</button>
                </a>
            </div>
          </div>
            <div class="flex justify-between">
                <div class="mx-4 p-3">
                    <label for="#" class="text-sm text-gray-400">Full Name</label><br>
                    <input type="text"
                        class="outline-none border w-64 mt-2 text-xs p-2 rounded-md text-gray-500 font-medium"
                        value="{{ $appointments->patient->employee->first_name ?? ($appointments->patient->student->first_name ?? 'Unknown') }}"
                        disabled>
                </div>
                <div class="mx-4 p-3">
                    <label for="#" class="text-sm text-gray-400">Email Address</label><br>
                    <input type="text"
                        class="outline-none border w-64 mt-2 text-xs p-2 rounded-md text-gray-500 font-medium"
                        value="{{ $appointments->patient->employee->email ?? ($appointments->patient->student->email ?? 'Unknown') }}"
                        disabled>
                </div>
                <div class="mx-4 p-3">
                    <label for="#" class="text-sm text-gray-400">Contact Number</label><br>
                    <input type="text"
                        class="outline-none border w-64 mt-2 text-xs p-2 rounded-md text-gray-500 font-medium"
                        value="{{ $appointments->patient->employee->contact_number ?? ($appointments->patient->student->contact_number ?? 'Unknown') }}"
                        disabled>
                </div>
            </div>
        </div>
        <div>
            <div class="flex justify-between">
                <div class="mx-4 px-3">
                    <label for="#" class="text-sm text-gray-400">Alternate Phone Number</label><br>
                    <input type="text"
                        class="outline-none border w-64 mt-2 text-xs p-2 rounded-md text-gray-500 font-medium"
                        value="{{ $appointments->phone_number }}" disabled>
                </div>
                <div class="mx-4 px-3">
                    @php
                        $birthdate =
                            $appointments->patient->student->date_of_birth ??
                            $appointments->patient->employee > $date_of_birth;
                        $currentDate = date('Y-m-d');
                        $diff = date_diff(date_create($birthdate), date_create($currentDate));
                        $age = $diff->y;
                    @endphp
                    <label for="#" class="text-sm text-gray-400">Age</label><br>
                    <input type="text"
                        class="outline-none border w-64 mt-2 text-xs p-2 rounded-md text-gray-500 font-medium"
                        value="{{ $age }}" disabled>
                </div>
                <div class="mx-4 px-3">
                    <label for="#" class="text-sm text-gray-400">Gender</label><br>
                    <input type="text"
                        class="outline-none border w-64 mt-2 text-xs p-2 rounded-md text-gray-500 font-medium"
                        value="{{ $appointments->patient->employee->gender ?? ($appointments->patient->student->gender ?? 'Unknown') }}"
                        disabled>
                </div>
            </div>
        </div>

        <div class="flex justify-start mt-4 gap-5">
            <div class="ml-4 pl-3">
                <label for="#" class="text-sm text-gray-400">Birth Date</label><br>
                <input type="text" class="outline-none border w-64 mt-2 text-xs p-2 rounded-md text-gray-500 font-medium"
                    value="{{ $birthdate }}" disabled>
            </div>
            <div class="ml-10 pl-3">
                <label for="#" class="text-sm text-gray-400">Patient Comment</label><br>
                <textarea class="w-96 border outline-none text-xs text-gray-500 p-3 mt-2" disabled>{{ $appointments->notes }}</textarea>
            </div>
        </div>
    </div>

    <div class="mx-auto bg-[#fff] border mt-5 shadow rounded-md mb-10" style="width: 95%; height:auto;">
         <form action="/update_appointment_status/{{$appointments->id}}" method="post" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div>
                <div class="p-3 m-4 font-medium text-gray-500">Appointment Status Update</div>
                <div class="mx-4 px-3">
                    <label for="#" class="text-sm text-gray-400">Appointment Status</label><br>
                    <select name="appointment_status" id="appointment_status"
                        class="text-xs w-full border p-3 rounded-md mt-2 text-gray-500 outline-none">
                        <option value="booked"{{ $appointments->appointment_status == 'booked' ? 'selected' : '' }}>Booked</option>
                        <option value="completed"{{ $appointments->appointment_status == 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="cancelled"{{ $appointments->appointment_status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        <option value="patient not available"{{ $appointments->appointment_status == 'patient not available' ? 'selected' : '' }}>Patient Not Available</option>
                    </select>
                </div>
                <div class="mx-4 mt-3 px-3">
                    <label for="notes" class="text-sm text-gray-400">Doctor Comment</label><br>
                    <textarea name="notes" id="notes" class="outline-none w-full border text-xs p-3 text-gray-500">{{$appointments->notes}}</textarea>
                </div>
            </div>
            <div class="flex justify-end m-5">
                <button type="submit" class="text-xs p-3 bg-blue-950 text-white rounded-md shadow-md w-20">Update</button>
            </div>
        </form>

    </div>
@endsection
