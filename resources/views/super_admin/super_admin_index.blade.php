 @extends('layout.superadmin_layout')

 @section('content')
     <div class="m-5 text-gray-500 text-xl">
         Dashboard
     </div>
     <div class="mt-10 flex justify-between m-4">
         <div class="w-60 h-32 bg-green-600 shadow-lg rounded-md border">
             <div class="flex ">
                 <div class="w-14 h-14 rounded-full m-4 mt-10 bg-white flex justify-center items-center">
                     <i class="fa-solid fa-bed-pulse text-2xl text-gray-600"></i>
                 </div>
                 <div class="flex items-center">
                     <div class="mt-4">
                         <div class="text-3xl text-white font-medium">{{ $countPatient }}</div>
                         <div class="text-white">Total Patients</div>
                     </div>
                 </div>
             </div>
         </div>
         <div class="w-60 h-32 bg-pink-600 shadow-lg rounded-md border">
             <div class="flex ">
                 <div class="w-14 h-14 rounded-full m-4 mt-10 bg-white flex justify-center items-center">
                     <i class="fa-solid fa-graduation-cap text-2xl text-gray-600"></i>
                 </div>
                 <div class="flex items-center">
                     <div class="mt-4">
                         <div class="text-3xl text-white font-medium">{{ $countStudent }}</div>
                         <div class="text-white">Total Students</div>
                     </div>
                 </div>
             </div>
         </div>
         <div class="w-60 h-32 bg-blue-600 shadow-lg rounded-md border">
             <div class="flex ">
                 <div class="w-14 h-14 rounded-full m-4 mt-10 bg-white flex justify-center items-center">
                     <i class="fa-solid fa-users text-2xl text-gray-600"></i>
                 </div>
                 <div class="flex items-center">
                     <div class="mt-4">
                         <div class="text-3xl text-white font-medium">{{ $countEmployee }}</div>
                         <div class="text-white">Total Employees</div>
                     </div>
                 </div>
             </div>
         </div>
         <div class="w-60 h-32 bg-teal-600 shadow-lg rounded-md border">
             <div class="flex ">
                 <div class="w-14 h-14 rounded-full m-4 mt-10 bg-white flex justify-center items-center">
                     <i class="fa-solid fa-user-doctor text-2xl text-gray-600"></i>
                 </div>
                 <div class="flex items-center">
                     <div class="mt-4">
                         <div class="text-3xl text-white font-medium">{{ $countDoctor }}</div>
                         <div class="text-white">Total Doctors</div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
     @php
         $currentDate = now()->toDateString();
     @endphp
     <div class="flex mb-10 justify-between overflow-x-hidden overflow-y-hidden gap-5 border">
         <div class="bg-white shadow-md" style="width:60%; height:450px;">
             <div class="flex justify-between m-4 items-center" id="head_medical">
                 <div class="p-3 text-xl text-gray-700">
                     Medical Consultation
                     <button id="switch" class="z-10"><i class="fa-solid fa-repeat"></i></button>
                 </div>
                 <input type="date" class="text-xs border rounded-sm outline-none p-3 w-40 bg-green-500 text-white"
                     name="selectedDate" id="selectedDate" value="{{$currentDate}}">
             </div>
             <div class="hidden" id="head_dental">
                 <div class="flex justify-between m-4 items-center">
                     <div class="p-3 text-xl text-gray-700">
                         Dental Consultation
                         <button id="switch_back" class="z-"><i class="fa-solid fa-repeat"></i></button>
                     </div>
                     <input type="date" class="text-xs border rounded-sm outline-none p-3 w-40 bg-green-500 text-white"
                         name="selectedDateDental" id="selectedDateDental" value="{{$currentDate}}">
                 </div>
             </div>
             <div id="histogram" class="medicalConsultationDiv" style="width: 100%; height:400px;"></div>
             <div id="histogram_dental" class="dentalConsultationDiv" style="width: 100%; height:400px;"></div>
         </div>
         <div>
             <div class="absolute mt-6 text-xl z-10">
                 System Users
             </div>
             <div style=" overflow-x-hidden" style="width:30%; height:400px;">

                 <div class="mt-10">
                     <div id="piechart" style="width: 100%; height:400px;"></div>
                 </div>
             </div>
         </div>

     </div>


     <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
     <script type="text/javascript"></script>

     <script>
         $(document).ready(function() {
             google.charts.load('current', {
                 packages: ['corechart']
             });
             google.charts.setOnLoadCallback(drawChart);
             google.charts.setOnLoadCallback(pieChart);
             google.charts.setOnLoadCallback(drawChartDental);

             function drawChart() {
                 var chartData = JSON.parse('{!! htmlspecialchars_decode($chartData) !!}');
                 var data = google.visualization.arrayToDataTable(chartData);

                 var options = {

                     legend: {
                         position: 'bottom'
                     },

                 };
                 var chart = new google.visualization.ColumnChart(document.getElementById('histogram'));

                 chart.draw(data, options);
             }

             function pieChart() {
                 var pieChartData = JSON.parse('{!! htmlspecialchars_decode($pieChartData) !!}');
                 var data = google.visualization.arrayToDataTable(pieChartData);
                 var options = {
                     curveType: 'function',
                     legend: {
                         position: 'bottom'
                     }
                 };


                 // Instantiate and draw the pie chart
                 var chart = new google.visualization.PieChart(document.getElementById('piechart'));
                 chart.draw(data, options);
             }


             $('#selectedDate').on('change', function() {
                 var selectedDate = $(this).val();

                 $.ajax({
                     method: 'get',
                     url: '/getMedicalConsultationData',
                     data: {
                         date: selectedDate,
                     },

                     success: function(response) {

                         updateHistogram(response);
                     },
                     error: function(xhr, status, error) {
                         console.error(error);
                     }
                 });
             });


             function updateHistogram(data) {
                 $('#histogram').empty();
                 var chartData = google.visualization.arrayToDataTable(data);

                 var options = {
                     legend: {
                         position: 'none',
                     },
                 };

                 var chart = new google.visualization.ColumnChart(document.getElementById('histogram'));
                 chart.draw(chartData, options);
             }

             $('#selectedDateDental').on('change', function() {
                 var selectedDate = $(this).val();

                 $.ajax({
                     method: 'get',
                     url: '/getDentalConsultationData',
                     data: {
                         date: selectedDate,
                     },

                     success: function(response) {

                         updateHistogramDental(response);
                     },
                     error: function(xhr, status, error) {
                         console.error(error);
                     }
                 });
             });


             function updateHistogramDental(data) {
                 $('#histogram_dental').empty();
                 var chartData = google.visualization.arrayToDataTable(data);

                 var options = {
                     legend: {
                         position: 'none',
                     },
                 };

                 var chart = new google.visualization.ColumnChart(document.getElementById('histogram_dental'));
                 chart.draw(chartData, options);
             }


         });


         $("#switch").click(function() {
             $(".medicalConsultationDiv").hide();
             $("#head_medical").hide();
             $("#head_dental").show();
             $(".dentalConsultationDiv").show();
         });
         $("#switch_back").click(function() {
             $("#head_medical").show();
             $(".medicalConsultationDiv").show();
             $("#head_dental").hide();
             $(".dentalConsultationDiv").hide();
         });

         function drawChartDental() {
             var chartDataDental = JSON.parse('{!! htmlspecialchars_decode($chartDataDental) !!}');
             var data = google.visualization.arrayToDataTable(chartDataDental);

             var options = {
                 width: 640,
                 height: 400,
                 legend: {
                     position: 'bottom'
                 },

             };
             var chart = new google.visualization.ColumnChart(document.getElementById('histogram_dental'));

             chart.draw(data, options);
         }
     </script>
 @endsection
