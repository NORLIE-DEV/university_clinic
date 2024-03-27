@extends('layout.admin_layout')

@section('content')
    <div class="ml-5 mt-5 text-2xl font-semibold text-blue-950">
        Patients
    </div>
    <div class="ml-5 text-gray-500">
        <a href="#">Index</a><span> / </span><a href="#">Patients</a>
    </div>

    <div class="flex justify-start gap-9 ml-5 mt-10">
        <div class="bg-white shadow rounded-lg" style="width: 30%; height:200px;">
            <a href="/admin/patient/student">
                <div class="flex">
                    <div class="">
                        <h1 class="m-5 text-2xl text-blue-900 font-semibold">Student</h1>
                        <div class="w-20 h-20 bg-blue-200 m-5 rounded-full flex justify-center items-center">
                            <i class="fa-solid fa-graduation-cap text-blue-950 text-2xl"></i>
                        </div>
                    </div>
                    <div class="flex justify-center items-center">
                        <h1 class="mt-10 text-5xl font-bold text-blue-950"></h1>
                    </div>
                </div>
            </a>
        </div>
        <div class="bg-white shadow rounded-lg" style="width: 30%; height:200px;">
            <a href="">
                <div class="flex">
                    <div class="">
                        <h1 class="m-5 text-2xl text-blue-900 font-semibold">Employee</h1>
                        <div class="w-20 h-20 bg-blue-200 m-5 rounded-full flex justify-center items-center">
                            <i class="fa-solid fa-address-card text-blue-950 text-2xl"></i>
                        </div>
                    </div>
                    <div class="flex justify-center items-center ">
                        <h1 class="mt-10 text-5xl font-bold text-blue-950">1</h1>
                    </div>
                </div>
            </a>
        </div>
    </div>
@endsection
