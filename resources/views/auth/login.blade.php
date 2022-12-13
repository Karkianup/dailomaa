@extends('Frontend.layouts.master')
@section('content')
    <!-- banner -->
    <div class="nav-info">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                    <nav class="breadcrumbs">
                        <a href="">home</a>
                        <span class="divider">/</span>
                        Login
                    </nav>
                </div>

            </div>
        </div>
    </div>

    <section class="login-body">
        <div class="container">
            {{-- <div class="login">
                <i class="fa fa-sign-in" aria-hidden="true"></i>
                <strong>Welcome!</strong>
                <span>Sign in to your account</span>
                @if ($errors->any())
                    <div class="alert alert-danger col-md-12">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if ($message = Session::get('error'))
                    <div class="alert alert-danger">
                        <p>{{ $message }}</p>
                    </div>
                @endif

                @isset($url)
                    <form method="POST" class="login-form mt-3" action='{{ url("login/$url") }}'
                        aria-label="{{ __('Login') }}">
                    @else
                        <form method="POST" class="login-form mt-3" action="{{ route('login') }}"
                            aria-label="{{ __('Login') }}">
                        @endisset
                        @csrf

                        <fieldset>
                            <div class="form">
                                <div class="form-row">
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                    <label class="form-label" for="input">Email</label>
                                    <input id="email" type="email" class="form-text @error('email') is-invalid @enderror"
                                        name="email" value="{{ old('email') }}" required autocomplete="off" autofocus>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-row"> --}}
            {{-- <i class="fa fa-eye" aria-hidden="true"></i> --}}
            {{-- <label class="form-label" for="input">Password</label>
                                    <input id="password" type="password"
                                        class="form-text @error('password') is-invalid @enderror" name="password" required
                                        autocomplete="off">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-row bottom"> --}}
            {{--  <div class="form-check">
                                        <input type="checkbox" onclick="showPassword()">
                                        <label for="show"> Show Password</label>
                                    </div>  --}}
            {{--  @if (Route::has('password.request'))
                                        @isset($url)
                                            <a href="{{ route($url . '.' . 'password.request') }}" class="forgot">Forgot
                                                Password?</a>
                                        @else
                                            <a href="{{ route('password.request') }}" class="forgot">Forgot Password?</a>
                                        @endisset
                                    @endif  --}}
            {{-- </div>
                                <div class="form-row button-login">
                                    <button class="btn btn-login form-control">Login
                                    </button>
                                </div>

                                <p class="text-left mt-1 mb-2">Or, Login With</p>
                                <button type="button" class="btn btn-login form-control fb-btn">
                                    <i class="fa fa-facebook pr-4" aria-hidden="true"></i> Facebook

                                </button><br> --}}
            {{-- <a href="{{ route('google-login-proceed') }}">
                                    <button type="button" class="btn btn-login form-control google-btn">
                                        <i class="fa fa-google-plus pr-4" aria-hidden="true"></i>
                                        Google
                                    </button>
                                </a> --}}
            {{-- </div>
                            <p class="text-left mt-1 mb-2">Are you a New Member ?</p>
                        </fieldset>
                    </form>

                    @isset($url)
                        <a href="{{ url("register/$url") }}">
                            <button type="button" class="btn btn-login form-control fb-btn">
                                Register
                            </button>
                        </a>
                    @else
                        <a href="{{ url('register') }}">
                            <button type="button" class="btn btn-login form-control fb-btn">
                                Register
                            </button>
                        </a>
                    @endisset
            </div> --}}
            <div class="login"
                style="background:url(../Asset/Uploads/Products/aaa.jpg) 0% 0% no-repeat;background-size: 38% 100%;background-color: #fff;">
                <i class="fa fa-sign-in" aria-hidden="true"></i>
                @if (request()->is('login/admin'))
                    <strong>Admin Login</strong>
                @else
                    <i class="fa fa-sign-in" aria-hidden="true"></i>
                    <strong>Welcome!</strong>
                @endif
                <span>Sign in to your account</span>
                @if ($errors->any())
                    <div class="alert alert-danger col-md-12">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if ($message = Session::get('error'))
                    <div class="alert alert-danger">
                        <p>{{ $message }}</p>
                    </div>
                @endif

                @isset($url)
                    <form method="POST" class="login-form mt-3" action='{{ url("login/$url") }}'
                        aria-label="{{ __('Login') }}">
                    @else
                        <form method="POST" class="login-form mt-3" action="{{ route('login') }}"
                            aria-label="{{ __('Login') }}">
                        @endisset
                        @csrf

                        <fieldset>
                            <div class="form">
                                <div class="form-row">
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                    <label class="form-label" for="input">Email</label>
                                    <input id="email" type="email"
                                        class="form-text @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="off" autofocus>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-row">
                                    {{-- <i class="fa fa-eye" aria-hidden="true"></i> --}}
                                    <label class="form-label" for="input">Password</label>
                                    <input id="pass" type="password"
                                        class="form-text @error('password') is-invalid @enderror" name="password" required
                                        autocomplete="off">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-row bottom">
                                    <div class="form-check">
                                        <input type="checkbox" id="check">
                                        <label for="show"> Show Password</label>
                                    </div>
                                    @if (Route::has('password.request'))
                                        @isset($url)
                                            <a href="{{ route($url . '.' . 'password.request') }}" class="forgot">Forgot
                                                Password?</a>
                                        @else
                                            <a href="{{ route('password.request') }}" class="forgot">Forgot Password?</a>
                                        @endisset
                                    @endif
                                </div>
                                <div class="form-row button-login">
                                    <button class="btn btn-login form-control">
                                        {{-- <i class="fa fa-sign-in" aria-hidden="true" style="color: #fff;"></i> --}}
                                        Login
                                    </button>
                                </div>
                                <p class="text-center mt-1 mb-1">Or, Login With</p>
                                <div class="row">

                                    <div class="col-md-6">

                                        <button type="button" class="btn btn-login form-control fb-btn">
                                            {{-- <i class="fa fa-facebook pr-4" aria-hidden="true"></i> --}}
                                            Facebook

                                        </button>
                                    </div>
                                    <div class="col-md-6">

                                        <a href="{{ route('google-login-proceed') }}">
                                            <button type="button" class="btn btn-login form-control google-btn">
                                                {{-- <i class="fa fa-google-plus pr-4" aria-hidden="true"></i> --}}
                                                Google
                                            </button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <p class="text-center mt-3 mb-2">Are you a New Member ? </p>
                        </fieldset>
                    </form>

                    @isset($url)
                        <strong> <a href="{{ url("register/$url") }}" style="color: #00A145 ">

                                Register Now

                            </a></strong>
                    @else
                        <strong> <a href="{{ url('register') }}"style="color: #00A145 ">

                                Register Now

                            </a></strong>
                    @endisset
            </div>
        </div>
    </section>
    <script>
        let showPassword = document.getElementById('check');
        let password = document.getElementById('pass');
        showPassword.addEventListener('click', () => {
            if (password.type == "password") {
                password.type = "text";
            } else {
                password.type = "password";

            }
        });
    </script>
@endsection
