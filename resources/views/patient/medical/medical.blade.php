@extends('layout.patient_layout')

@section('content')
    <div class="">
        <div class="w-full backgroundimg" style="height: 25vh;">
            <div class="overlay">
                <div class="flex items-center justify-between">
                    <div class="text-left text-white pt-6">
                        <div class="m-4 p-5">
                            <h1 class="text-3xl font-medium">Departments</h1>
                            <div class="mt-3 text-gray-200 ">
                                <a href="/patient_index">Home</a> <span class="text-gray-200">/ <a
                                        href="/patient/department">Department</a> / Medical</span>
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
        <div class="flex">
            <div class="" style="width: 70%;">
                <h1 class="text-xl text-blue-950 font-medium m-10">Medical</h1>
                <div class="m-10 text-sm text-gray-600">
                    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. A dicta atque autem nulla doloribus rerum,
                        recusandae consectetur veritatis ducimus dolorem amet consequuntur. Consequuntur ipsam ipsum
                        exercitationem modi deleniti, doloremque nemo placeat officia excepturi repudiandae esse debitis eum
                        sint, ratione id. Voluptas unde dignissimos doloremque cupiditate molestias consequatur explicabo
                        nihil dolores.</p>
                </div>
            </div>
            <div class="flex justify-center items-center" style="width: 30%;">
                <img src="{{ asset('asset/img/medical.png') }}" class="w-40 mt-5" alt="">
            </div>
        </div>

        <div class="ml-5 mt-10 pt-5">
            <div class="text-blue-950 text-xl font-medium">
                <h1 class="ml-5">Our Doctor's</h1>
                <hr class="w-10 mt-1 ml-5 bg-blue-950" style="padding: 1px;">
            </div>

            <div class="flex flex-wrap gap-4 justify-center pb-10">
                @foreach ($medicalDoctors as $doctor)
                    <div class="bg-white shadow-lg h-auto mt-10 flex gap-5 doctordiv" style="width: 48%;">
                        <div class="" style="width: 30%;">
                            @php
                                //    $default_profile = "https://api.dicebear.com/7.x/initials/".$student->first_name."-".$student->last_name.".svg";
                                // echo $default_profile,'<br>';
                                $default_profile = 'https://api.dicebear.com/7.x/adventurer-neutral/svg';
                            @endphp
                            <div class="mt-10 ml-5">
                                <img class="m-auto"id="image-preview"
                                    style="width:200px; height:180px;"src="{{ $doctor->image ? asset('storage/doctor/' . $doctor->image) : $default_profile }}">
                            </div>
                        </div>
                        <div style="width: 70%;">
                            <div class="mt-10 ml-5">
                                <h1 class="text-xl font-medium">{{ $doctor->name }}</h1>
                                <p class="text-gray-500 text-sm">{{ $doctor->designation }}</p>
                                <hr class="w-full mt-5">
                            </div>
                            <div class="mt-5 ml-5">
                                <h1 class="text-lg font-medium">Qualifications </h1>
                                <p class="text-gray-500 text-sm">{{ $doctor->designation }}</p>
                            </div>
                            <div class="mt-5 ml-5 mb-5">
                                <a href="#">
                                    <button class="p-3 text-xs bg-blue-950 text-white">Read More</button>
                                </a>
                                <a href="{{ route('patient.booked', ['id' => $doctor->id]) }}">
                                    <button class="text-xs p-3 border border-blue-950 text-blue-950">Book
                                        Appointment</button>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
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
    </style>
@endsection
