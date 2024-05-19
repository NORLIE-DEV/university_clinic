@include('partials.__header')

<div class="content" style="width: 100%;height:100vh;">
    @yield('content')
</div>
<style>
    .content{
        background: url('https://wallpapercave.com/wp/wp2508260.jpg') no-repeat center center/cover;
    }
</style>
@include('partials.__footer')
