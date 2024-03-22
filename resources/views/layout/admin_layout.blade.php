@include('partials.__header')

<div class="flex">

    @include('components.sidebar.admin_sidebar')

    <div class="content bg-[#F1F5FB]" style="width: 100%">
        @include('components.navbar.admin_navbar')
        @yield('content')
    </div>
</div>

@include('partials.__footer')
