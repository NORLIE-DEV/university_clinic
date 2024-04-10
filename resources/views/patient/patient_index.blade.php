@extends('layout.patient_layout')

@section('content')
    <div class="m-3 bg-gradient-to-r from-violet-600 to-blue-900 shadow-lg rounded-xl flex"
        style="width: 90%; height:200px; margin:auto 0;">
        {{-- date --}}
        <div style="width: 70%;">
            <div class="text-gray-300 p-8 ml-4">
                @php
                    use Carbon\Carbon;
                @endphp
                {{ now()->format(' F j, Y') }}
            </div>
            @if (Auth::guard('patient')->check())
                @php
                    $patient = Auth::guard('patient')->user();
                    $user = $patient->student ?: $patient->employee;
                @endphp
                @if ($user)
                    <div class="text-white ml-12 mt-5">
                        <h1 class="text-2xl font-semibold tracking-wide">Welcome back,
                            <span>{{ $user->first_name }}</span>
                        </h1>
                        <p class="text-xs w-68 mt-3 text-gray-300">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                            Dicta, laudantium?.</p>
                    </div>
                @endif
            @endif
        </div>
        <div style="width:30%;">
            <img src="{{ asset('asset/img/logo/image_2024-04-03_222020798-removebg-preview.png') }}" style="width: 80%;"
                alt="">
        </div>
    </div>
@endsection
