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
                                <a href="/patient_index">Home</a> <span class="text-gray-200">/ Department</span>
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
        <div class="mt-20 ml-2 p-5 flex justify-center items-center gap-10">
            <div class="w-24 h-0.5 bg-blue-950"></div>
            <div class="flex items-center gap-3 ">
                <h4 class="text-xl text-blue-950 font-medium">Select Department</h4>
            </div>
        </div>
        <div class="text-center">
            <h1 class="text-5xl text-blue-950 font-bold">Our Departments</h1>
        </div>
        <div class="flex gap-13 mt-10 pt-5 w-full">
            <div style="width: 60%; height:auto;">
                <h1 class="p-5 text-3xl font-medium text-blue-950"><span><i class="fa-solid fa-tooth"></i></span> Dental
                </h1>
                <div class="m-5 text-start">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sapiente reprehenderit, assumenda nulla,
                        eligendi voluptate commodi beatae quas debitis quo deserunt eveniet harum sequi eum excepturi,
                        quisquam doloribus delectus ipsa consequatur dolore. Pariatur quae nulla, accusamus cumque earum
                        modi, eius voluptatibus, at fugit fugiat reiciendis aliquam impedit minus nostrum optio dolor rerum
                        sit animi magnam deserunt perspiciatis. Inventore, obcaecati voluptatum possimus veniam molestias
                        error animi aut deleniti sequi ab velit, ratione dignissimos ducimus, natus laboriosam aperiam culpa
                        ad. Asperiores voluptate quaerat nesciunt, quisquam sunt quos ab earum sint veniam laboriosam illo
                        voluptatibus deleniti recusandae eum dolor! Maxime, similique. Molestias, aliquam ducimus?</p>
                </div>
                <div class="m-5">
                    <a href="/patient/department/dental">
                        <button
                            class="text-sm bg-blue-950 text-white rounded-sm p-3 shadow-lg hover:bg-blue-800 duration-700">Booked
                            an Appointment</button>
                    </a>
                </div>
            </div>
            <div style="width: 40%; height:auto;">
                <img src="{{ asset('asset/img/tooth.png') }}" alt="">
            </div>
        </div>
        <div class="flex gap-13 mt-10 pt-5 w-full">
            <div style="width: 60%; height:auto;">
                <h1 class="p-5 text-3xl font-medium text-blue-950"><span><i class="fa-solid fa-briefcase-medical"></i></span> Medical
                </h1>
                <div class="m-5 text-start">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sapiente reprehenderit, assumenda nulla,
                        eligendi voluptate commodi beatae quas debitis quo deserunt eveniet harum sequi eum excepturi,
                        quisquam doloribus delectus ipsa consequatur dolore. Pariatur quae nulla, accusamus cumque earum
                        modi, eius voluptatibus, at fugit fugiat reiciendis aliquam impedit minus nostrum optio dolor rerum
                        sit animi magnam deserunt perspiciatis. Inventore, obcaecati voluptatum possimus veniam molestias
                        error animi aut deleniti sequi ab velit, ratione dignissimos ducimus, natus laboriosam aperiam culpa
                        ad. Asperiores voluptate quaerat nesciunt, quisquam sunt quos ab earum sint veniam laboriosam illo
                        voluptatibus deleniti recusandae eum dolor! Maxime, similique. Molestias, aliquam ducimus?</p>
                </div>
                <div class="m-5">
                    <a href="/patient/department/medical">
                        <button
                            class="text-sm bg-blue-950 text-white rounded-sm p-3 shadow-lg hover:bg-blue-800 duration-700">Booked
                            an Appointment</button>
                    </a>
                </div>
            </div>
            <div style="width: 40%; height:auto;">
                <img src="{{ asset('asset/img/medical.png') }}" alt="">
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
    </style>
@endsection
