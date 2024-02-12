@include('partials.__header')

<div>
    @include('components.navbar.landingPageNavbar')

    <div class="content">
        @yield('content')
    </div>
</div>

@include('partials.__footer')
