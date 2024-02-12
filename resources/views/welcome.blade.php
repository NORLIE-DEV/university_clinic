@extends('layout.landingpage_layout')

@section('content')
    <section class="flex" style="height: 100vh; width:100%">
        <div class="w-1/2 p-3">
            <div class="m-4 p-3 flex">
                {{-- logo --}}
                <img src="{{ asset('asset/img/Seal_of_University_of_Nueva_Caceres.png') }}" class="w-10 h-10 m-2"
                    alt="logo-1">
                <img src="{{ asset('asset/img/79794414_111016303724059_5940762222245445632_n-800x800.png') }}"class="w-10 h-10 m-2"
                    alt="logo-2">
            </div>
            <div class="m-4 text-left p-2">
                <h2 class="text-3xl font-extrabold text-[#515151] m-3">UNIVERSITY OF NUEVA CACERES</h2>
                <h1 class="text-5xl font-extrabold text-[#E21C40] m-3">CLINIC MANAGEMENT SYSYEM</h1>
                <div class="m-4">
                    <p class="text-xl text-gray-700">"Better health care, happier lives"</p>
                </div>
            </div>
            <div class="ml-10">
                <a href="#">
                    <button class="p-2 bg-[#E21C40] rounded-md shadow-lg text-white hover:bg-red-700"><i class="fa-solid fa-hand-holding-heart text-white"></i><span class="ml-2"></span>View Services</button>
                </a>
                <a href="#">
                    <button class="p-2 bg-[#515151] text-white rounded-md hover:bg-gray-800"><i class="fa-solid fa-calendar-check text-white"></i><span class="ml-2"></span>Book Appointment Now!</button>
                </a>
            </div>
        </div>
        <div class="w-1/2">
            <img src="{{ asset('asset/img/3568984.jpg') }}" class="mt-4" alt="hero"
                style="width: 800px; height:530px;">
        </div>
    </section>
@endsection
