 @extends('layout.superadmin_layout')

 @section('content')
     <div class="bg-white shadow-lg m-5 flex" style="width:96%; height:40%;">
         <div class="p-10 w-1/2">
             <h1 class="text-xl">Hi, <span class="text-2xl font-bold text-blue-900">NORLIE ESTRADA</span></h1>
             <p class="text-sm mt-3 text-gray-700">Lorem ipsum dolor sit amet consectetur adipisicing elit. Deleniti quia
                 distinctio!</p>
             <div class="mt-10">
                 <a href="#">
                     <button class="p-2 bg-blue-950 text-white rounded-lg shadow-xl text-sm"><i class="fa-solid fa-bed-pulse"></i>View Patients</button>
                 </a>
             </div>
         </div>
         <div class="w-1/2">
             <img src="{{ asset('asset/img/image_2024-02-04_134747610-removebg-preview.png') }}" alt="hero"
                 class="w-68 h-64 m-auto">
         </div>
     </div>
     <h1 class="m-5 text-md font-bold">Overview</h1>
     <div class="m-6 flex gap-12">
         <div class="w-52 h-24 bg-blue-950 rounded-xl shadow-2xl">
            <h1 class="text-center mt-2 text-white ">Total Patients</h1>
            <div class="flex justify-center gap-14 items-center mt-2">
                <div>
                    <i class="fa-solid fa-bed-pulse text-white text-2xl"></i>
                </div>
                <div class="text-white text-4xl">
                    120
                </div>
            </div>
         </div>
         <div class="w-52 h-24 bg-blue-950 rounded-xl shadow-2xl">
            <h1 class="text-center mt-2 text-white ">Total Appointments</h1>
            <div class="flex justify-center gap-14 items-center mt-2">
                <div>
                    <i class="fa-solid fa-calendar-check text-2xl text-white"></i>
                </div>
                <div class="text-white text-4xl">
                    120
                </div>
            </div>
         </div>
         <div class="w-52 h-24 bg-blue-950 rounded-xl shadow-2xl">
            <h1 class="text-center mt-2 text-white ">Total Doctors</h1>
            <div class="flex justify-center gap-14 items-center mt-2">
                <div>
                    <i class="fa-solid fa-user-doctor text-2xl text-white"></i>
                </div>
                <div class="text-white text-4xl">
                    120
                </div>
            </div>
         </div>
         <div class="w-52 h-24 bg-blue-950 rounded-xl shadow-2xl">
            <h1 class="text-center mt-2 text-white ">Total Request</h1>
            <div class="flex justify-center gap-14 items-center mt-2">
                <div>
                    <i class="fa-solid fa-hand text-white text-2xl"></i>

                </div>
                <div class="text-white text-4xl">
                    120
                </div>
            </div>
         </div>
     </div>

 @endsection
