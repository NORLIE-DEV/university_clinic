@extends('layout.superadmin_layout')

@section('content')
    <div class="ml-5 mt-10 bg-blue-950 w-28 rounded-md text-center p-2">
        <h1 class="text-white font-semibold text-xl" style="letter-spacing: 2px;">PATIENT</h1>
    </div>
    <hr class="mt-5 m-4 h-2">

    <div class="m-5 flex gap-10">
        <a href="/superadmin/patient/student">
            <div class="w-60 h-40 bg-white rounded-lg shadow-2xl" style="border-bottom: 4px solid rgb(2, 2, 66)">
                <h1 class="absolute p-2 font-medium text-blue-950">STUDENT</h1>
                <img src="{{ asset('asset/img/image_2024-02-17_112305240-removebg-preview.png') }}" alt="">
            </div>

        </a>
        <a href="/superadmin/patient/employee">
            <div class="w-60 h-40 bg-white rounded-lg shadow-2xl" style="border-bottom: 4px solid rgb(2, 2, 66)">
                <h1 class="absolute p-2 font-medium text-blue-950">EMPLOYEE</h1>
                <img src="{{ asset('asset/img/image_2024-02-17_112305240-removebg-preview.png') }}" alt="">
            </div>

        </a>
        <form action="/superadmin/patient_import_data" method="post">
            @csrf
            <button type="submit">
                <div class="w-60 h-40 bg-white rounded-lg shadow-2xl" style="border-bottom: 4px solid rgb(2, 2, 66)">
                    <h1 class="absolute p-2 font-medium text-blue-950">SYNC</h1>
                    <div class="flex justify-center">
                        <img src="{{ asset('asset/img/sc.png') }}" class="w-44" alt="sync">
                    </div>
                </div>
            </button>
        </form>
        </a>
    </div>
@endsection
