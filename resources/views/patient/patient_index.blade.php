@extends('layout.patient_layout')

@section('content')
    <div class="">
        <div class="bg-[#EB1D25] rounded-xl shadow-2xl flex" style="width:95%; height:230px;">
            <div class="w-1/2 p-5">
                <h1 class="p-3 ml-2 text-white font-semibold">Hi, Patient</h1>
                <p class="m-5 text-xs text-white">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ipsa ut doloribus
                    amet porro animi! Sit est ducimus expedita minus aperiam!</p>
                <a href="#" class="ml-5">
                    <button class="bg-white p-2 text-xs shadow-xl rounded-md font-semibold text-[#EB1D25]"><i
                            class="fa-solid fa-calendar-check text-red-500 text-xs"></i> <span class="ml-2"></span>Book Appointment</button>
                </a>
            </div>

            <div class="w-1/2 justify-center flex">
                <img src="{{ asset('asset/img/image_2024-02-10_195706857-removebg-preview.png') }}" class="w-60 h-60"
                    alt="patient">
            </div>
        </div>

    </div>
@endsection
