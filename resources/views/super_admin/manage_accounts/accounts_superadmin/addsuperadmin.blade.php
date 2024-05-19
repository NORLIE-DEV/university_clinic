@extends('layout.superadmin_layout')

@section('content')
    <div class="bg-white h-auto p-3 shadow-xl rounded"
        style="width:1000px; margin: 10px auto; border:1px solid rgb(202, 197, 197);">
        <div class="flex justify-between mt-3">
            <h1 class="text-xl font-medium text-gray-500 ml-4"><i class="fa-solid fa-user-doctor"></i><span
                    class="ml-2"></span>Add Super Admin</h1>
            <a href="/superadmin/manageaccounts"
                class="bg-blue-950 p-2 text-xs w-24 rounded-md text-center text-white font-semibold">Back</a>
        </div>
        <form id="superadminForm"method="POST" enctype="multipart/form-data" class="mt-10">
            {{ csrf_field() }}
            <div class="flex">
                <div class="" style="width:650px;">
                    <h4 class="ml-2 font-semibold mt-5">Super Admin Information</h4>
                    <div class="flex justify-between">
                        <div class="m-2">
                            <label for="name" class="text-sm">Super Admin Name *</label><br>
                            <input type="text" name="name" placeholder="Name" class="p-2 rounded-md mt-2 text-xs"
                                style="border: 1px solid gray; width:300px;" required>
                        </div>
                        <div class="m-2">
                            <label for="phonenumber"class="text-sm">Phone Number *</label><br>
                            <input type="text" name="phonenumber" id="phonenumber" placeholder="Phone Number"
                                class="p-2 rounded-md mt-2 text-xs" style="border: 1px solid gray; width:300px;"required>
                            <div id="cpNumber_err"></div>
                        </div>
                    </div>
                    <div class="m-2">
                        <label for="gender" class="text-sm">Gender *</label><br>
                        <select name="gender" class=" rounded-md mt-2 text-xs"
                            style="border: 1px solid gray; width:620px; padding:8px;" required>
                            <option value="male" class="text-xs">Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>
                    <div class="m-2">
                        <label for="birthdate" class="text-sm">Data of Birth *</label><br>
                        <input type="date" name="birthdate" id="birthdate" class=" rounded-md mt-2 text-xs"
                            style="border: 1px solid gray; width:620px; padding:8px;" required>

                    </div>

                    <div class="m-2">
                        <label for="email" class="text-sm">Email *</label><br>
                        <input type="email" name="email" id="email" placeholder="Email"
                            class="p-2 text-xs rounded-md mt-2 " style="border: 1px solid gray; width:100%;" required>
                        <div id="error_email"></div>
                    </div>


                </div>
                {{-- image --}}
                <div class="mt-5" style="width: 400px;">

                    <div class="">
                        <img class="m-auto"id="image-preview" style="width:200px; height:180px;">
                    </div>
                    <div class="m-2">
                        <label for="image" class="text-xs ml-16">Upload Nurse Image</label>
                        <input type="file" name="image" id="upload" accept="image/*"
                            class="border text-xs mt-2 ml-16">
                    </div>
                </div>
            </div>
            <div class="flex justify-between text-sm">
                <div class="m-2">
                    <label for="password">Password *</label><br>
                    <input type="password" name="password" placeholder="Password" id="password"
                        class="p-2 text-xs rounded-md mt-2" style="border: 1px solid gray; width:450px;"required>


                </div>
                <div class="m-2">
                    <label for="password_confirmation">Confirm Password *</label><br>
                    <input type="password" name="password_confirmation" id="password_confirmation"
                        placeholder="Confirm Password" class="p-2 text-xs rounded-md mt-2"
                        style="border: 1px solid gray; width:450px;"required>
                    <div id="passwordMatch"></div>
                </div>
            </div>




            <div class="m-2">
                <label for="status" class="text-sm">Status*</label><br>
                <select name="status" class="p-2 text-xs rounded-md mt-2 w-full" style="border: 1px solid gray;" required>
                    <option value="active">Active</option>
                    <option value="not-active">Not Active</option>
                </select>
            </div>
            <input type="submit" id="submit" class="m-2 p-3 text-xs font-bold bg-blue-950 rounded-lg text-white"
                style="width:960px">
        </form>
    </div>
    <script src="{{asset('asset/js/superadmin/manageaccounts/superadmin.js') }}"></script>
@endsection
