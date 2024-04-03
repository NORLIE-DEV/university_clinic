@include('partials.__header')


@include('components.navbar.patient_navbar')
<div class="flex mt-12">
    <div class="" style="width: 800px; height:100vh;">
        <div class="border mx-10 mt-5 bg-white shadow-xl rounded-lg fixed" style="width: 250px; height:500px">
            <div class="p-4">
                <h1 class="font-semi-bold text-xl text-gray-500">Quick Links</h1>
            </div>
            <hr>
            <div>
                <ul>
                   
                </ul>
            </div>
        </div>
    </div>
    <div class="content" style="width: 100%; height:100%;">
        @yield('content')
    </div>
</div>

@include('partials.__footer')
