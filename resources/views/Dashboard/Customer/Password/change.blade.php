@extends('Frontend.layouts.master')
@section('content')
    <?php $segment = Request::segment(1); ?>
    <div class="nav-info">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <h3>Art Kit</h3>
                    <nav class="breadcrumbs">
                        <a href="">home</a>
                        <span class="divider">/</span>
                        Change Password
                    </nav>
                </div>

            </div>
        </div>
    </div>

    <section class="mybody mt-3">
        <div class="container">
            <div class="row">
                @include('Dashboard.Customer.Partials.side-nav')
                <div class="col-md-8 profile-manage ">
                    <h2 class="pb-3">Change Password</h2>
                    <div class=" mb-5">
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
                            <div class="alert alert-danger alert-block">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>{{ $message }}</strong>
                            </div>
                        @endif
                        <div class="bg-gray user-profile up-manage">
                            <form role="form" action="{{ url($segment . '/' . 'update-password') }}" method="POST"
                                enctype="multipart/form-data">
                                @method('put')
                                @csrf
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <p>
                                            <span> Old Password</span> <br>
                                            <input type="password" class="form-control" @error('password') is-invalid
                                                @enderror name="oldPassword" id="oldPassword" required="true"
                                                aria-required="true">
                                            @error('oldPassword')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </p>
                                    </div>
                                    <div class="col-md-12">
                                        <p>
                                            <span> New Password</span> <br>
                                            <input id="password" type="password"
                                                class="form-control @error('password') is-invalid @enderror" name="password"
                                                required autocomplete="off">
                                        </p>
                                    </div>
                                    <div class="col-md-12">
                                        <p>
                                            <span> Confirm Password</span> <br>
                                            <input id="password-confirm" type="password" class="form-control"
                                                name="password_confirmation" required autocomplete="off">
                                        </p>
                                    </div>
                                </div>

                                <button type="submit" class="user-manage-btn">SAVE CHANGES</button>
                            </form>
                            <a href="{{ url($segment . '/' . 'profile') }}">
                                <button class="user-manage-btn">Cancel</button>
                            </a>
                        </div>

                    </div>


                </div>

            </div>
        </div>
    </section>
@endsection
