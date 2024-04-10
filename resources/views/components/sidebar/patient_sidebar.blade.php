<div class="flex mt-12">
    <div class="flex items-center" style="width: 500px; height:70vh;">
        <div class="border mx-10 bg-white shadow-xl rounded-lg" style="width: 250px; height:500px">
            <div class="p-4">
                <h1 class="font-semi-bold text-xl text-gray-500">Quick Links</h1>
            </div>
            <hr>
            <div>
                <ul>
                    <div class="mt-5">
                        <li><a href="#"><i class="fa-solid fa-calendar-check text-blue-950 text-md"></i><span
                                    class="font-semi-bold ml-5">My Apointments</span></a></li>
                    </div>
                    <div class="">
                        <li><a href="#"><i class="fa-solid fa-hand text-blue-950 text-md"></i><span
                                    class="font-semi-bold ml-5">My Request</span></a></li>
                    </div>
                    <div class="">
                        <li><a href="#"><i class="fa-solid fa-clock text-blue-950 text-md"></i><span
                                    class="font-semi-bold ml-5">History</span></a></li>
                    </div>
                    <div class="">
                        <li><a href="#"><i class="fa-solid fa-user text-blue-950 text-md"></i><span
                                    class="font-semi-bold ml-5">My Profile</span></a></li>
                    </div>
                    <div class="">
                        <li><a href="#"><i class="fa-solid fa-lock text-blue-950 text-md"></i><span
                                    class="font-semi-bold ml-5">Change Password</span></a></li>
                    </div>
                    <div class="">
                        <li>
                            <form action="/student_logout" method="POST">
                                @csrf
                                <button class="ml-5  hover:text-blue-500"><i
                                        class="fa-solid fa-right-from-bracket text-blue-950 text-md"></i><span
                                        class="ml-5">Logout</span></button>
                            </form>
                        </li>
                    </div>
                </ul>
            </div>
        </div>
    </div>
