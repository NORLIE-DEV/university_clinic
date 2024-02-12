@include('partials.__header')

<nav class="bg-white shadow mb-6 p-2 sticky top-0 flex justify-between items-center" style="border-bottom: 2px solid #EB1D25;">
    <div class="text-[#EB1D25] font-bold ml-14">
        <i class="fa-solid fa-notes-medical text-xl"></i>
        UNIVERSITY CLINIC MANAGEMENT SYSTEM
    </div>
    <div class="">
        <ul class="flex items-center gap-3 text-xs font-semibold text-[#EB1D25]">
            <li class="p-2 m-2"><a href="#">Home</a></li>
            <li class="p-2 m-2"><a href="#">Services</a></li>
            <li class="p-2 m-2"><a href="#">View Doctors</a></li>
            <li class="p-2 m-2"><a href="#">Book Appointment</a></li>
            <li class="p-2 m-2"><a href="#">Request Medicine</a></li>
        </ul>
    </div>
</nav>
<div class="flex mt-3">
    <div class="" style="width: 500px; height:100vh;">

        <div class="border mx-16 mt-5 bg-white shadow-xl rounded-lg fixed" style="width: 250px; height:450px">
            <div class="p-3">
                <h1 class="font-bold text-md text-gray-500">Quick Links</h1>
            </div>
            <hr>
            <div class="p-1">
                <ul class="p-1">
                    <div class="m-5">
                        <li><a href="/myappointments" class="text-xs font-medium"><i
                                    class="fa-solid fa-calendar-check text-red-500 text-xs"></i><span
                                    class="ml-3"></span>My
                                Appointments</a></li>
                    </div>
                    <div class="m-5">
                        <li><a href="#" class="text-xs font-medium"><i
                                    class="fa-solid fa-hand text-red-500 text-xs"></i><span class="ml-3"></span>My
                                Request</a></li>
                    </div>
                    <hr>
                    <div class="m-5">
                        <li><a href="/medical_history" class="text-xs font-medium"><i
                                    class="fa-solid fa-book-medical  text-red-500 text-xs"></i><span
                                    class="ml-3"></span>Medical History</a>
                        </li>
                    </div>
                    <div class="m-5">
                        <li><a href="#" class="text-xs font-medium"><i
                                    class="fa-solid fa-address-card text-red-500 text-xs"></i><span
                                    class="ml-3"></span>My Profile</a>
                        </li>
                    </div>

                    <div class="m-5">
                        <li><a href="#" class="text-xs font-medium"><i
                                    class="fa-solid fa-lock text-red-500 text-xs"></i><span class="ml-3"></span>Change
                                Password</a></li>
                    </div>

                    <hr>
                    <div class="m-5">
                        <li><a href="#" class="text-xs font-medium"><i
                                    class="fa-solid fa-phone text-red-500 text-xs"></i><span
                                    class="ml-3"></span>Support</a></li>
                    </div>
                    <div class="m-5">
                        <li>
                            <form action="/patient-logout" method="POST">
                                @csrf
                                <button type="submit" class="text-xs font-medium"><i
                                        class="fa-solid fa-right-from-bracket text-red-500 text-xs"></i><span
                                        class="ml-3"></span>Log
                                    Out</button>
                            </form>
                        </li>
                    </div>
                </ul>
            </div>
        </div>
    </div>
    <div class="content" style="width: 100%; height:100%;">
        @yield('content')
    </div>
</div>

@include('partials.__footer')
