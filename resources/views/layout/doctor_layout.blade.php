@include('partials.__header')
<div class="flex">
    @include('components.sidebar.doctor_sidebar')
    <div class="content bg-[#F0F8FA]" style="width: 85%;">
        <nav class="bg-white flex justify-between items-center shadow-xl p-5 sticky top-0 z-10">
            <div class="">
                <h1 class="text-blue-900 font-bold">UNIVERSITY CLINIC MANAGEMENT SYSTEM</h1>
            </div>
            <div class="w-1/2 flex justify-end pr-4 items-center">
            </div>
        </nav>
        @yield('content')
    </div>
</div>

<style>
    .dataTables_filter input[type="search"] {
        width: 150px;
        height: 30px;
        font-size: 14px;
        padding: 7px;
        outline: none;
    }

    .dataTables_length select {
        width: 50px;
        height: 30px;
        font-size: 14px;
        padding: 5px;
        outline: none;
    }

    .tableContainer {
        margin-top: 50px;
    }

    .dataTables_wrapper table.dataTable {
        position: relative;
        top: 32px;
        z-index: 1;
    }

    .dataTables_paginate {
        position: relative;
        z-index: 2;
        margin-top: 50px;
        font-size: 13px;
        color: #00ACBA;
    }

    .dataTables_info {
        position: relative;
        font-size: 13px;
        top: 32px;
        z-index: 1;
    }
</style>
@include('partials.__footer')
