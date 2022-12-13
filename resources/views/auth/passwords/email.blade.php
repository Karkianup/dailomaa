@extends('Frontend.layouts.master')

@section('content')
    <div class="nav-info">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                    <h3>Art Kit</h3>
                    <nav class="breadcrumbs">
                        <a href="{{route('home')}}">home</a>
                        <span class="divider">/</span>
                        Reset Password
                    </nav>
                </div>

            </div>
        </div>
    </div>
    <section class="login-body">
        <div class="container">
            <div class="login">
                <i class="fa fa-sign-in" aria-hidden="true"></i>
                <strong>Reset Password</strong>
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" class="login-form mt-3" action="{{ route('password.email') }}">
                    @csrf
                    <fieldset>
                        <div class="form">
                            <div class="form-row">
                                <i class="fa fa-user" aria-hidden="true"></i>
                                <label class="form-label" for="input">Email Address</label>
                                <input id="email" type="email" class="form-text @error('email') is-invalid @enderror"
                                    name="email" value="{{ $email ?? old('email') }}" required autocomplete="email"
                                    autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                           
                          
                            <div class="form-row button-login">
                                <button class="btn btn-login form-control">Send Password Reset Link
                                </button>
                            </div>
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
                    <div class="card-header">{{ __('Reset Password') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                        name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Send Password Reset Link') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
@endsection
