@extends('layout.superadmin_login_layout')

@section('content')
    <div class="w-full h-screen flex justify-center items-center">
        <div class=" bg-white shadow border justify-center rounded-md" style="height: 300px; width:400px;">
            <div class="text-center pt-5 text-xl font-medium text-gray-800">
                UNC-CMS
            </div>
            <div class="text-center text-3xl font-bold text-gray-800">
                SUPER ADMIN
            </div>
            <hr class="mt-5">
            <form action="/login/process/superadmin" method="POST">
                @csrf
                <div>
                    <div class="m-5">
                        <input type="email" name="email" class="w-full outline-none text-xs p-3 border"
                            placeholder="example@gmail.com">
                    </div>
                    <div class="m-5">
                        <input type="password" name="password" class="w-full outline-none text-xs p-3 border" placeholder="********">
                    </div>
                </div>
                <div>
                    {{-- <a href=""></a> --}}
                    <div class="float-right mr-5 text-xs p-3 bg-violet-700 text-white rounded-md w-20 text-center">
                        <button type="submit">Login</button>
                    </div>
                </div>
            </form>
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
