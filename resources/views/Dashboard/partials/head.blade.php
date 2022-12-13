<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Dailomaa</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport">
    <!--     Fonts and icons     -->
    {{--
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    --}}
    {{-- <script src="https://kit.fontawesome.com/bd5baa06ba.js" crossorigin="anonymous">
    </script> --}}
    <!-- CSS Files -->
    {{-- Google Fonts --}}
    <link href="{{ asset('Asset/Fonts/google-fonts.css') }}" rel="stylesheet" />
    

    {{-- Material Dashboard CSS --}}
    <link href="{{ asset('Asset/Dashboard/css/material-dashboard.min.css') }}" rel="stylesheet" />

    <script src="{{asset('Asset/Dashboard/ckeditor/ckeditor.js')}}" type="text/javascript"></script>

    {{-- Custom CSS --}}
    <link href="{{ asset('Asset/Dashboard/css/custom.css') }}" rel="stylesheet" />
    <script src="{{ asset('Asset/Dashboard/ckeditor/ckeditor.js') }}" type="text/javascript"></script>


    <script src="{{ asset('Asset/Fonts/fontawesome.js') }}"></script>

</head>
