@extends('layout.admin_layout')

@section('content')
    <div class="bg-white shadow p-10" style="width:98%; height:auto; margin:10px auto;">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-xl font-medium text-blue-950"> <span class="ml-1"><i class="fa-solid fa-clipboard-question"></i></span>MEDICAL CONSULTATION
                </h1>
            </div>
            <div class="gap-5 flex">
                <div>
                    <a href="/admin_patient_info/{{ $patientsInfo->id }}"><button><i
                                class="fa-solid fa-arrow-left"></i></button></a>
                </div>

            </div>
        </div>
    </div>
@endsection
