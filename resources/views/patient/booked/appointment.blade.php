@extends('layout.patient_layout')

@section('content')
    <div class="">
        <div class="w-full backgroundimg" style="height: 25vh;">
            <div class="overlay">
                <div class="flex items-center justify-between">
                    <div class="text-left text-white pt-6">
                        <div class="m-4 p-5">
                            <h1 class="text-3xl font-medium">My Appointments</h1>
                            <div class="mt-3 text-gray-200 ">
                                <a href="/patient_index">Home</a> <span class="text-gray-200">/ My Appointments</a>
                            </div>
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
    <div class="bg-white shadow-xl p-3" style="width: 95%; height:auto; margin:1rem auto;">
        <div class="flex items-center justify-between">
            <div class="p-3 my-10 font-medium">My Appointments</div>
            <div>
                <label for="#">Doctor Appointment</label>
                <select id="doctor-appointment-select" class="outline-none border text-xs p-3 w-60">
                    <option value="">Select Doctor</option>
                </select>
            </div>
        </div>
        <!-- Table responsive wrapper -->
        <div class="overflow-x-auto bg-white dark:bg-neutral-700">

            <!-- Table -->
            <table id="appointments-table" class="min-w-full text-left text-xs whitespace-nowrap">

                <!-- Table head -->
                <thead class="uppercase tracking-wider border-b-2 dark:border-neutral-600 border-t">
                    <tr>
                        <th scope="col" class="px-6 py-4 border-x dark:border-neutral-600">
                            Appointment Id
                        </th>
                        <th scope="col" class="px-6 py-4 border-x dark:border-neutral-600">
                            Appointment Date
                        </th>
                        <th scope="col" class="px-6 py-4 border-x dark:border-neutral-600">
                            Appointment Time
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
                    <!-- Appointments will be populated dynamically -->
                </tbody>

            </table>

        </div>
    </div>

    <script>
        $(document).ready(function() {
            console.log("Document ready");
            $.ajax({
                url: '/patient/getDoctors',
                type: 'GET',
                success: function(response) {
                    var doctors = response.doctors;
                    var select = $('#doctor-appointment-select');
                    $.each(doctors, function(index, doctor) {
                        select.append($('<option>', {
                            value: doctor.id,
                            text: doctor.name
                        }));
                    });
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });

            fetchAppointments();

            $('#doctor-appointment-select').change(function() {
                var doctorId = $(this).val();
                if (doctorId) {
                    fetchAppointments(doctorId);
                } else {
                    fetchAppointments();
                }
            });

            function fetchAppointments(doctorId) {
                var url = doctorId ? '/get-appointments/' + doctorId : '/get-all-appointments';
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function(response) {
                        populateAppointmentsTable(response.appointments);
                    },
                    error: function(xhr, status, error) {
                        console.error("Error fetching appointments:", error);
                    }
                });
            }


            function populateAppointmentsTable(appointments) {
                var tableBody = $('#appointments-table tbody');
                tableBody.empty();

                if (appointments.length === 0) {
                    var noAppointmentsRow =
                        '<tr><td colspan="4" class=" py-4 text-center text-gray-500 ">No appointments available</td></tr>';
                    tableBody.append(noAppointmentsRow);
                } else {
                    appointments.forEach(function(appointment) {
                        var row =
                            '<tr class="border-b dark:border-neutral-600 hover:bg-neutral-100 dark:hover:bg-neutral-600">';
                        row += '<td class="px-6 py-4 border-x dark:border-neutral-600">' + appointment.id +
                            '</td>';
                        row += '<td class="px-6 py-4 border-x dark:border-neutral-600">' + appointment
                            .date + '</td>';
                        row += '<td class="px-6 py-4 border-x dark:border-neutral-600">' + formatTime(
                            appointment.start_time) + '</td>';
                        row += '<td class="px-6 py-4 border-x dark:border-neutral-600">';
                        switch (appointment.appointment_status) {
                            case 'booked':
                                row +=
                                    '<div class="text-xs p-2 bg-blue-700 rounded-sm text-white text-center">';
                                break;
                            case 'Confirmed':
                                row +=
                                    '<div class="text-xs p-2 bg-green-500 rounded-sm text-white text-center">';
                                break;
                            case 'Cancelled':
                                row +=
                                    '<div class="text-xs p-2 bg-red-500 rounded-sm text-white text-center">';
                                break;
                            default:
                                row +=
                                    '<div class="text-xs p-2 bg-gray-400 rounded-sm text-white text-center">';
                                break;
                        }
                        row += appointment.appointment_status + '</div></td>';

                        row +=
                            '<td class="px-6 py-4 border-x dark:border-neutral-600 flex justify-center"><a href="/patient/viewmyappointment/' +
                            appointment.id +
                            '"><button class="text-xs p-2 bg-blue-950 rounded-md shadow-lg text-white"><i class="fa-solid fa-users-viewfinder"></i><span> View</span></button></a></td>';
                        row += '</tr>';
                        tableBody.append(row);
                    });
                }
            }

            function formatTime(timeString) {
                var time = new Date('2000-01-01T' +
                timeString);
                return time.toLocaleTimeString([], {
                    hour: 'numeric',
                    minute: '2-digit',
                    hour12: true
                });
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

        .doctordiv {
            border-top: 5px solid rgb(9, 9, 88);
            border-radius: 15px;

        }

    @endsection
