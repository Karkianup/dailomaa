<!DOCTYPE html>
<html lang="en">
@include('Frontend.partials.head')

<body>
    @include('Frontend.partials.Nav.top')
    @include('Frontend.partials.header')

    @yield('content')

    @include('Frontend.partials.footer')


</body>
@include('Frontend.partials.js-files')

</html>
