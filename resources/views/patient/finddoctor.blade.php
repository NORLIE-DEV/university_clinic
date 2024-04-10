@extends('layout.patient_layout')

@section('content')
    <div class="">
        <div class="w-full backgroundimg" style="height: 25vh;">
            <div class="overlay">
                <div class="flex items-center justify-between">
                    <div class="text-left text-white pt-6">
                        <div class="m-4 p-5">
                            <h1 class="text-3xl font-medium">Find Doctor</h1>
                            <div class="mt-3 text-gray-200 ">
                                <a href="/patient_index">Home</a> <span class="text-gray-200">/ Find Doctor</span>
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
    <div class="bg-white mx-auto shadow-xl mt-10" style="width: 90%; height:50%;">
        <div>
            Booked Now!
        </div>
    </div>

    <style>
        .backgroundimg {
            z-index: 1;
            position: relative;
            background: url('https://img.freepik.com/free-photo/medium-shot-therapist-measuring-blood-ressure-patient-consultation_1098-19338.jpg?w=996&t=st=1712558100~exp=1712558700~hmac=1416204abbc812064edccef77feb74c00fd165be0398a46edc75057e62d375e0') no-repeat center center/cover;
        }

        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.6);
        }
    </style>
@endsection
