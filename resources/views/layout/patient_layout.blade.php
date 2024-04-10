@include('partials.__header')


@include('components.navbar.patient_navbar')

@if (Request::is('patient_index'))
    <div class="">
        <div class="w-full backgroundimg" style="height: 25vh;">
            <div class="overlay">
                <div class="flex items-center justify-between">
                    <div class="text-left text-white pt-6">
                        <div class="m-4 p-5">
                            <h1 class="text-3xl font-medium">Home</h1>
                            <div class="mt-3 text-gray-200 ">
                                <a href="/patient_index">Home</a> <span class="text-gray-200">/</span>
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

    <div class="mt-5">
        @include('components.sidebar.patient_sidebar')
        <div class="content" style="width: 100%; height:100%;">
            @yield('content')
        </div>
    </div>

    <style>
        .backgroundimg {
            z-index: 1;
            position: relative;
            background: url('https://moderngps.edu.om/wp-content/uploads/2023/02/IMG_003.jpeg') no-repeat center center/cover;
        }

        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.6);
        }
    </style>
@elseif (Request::is('patient/finddoctor'))
    <div class="flex">
        <div class="content" style="width: 100%; height:100%;">
            @yield('content')
        </div>
    </div>
@elseif (Request::is('patient/department'))
    <div class="flex">
        <div class="content" style="width: 100%; height:100%;">
            @yield('content')
        </div>
    </div>
@elseif (Request::is('patient/department/dental'))
    <div class="flex">
        <div class="content" style="width: 100%; height:100%;">
            @yield('content')
        </div>
    </div>
@elseif (Request::is('patient/department/medical'))
    <div class="flex">
        <div class="content" style="width: 100%; height:100%;">
            @yield('content')
        </div>
    </div>
@elseif (Request::is('patient/booked/*'))
    <div class="flex">
        <div class="content" style="width: 100%; height:100%;">
            @yield('content')
        </div>
    </div>
@endif

</style>
@include('components.footer.patientFooter')
@include('partials.__footer')
