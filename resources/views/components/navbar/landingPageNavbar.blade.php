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
    {{-- sign in button --}}
    <div>
        @if (!request()->is('patient_login'))
            <a href="/patient_login"
                class="bg-blue-600 p-3 text-white mr-10 rounded-sm shadow-md hover:bg-blue-800 duration-300">
                <button class="w-24">Sign In</button>
            </a>
        @endif
    </div>
</nav>
