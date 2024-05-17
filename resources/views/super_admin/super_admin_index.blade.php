 @extends('layout.superadmin_layout')

 @section('content')
     <div class="m-5 font-medium text-gray-500">
         Dashboard
     </div>
     <div class="mt-10 flex justify-between m-4">
         <div class="w-60 h-32 bg-green-600 shadow-lg rounded-md border"></div>
         <div class="w-60 h-32 bg-pink-600 shadow-lg rounded-md border"></div>
         <div class="w-60 h-32 bg-blue-600 shadow-lg rounded-md border"></div>
         <div class="w-60 h-32 bg-teal-600 shadow-lg rounded-md border"></div>
     </div>
     <div class="m-5 font-medium text-gray-500">
         Reports
     </div>
     <div class="mt-10">
         <div class="flex justify-between m-5 gap-5">
             <div class="w-3/4 h-80 bg-white shadow-md">

             </div>
             <div class="w-1/4 h-80 bg-white shadow-md">

             </div>
         </div>
     </div>
 @endsection
