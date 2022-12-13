@extends('Frontend.layouts.master')

@section('content')
    <div class="nav-info">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                    <h3>Art Kit</h3>
                    <nav class="breadcrumbs">
                        <a href="{{ route('home') }}">home</a>
                        <span class="divider">/</span>
                        Confirm Password
                    </nav>
                </div>

            </div>
        </div>
    </div>
    <section class="login-body">
        <div class="container">
            <div class="login">
                <i class="fa fa-sign-in" aria-hidden="true"></i>
                <strong>Confirm Password</strong>
                <span>Please confirm your password before continuing.</span>
                @if ($errors->any())
                    <div class="alert alert-danger col-md-12">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" class="login-form mt-3" action="{{ route('password.confirm') }}">
                    @csrf
                    <fieldset>
                        <div class="form">
                            <div class="form-row">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                                <label class="form-label" for="input">Password</label>
                                <input id="password" type="password"
                                    class="form-text @error('password') is-invalid @enderror" name="password" required
                                    autocomplete="current-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-row bottom">
                                <div class="form-check">
                                    <input type="checkbox" onclick="showPassword()">
                                    <label for="show"> Show Password</label>
                                </div>
                            </div>
                            <div class="form-row button-login">
                                <button class="btn btn-login form-control">Confirm Password
                                </button>
                            </div>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="forgot">Forgot
                                    Password?</a>

                            @endif
                        </div>

                    </fieldset>
                </form>

            </div>
        </div>
    </section>

    {{-- <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Confirm Password') }}</div>

                    <div class="card-body">
                        {{ __('Please confirm your password before continuing.') }}

                        <form method="POST" action="{{ route('password.confirm') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="current-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Confirm Password') }}
                                    </button>

                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
@endsection
