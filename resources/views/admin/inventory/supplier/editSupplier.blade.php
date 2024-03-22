@extends('layout.admin_layout')

@section('content')
    <div class="flex items-center justify-between">
        <div class="ml-7 mt-5 mb-3 text-xl font-semibold text-blue-950">
            Edit Supplier
        </div>
        <div class="mr-8">
            <a href="/admin/supplier">
                <button class="bg-blue-950 text-white text-xs p-2 w-24 rounded-md">Back</button>
            </a>
        </div>
    </div>
    <div class=" m-auto bg-white h-[550px] rounded-lg shadow" style="width: 94%;">

        <form action="/supplier/{{ $suppliers->id }}" id="supplierForm" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="text-xl m-4 p-3 text-blue-950 font-semibold">
                Supplier
            </div>
            <div class="flex w-full items-center m-7">
                <div class="w-1/4">
                    <label for="name" class="font-semibold">Supplier Name <span class="text-red-500">*</span></label>
                </div>
                <div class="w-full">
                    <input type="text" name="name" id="name"
                        class="border border-gray-500 p-2 text-sm rounded-md outline-none" style="width: 90%"
                        value="{{ $suppliers->name }}">
                </div>
            </div>
            <div class="flex w-full items-center m-7">
                <div class="w-1/4">
                    <label for="contact_number" class="font-semibold">Contact Number <span
                            class="text-red-500">*</span></label>

                </div>
                <div class="w-full">
                    <input type="text" name="contact_number" id="contact_number"
                        class="border border-gray-500 p-2 text-sm rounded-md outline-none" style="width: 90%"
                        value="{{ $suppliers->contact_number }}"><br>
                    <span id="cpNumber_err"></span>
                </div>
            </div>
            <div class="flex w-full items-center m-7">
                <div class="w-1/4">
                    <label for="email" class="font-semibold">Email <span class="text-red-500">*</span></label>
                </div>
                <div class="w-full">
                    <input type="email" name="email" id="email"
                        class="border border-gray-500 p-2 text-sm rounded-md outline-none" value="{{ $suppliers->email }}"
                        style="width: 90%">
                </div>
            </div>
            <div class="flex w-full m-7">
                <div class="w-1/4">
                    <label for="address" class="font-semibold">Address <span class="text-red-500">*</span></label>
                </div>
                <div class="w-full">
                    <textarea name="address" class="border border-gray-500 rounded-md" id="address"
                        style="width: 90%; height:150px; float: left; padding: 0; margin: 0;">{{ $suppliers->address }}</textarea>
                </div>
            </div>

            <div class="flex w-full m-7">
                <div class="w-1/4">
                </div>
                <div class="w-full">
                    <input type="submit" class="bg-blue-500 text-sm text-white p-2 rounded-md w-36">
                </div>
            </div>

        </form>

    </div>
@endsection
