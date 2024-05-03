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
    <div class="bg-white shadow-lg border border-black rounded-lg" style="width: 90%; height:auto; margin: 1rem auto;">
        <div class="flex justify-between items-center m-3">
            <div class="p-5 font-medium">Appointment</div>
            <div>
                <a href="/patient/myappointment">
                    <button class="bg-blue-950 text-xs p-2 text-white rounded-sm w-20">Back</button>
                </a>
            </div>
        </div>
        <hr style="border:1px solid gray;">
        <div class="flex items-center">
            <div style="width: 70%; height:auto;">
                <div class="m-8">
                    <div class="mt-2">
                        <div>Appointment No. : <span>{{ $viewappointment->id }}</span></div>
                    </div>
                    <div class="mt-2">
                        <div>Appointment Date. : <span>{{ $viewappointment->date }}</span></div>
                    </div>
                    <div class="mt-2">
                        <div>Appointment Time : <span><?php echo date('h:i A', strtotime($viewappointment->start_time)); ?></span></div>
                    </div>
                </div>
                <hr style="border:1px solid gray;">
                <div class="m-8">
                    <div class="mt-2">
                        <div>Doctor Name: <span>{{ $viewappointment->doctor->name }}</span></div>
                    </div>
                    <div class="mt-2">
                        <div>Doctor Designation: <span>{{ $viewappointment->doctor->designation }}</span></div>
                    </div>
                </div>
                <hr style="border:1px solid gray;">
                <div class="m-8">
                    <div class="mt-2">
                        <div>Status :<span class="text-xs p-3 bg-blue-600 ml-2 rounded-md text-white shadow-lg">{{ $viewappointment->appointment_status}}</span></div>
                    </div>
                </div>
            </div>
            <div style="width: 30%; height:auto;">
                <img src="https://img.freepik.com/free-vector/man-booking-appointment-smartphone_23-2148562877.jpg?t=st=1712935003~exp=1712938603~hmac=89a44db3a8442afa7f71e40063476124a80ff871be770655475c38d61499ca3d&w=996" alt="">
            </div>
        </div>
    </div>
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
