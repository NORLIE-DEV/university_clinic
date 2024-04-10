@include('partials.__header')
<div class="flex">
    <div class="bg-white shadow-xl h-screen" style="width: 20%;">
        <div class="flex justify-center mt-3">
            <img src="{{ asset('asset/img/logo/Untitled.jpg') }}" class="w-40" alt="">
        </div>
        <div class="p-5 mt-5">
            <div class="text-gray-500 font-normal text-sm mt-2">MANAGE</div>
            <ul class="py-5">
                <div class="mt-5 text-gray-500">
                    <li class="p-2"><a href=""> <span class="m-3"><i
                                    class="fa-solid fa-chart-simple"></i></span>Dashboard</a></li>
                </div>
                <div class="mt-5 text-gray-500">
                    <li class="p-2"><a href=""> <span class="m-3"><i
                                    class="fa-solid fa-file-medical"></i></span>Appointments</a></li>
                </div>
                <div class="mt-5 text-gray-500">
                    <li class="p-2"><a href=""> <span class="m-3"><i
                                    class="fa-solid fa-bed"></i></span>Patients</a></li>
                </div>
                <div class="mt-5 text-gray-500">
                    <li class="p-2"><a href="/doctor_timing"> <span class="m-3"><i
                                    class="fa-solid fa-calendar"></i></span>Timings</a></li>
                </div>
                <div class="mt-5 text-gray-500">
                    <li class="p-2"><a href=""> <span class="m-3"><i
                                    class="fa-solid fa-user"></i></span>Profile</a></li>
                </div>
                <div class="mt-5 text-gray-500">
                    <li class="p-2"><a href=""> <span class="m-3"><i
                                    class="fa-solid fa-lock"></i></span>Change Password</a></li>
                </div>
                <div class="mt-5 text-gray-500">
                    <li class="p-2">
                        <form action="/doctor_logout" method="POST">
                            @csrf
                            <button class="ml-3  hover:text-blue-500"><i
                                    class="fa-solid fa-right-from-bracket text-gray-500 text-md"></i><span
                                    class="ml-2.5">Logout</span></button>
                        </form>
                    </li>
                </div>
            </ul>
        </div>
    </div>
    <div class="content" style="width: 80%;">
        <nav class="bg-white flex justify-between items-center shadow-xl p-5 sticky top-0 z-10">
            <div class="">
                <h1 class="text-blue-900 font-bold">UNIVERSITY CLINIC MANAGEMENT SYSTEM</h1>
            </div>
            <div class="w-1/2 flex justify-end pr-4 items-center">
                {{-- profile --}}
                {{-- <div>Name</div> --}}
            </div>
        </nav>

        @yield('content')
    </div>
</div>
@include('partials.__footer')
