@include('partials.__header')

{{-- box wrapper --}}
<div class="flex">
    <div class="w-1/2 bg-[#1C2434]" style="height:100vh;">
        <h1>WEW</h1>
    </div>
    <div class="w-1/2 h-full bg-[#E0E2E8]" style="height: 100vh;">

        <div class="flex justify-center mt-10">
            <img src="{{ asset('asset/img/79794414_111016303724059_5940762222245445632_n-800x800.png') }}"
                style="width:50px; height:50px;" alt="clinic_logo">
        </div>
        {{-- Form --}}
        <div class="bg-white shadow-lg rounded-lg" style="width:400px; margin: 0 auto; height:00px;">
            <form action="#">
                <div class=" text-center text-xs" style="width: 400px;">
                    <h1 class="text-center mt-10 text-3xl font-bold mb-2">WELCOME</h1>
                    <p class="text-xs">Lorem ipsum dolor sit amet consectetur adipisicing elit. Debitis laboriosam
                        voluptate dolores</p>
                </div>
                <div class="m-5">
                    <label for="email" class="text-xs ">Email</label><br>
                    <input type="email" id="email" name="email"
                        class="border p-2 w-full mt-2 text-xs rounded-md" placeholder="Email Address" />
                </div>
                <div class="m-5">
                    <label for="password" class="text-xs ">Password</label><br>
                    <input type="email" id="password" name="password"
                        class="border p-2 w-full mt-2 text-xs rounded-md" placeholder="Password" />
                </div>

                <div class="m-3">
                    <input type="submit" class="p-2 bg-red-600 w-full">
                </div>
            </form>
        </div>
    </div>
</div>
@include('partials.__footer')
