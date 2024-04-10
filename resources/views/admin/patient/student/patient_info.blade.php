@extends('layout.admin_layout')

@section('content')
    <div class="ml-5 mt-5 text-2xl font-semibold text-blue-950">
        Patient Information
    </div>
    <div class="ml-5 text-gray-500">
        <a href="/admin/patient/student">Index</a><span> / </span><a href="#">Patients</a>
    </div>
    <div class="bg-white shadow rounded flex items-center" style="width: 98%; height:auto; margin:10px auto; padding:2rem;">
        <div class="" style="width:35%;">
            <div class=" text-3xl font-bold uppercase text-blue-950">
                {{ $patientsInfo->student->first_name }} {{ $patientsInfo->student->middle_name }}
                {{ $patientsInfo->student->last_name }}
            </div>
            <div class=" text-gray-600 font-light">
                <span>Student ID : {{ $patientsInfo->student->id }}</span>
            </div>
            <div class=" text-gray-600 font-light">
                <span>{{ $patientsInfo->student->student_department }}/{{ $patientsInfo->student->course }}
                    {{ $patientsInfo->student->student_level }}</span>
            </div>
        </div>

        <div class="" style="width: 60%;">
            {{-- tool --}}
            <div class="bg-blue-950 text-white shadow text-xs flex justify-between" style="width: 100%;">
                <ul class="p-2">
                    <li class="p-2"><a href="#">Patient Details</a></li>
                </ul>
                <ul class="p-2">
                    <li class="p-2"><a href="/admin_patient_medicalInformation/{{ $patientsInfo->id }}">Medical
                            Information</a></li>
                </ul>
                <ul class="p-2">
                    <li class="p-2"><a href="#">Consultation History</a></li>
                </ul>
                <ul class="p-2">
                    <li class="p-2"><a href="#">Others</a></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="flex m-3 gap-5">
        <div class="bg-white shadow-lg rounded-md" style="width:25%;height:420px;">
            <div class="font-light text-gray-100 text-center text-lg rounded-t-md py-3 bg-blue-900 w-full">
                Tools <i class="fa-solid fa-screwdriver-wrench"></i>
            </div>
            <ul>
                <li>
                    <div class="mt-5 ml-5 text-sm text-gray-500">Consultation <span class="ml-1"><i class="fa-solid fa-clipboard-question"></i></span> </div>
                    <a href="/admin_medical_consultation/{{$patientsInfo->id}}" class="ml-10 text-xs text-gray-400">Medical Consultaion</a>
                </li>
                <li>

                    <a href="#" class="ml-10 text-xs text-gray-400">Dental Consultaion</a>
                </li>
            </ul>
        </div>
        <div class="bg-white shadow-lg rounded-md" style="width:75%;height:120px;"></div>
    </div>
@endsection
