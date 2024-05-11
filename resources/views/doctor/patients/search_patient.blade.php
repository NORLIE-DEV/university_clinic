@extends('layout.doctor_layout')

@section('content')
    <div class="bg-white flex justify-center items-center" style="width:100%; height:90vh;">
        <div>
            <form action="/doctor_index/search_student_patient" method="POST">
                @csrf
                <div class="">
                    <div>
                        <img src="" alt="">
                    </div>
                    <h1 class="text-center text-2xl font-medium text-gray-600">PLEASE INPUT STUDENT/EMPLOYEE NO. TO CONTINUE...</h1>
                    <div class="flex justify-center border mx-auto items-center mt-5 rounded-md" style="width:80%;">
                        <input type="text" name="patient_key" id="patient_key"
                            class="outline-none p-5 font-medium text-center text-gray-500" style="width: 90%;" placeholder="19XXXXXX"
                            required>
                        <div class="float-end">
                            <div><span><i class="fa-solid fa-magnifying-glass text-gray-500"></i></span></div>
                        </div>
                    </div>
                </div>
                <p class="text-center text-sm text-gray-400 my-5">Dont use special character <span>(Ex: 19*****)</span></p>
                @if (isset($errorMessage))
                    <p class="text-center text-red-600 mb-5">{{ $errorMessage }}</p>
                @endif
                <div class="flex justify-center">
                    <button type="submit" class="bg-green-500 text-xs p-3 w-40 text-white rounded-sm shadow-md"><span><i
                                class="fa-solid fa-magnifying-glass"></i></span> Search</button>
                </div>
            </form>
        </div>
    </div>
@endsection
