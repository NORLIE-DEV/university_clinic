@include('partials.__header')

<div class="flex">

    @include('components.sidebar.superadmin_sidebar')

    <div class="content" style="width: 100%">
        @include('components.navbar.superAdminNavbar')
        @yield('content')
    </div>
</div>

@include('partials.__footer')
