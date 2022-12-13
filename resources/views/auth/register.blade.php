@extends('Frontend.layouts.master')
@section('content')
    <!-- banner -->
    <div class="nav-info">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <nav class="breadcrumbs">
                        <a href="">home</a>
                        <span class="divider">/</span>
                        Register
                    </nav>
                </div>

            </div>
        </div>
    </div>

    <section class="login-body">
        <div class="container">
            <div class="login"
                style="background:url(../Asset/Uploads/Products/aaa.jpg) 0% 0% no-repeat;background-size: 38% 100%;background-color: #fff;">
                <i class="fa fa-sign-in" aria-hidden="true"></i>
                <strong>Welcome!</strong>
                <span>Create your account</span>

                @isset($url)
                    <form method="POST" class="login-form mt-3" action='{{ url("register/$url") }}'
                        aria-label="{{ __('Register') }}">
                    @else
                        <form method="POST" class="login-form mt-3" action="{{ route('register') }}"
                            aria-label="{{ __('Register') }}">
                        @endisset
                        @csrf
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <fieldset>
                            <div class="form">
                                <div class="form-row">
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                    <label class="form-label" for="input">Name</label>
                                    <input id="name" type="text"
                                        class="form-text @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" required autocomplete="off" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
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
                                <div class="form-row">
                                    {{-- <i class="fa fa-eye" aria-hidden="true"></i> --}}
                                    <label class="form-label" for="input">Confirm Password</label>
                                    <input id="con" type="password" class="form-text" name="password_confirmation"
                                        required autocomplete="new-password">

                                </div>
                                <div class="form-row bottom">
                                    <div class="form-check">
                                        <span id="terms">
                                            <input type="checkbox" id="checkBox" onclick="terms()">
                                            <label for="show">I agree to Dailomaa's terms and conditions</label>
                                        </span>
                                    </div>

                                    <div class="form-check">
                                        <input type="checkbox" id="check" onclick="showPassword()">
                                        <label for="show"> Show Password</label>
                                    </div>
                                </div>
                                <div class="form-row button-login">
                                    <button class="btn btn-login form-control" id="registerButton">Register Account
                                    </button>
                                </div>
                            </div>
                            <p class="text-left mt-1 mb-2">Already Member ?</p>
                        </fieldset>
                    </form>
                    @isset($url)
                        <a href="{{ url("login/$url") }}">
                            <button type="button" class="btn btn-login form-control fb-btn">
                                Log In
                            </button>
                        </a>
                    @else
                        <a href="{{ url('login') }}">
                            <button type="button" class="btn btn-login form-control fb-btn">
                                Log In
                            </button>
                        </a>
                    @endisset
            </div>
        </div>
    </section>
    <script>
        let id = document.getElementById('check');
        id.addEventListener('click', function() {
            let password = document.getElementById('pass');
            let confirm = document.getElementById('con');

            if (password.type == "password") {
                password.type = "text"
                confirm.type = "text"

            } else {
                password.type = "password"
                confirm.type = "password"

            }
        });

        //terms and condition
        let terms = document.getElementById('terms');
        let registerButton = document.getElementById('registerButton');
        let checkBox = document.getElementById('checkBox');

        registerButton.disabled = true;
        terms.addEventListener('click', () => {
            if (registerButton.disabled == true) {
                registerButton.disabled = false;
                checkBox.checked=true;
            } else {
                registerButton.disabled = true;
                checkBox.checked=false;
            }
        });
    </script>
@endsection
