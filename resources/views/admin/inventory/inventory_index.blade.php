@extends('layout.admin_layout')

@section('content')
    <div class="ml-5 mt-5 text-2xl font-semibold text-blue-950">
        Inventory
    </div>
    <div class="ml-5 text-gray-500">
        <a href="#">Index</a><span> / </span><a href="#">Inventory</a>
    </div>

    <div class="flex justify-center gap-8 mt-10">
        <div class="bg-white shadow rounded-lg" style="width: 30%; height:200px;">
            <a href="/admin/medicine_inventory">
                <div class="flex">
                    <div class="">
                        <h1 class="m-5 text-2xl text-blue-900 font-semibold">Medicines</h1>
                        <div class="w-20 h-20 bg-blue-200 m-5 rounded-full flex justify-center items-center">
                            <i class="fa-solid fa-pills text-blue-950 text-2xl"></i>
                        </div>
                    </div>
                    <div class="flex justify-center items-center">
                        <h1 class="mt-10 text-5xl font-bold text-blue-950">{{ $medicineCounts }}</h1>
                    </div>
                </div>
            </a>
        </div>
        <div class="bg-white shadow rounded-lg" style="width: 30%; height:200px;">
            <a href="">
                <div class="flex">
                    <div class="">
                        <h1 class="m-5 text-2xl text-blue-900 font-semibold">Equipments</h1>
                        <div class="w-20 h-20 bg-blue-200 m-5 rounded-full flex justify-center items-center">
                            <i class="fa-solid fa-toolbox text-blue-950 text-2xl"></i>
                        </div>
                    </div>
                    <div class="flex justify-center items-center ">
                        <h1 class="mt-10 text-5xl font-bold text-blue-950">1</h1>
                    </div>
                </div>
            </a>
        </div>
        <div class="bg-white shadow rounded-lg" style="width: 30%; height:200px;">
            <a href="/admin/medicine_stocks">
                <div class="flex">
                    <div class="">
                        <h1 class="m-5 text-2xl text-blue-900 font-semibold">Medicines Stock</h1>
                        <div class="w-20 h-20 bg-blue-200 m-5 rounded-full flex justify-center items-center">
                            <i class="fa-solid fa-box text-blue-950 text-2xl"></i>
                        </div>
                    </div>
                    <div class="flex justify-center items-center ">
                        <h1 class="mt-10 text-5xl font-bold text-blue-950">1</h1>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <div class="flex justify-center gap-8 mt-10">
        <div class="bg-white shadow rounded-lg" style="width: 30%; height:200px;">
            <a href="">
                <div class="flex">
                    <div class="">
                        <h1 class="m-5 text-2xl text-blue-900 font-semibold">Equipments Stock</h1>
                        <div class="w-20 h-20 bg-blue-200 m-5 rounded-full flex justify-center items-center">
                            <i class="fa-solid fa-pills text-blue-950 text-2xl"></i>
                        </div>
                    </div>
                    <div class="flex justify-center items-center ">
                        <h1 class="mt-10 text-5xl font-bold text-blue-950">1</h1>
                    </div>
                </div>
            </a>
        </div>
        <div class="bg-white shadow rounded-lg" style="width: 30%; height:200px;">
            <a href="/admin/supplier">
                <div class="flex">
                    <div class="">
                        <h1 class="m-5 text-2xl text-blue-900 font-semibold">Supplier</h1>
                        <div class="w-20 h-20 bg-blue-200 m-5 rounded-full flex justify-center items-center">
                            <i class="fa-solid fa-truck-field text-blue-950 text-2xl"></i>
                        </div>
                    </div>
                    <div class="flex justify-center items-center ">
                        <h1 class="mt-10 text-5xl font-bold text-blue-950">{{$supplierCounts}}</h1>
                    </div>
                </div>
            </a>
        </div>
        <div class="bg-white shadow rounded-lg" style="width: 30%; height:200px;">
            <a href="">
                <div class="flex">
                    <div class="">
                        <h1 class="m-5 text-2xl text-blue-900 font-semibold">Transaction</h1>
                        <div class="w-20 h-20 bg-blue-200 m-5 rounded-full flex justify-center items-center">
                            <i class="fa-solid fa-box text-blue-950 text-2xl"></i>
                        </div>
                    </div>
                    <div class="flex justify-center items-center ">
                        <h1 class="mt-10 text-5xl font-bold text-blue-950">1</h1>
                    </div>
                </div>
            </a>
        </div>
    </div>
@endsection
