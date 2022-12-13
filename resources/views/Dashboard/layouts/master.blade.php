<!DOCTYPE html>
<html lang="en">
@include('Dashboard.partials.head')

<body class="">
    <div class="wrapper ">
        <div class="sidebar" data-color="rose" data-background-color="black"
            data-image="{{asset('Asset/Uploads/Static/sidebar-1.jpg')}}">
            @include('Dashboard.partials.logo-section')
            @include('Dashboard.partials.sidenav')
        </div>
        <div class="main-panel">
            <!-- Navbar -->
            @include('Dashboard.partials.top-nav')
            <!-- End Navbar -->
            <div class="content">
                @include('Dashboard.partials.flash-message')
                @yield('content')
                @yield('individual-page')
            </div>
            @include('Dashboard.partials.footer')
        </div>
    </div>
    @include('Dashboard.partials.js-files')
</body>

</html>