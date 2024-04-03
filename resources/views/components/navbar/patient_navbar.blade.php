<nav class="w-full h-24 bg-white shadow-md flex justify-between items-center sticky top-0 left-0">
    {{-- logo --}}
    <div class="ml-10 mb-3">
        <a href="/">
            <img src="{{ asset('asset/img/logo/Untitled.jpg') }}" class="w-40" alt="logo">
        </a>
    </div>
    {{-- links --}}
    <div>
        <style>
            li {
                padding: 20px;
            }

            li a {
                color: #102039;
                margin: 10px;
                padding: 10px;
            }

            li a:hover {
                color: rgba(21, 111, 237, 0.989);
            }
        </style>
        <ul class="flex font-medium">
            <li><a href="/">Home</a></li>
            <li><a href="#">About</a></li>
            <li><a href="#">Doctors</a></li>
            <li><a href="#">Department</a></li>
            <li><a href="#">Contact</a></li>
        </ul>
    </div>
    {{-- user profile --}}
    <div class="flex items-center">
        @auth('student')
            <div class="flex items-center mr-10">
                @php
                    $default_profile = 'https://api.dicebear.com/7.x/adventurer-neutral/svg';
                @endphp

                <div class="border-2 border-black rounded-full flex justify-center items-center p-2 m-3">
                    <img src="{{ Auth::guard('student')->user()->image ? asset('storage/student/' . Auth::guard('student')->user()->image) : $default_profile }}"
                        class="w-8 h-8 rounded-full" alt="">
                </div>
                <span>{{ Auth::guard('student')->user()->first_name }}</span>
            </div>
        @endauth
        @guest
            <a href="/patient_login" class="bg-blue-600 p-3 text-white rounded-sm shadow-md hover:bg-blue-800 duration-300">
                <button class="w-24">Sign In</button>
            </a>
        @endguest
    </div>
</nav>
