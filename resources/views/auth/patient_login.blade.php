@extends('layout.landingpage_layout')

@section('content')
    <div class="shadow-lg rounded-xl m-10 flex" style="widht:100%; height:80vh;">
        <style>
            .image {
                background: url('https://img.freepik.com/free-photo/doctor-doing-their-work-pediatrics-office_23-2149224139.jpg?t=st=1712027281~exp=1712030881~hmac=f9db5f27f3c6d8b7741f3d556601e56631e75f735c38a2e893cd37ddf71603b9&w=996') no-repeat center center/cover
            }
        </style>
        <div class="w-1/2 h-full bg-blue-500 rounded-l-xl image">

        </div>
        <div class="w-1/2">
            <div class="flex justify-center mt-5">
                <img src="https://unc.edu.ph/wp-content/uploads/2022/04/79794414_111016303724059_5940762222245445632_n-800x800.jpg"
                    class="w-16" alt="">
            </div>
            <div class="text-center leading-relaxed">
                <h1 class="text-xl m-3 font-semibold text-gray-600">Sign Your Account!</h1>
                <p class="text-xs text-gray-500">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sed, beatae.</p>
            </div>

            <div>
                @error('error_message')
                    <div class="mx-10 p-3 mt-3 bg-red-300 border-l-2 border-red-600 duration-700">
                        <p class="text-xs text-gray-800">{{ $message }}</p>
                    </div>
                @enderror

                <form action="/login/process" method="POST" class="flex justify-center">
                    @csrf
                    <div class="w-full p-10" style="width: 80%;">
                        @error('email')
                            <div class="text-white bg-red-500 w-full text-xs p-3">
                                {{ $message }}
                            </div>
                        @enderror
                        <div class="mb-5">
                            <label for="email" class="text-gray-600">Email</label><br>
                            <input type="email" name="email" id="email"
                                class="outline-none text-xs p-2.5 border w-full text-gray-400 font-normal">
                        </div>
                        <div class="mb-5">
                            <label for="password" class="text-gray-600">Password</label><br>
                            <div class="relative">
                                <input type="password" id="password" name="password"
                                    class="outline-none text-xs p-2.5 border w-full  text-gray-400 font-normal">
                                <i class="fa-solid fa-eye-slash fa-sm mt-5 absolute top-0 right-0 mr-3 text-gray-400 cursor-pointer"
                                    id="togglePassword"></i>
                            </div>
                        </div>
                        <div class="mt-5">
                            <input type="submit" value="Sign In"
                                class="outline-none text-xs p-2.5 border w-full bg-blue-500 text-white">
                        </div>
                        <div class="mt-5">
                            <span class="text-gray-600">Don't have an account? <a href=""
                                    class="text-blue-600 underline text-xs">Contact UNC IT Dept.</a></span>
                        </div>
                    </div>
                </form>



            </div>
        </div>

    </div>

    <script>
        const togglePassword = document.querySelector("#togglePassword");
        const password = document.querySelector("#password");

        togglePassword.addEventListener("click", function() {
            const type = password.getAttribute("type") === "password" ? "text" : "password";
            password.setAttribute("type", type);
            this.classList.toggle("fa-eye");
        });
    </script>
@endsection
