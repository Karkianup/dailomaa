@extends('Frontend.layouts.master')
@section('content')
    <?php $segment = Request::segment(1); ?>
    <!-- banner -->
    <div class="nav-info">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <nav class="breadcrumbs">
                        <a href="">home</a>
                        <span class="divider">/</span>
                        Profile
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
                    <h2 class="pb-3">My Profile</h2>
                   @if(Session('message'))
                        <div class="alert alert-success text-center">{{ Session('message') }}</div>
                    @endif
                    <div class=" mb-5">
                        <div class="bg-gray user-profile up-manage">
                            <h5>Personal Profile | <span><a
                                        href="{{ url($segment . '/' . 'profile/edit') }}">Edit</a></span>
                            </h5>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <p>
                                        <span> Full Name</span> <br> {{ $user->name }}
                                    </p>
                                </div>
                                <div class="col-md-4">
                                    <p>
                                        <span>Email Address</span> <br> {{ $user->email }}
                                    </p>

                                </div>
                                <div class="col-md-4">
                                    <p>
                                        <span> Mobile</span> <br> (977) {{ $user->contact_no }}
                                    </p>
                                </div>
                                <div class="col-md-4">
                                    <p>
                                        <span> Birthday</span> <br>
                                        <span>{{ $user->dob ?? 'Please enter your birthday' }}</span>
                                    </p>
                                </div>
                                <div class="col-md-4">
                                    <p>
                                        <span> Gender</span> <br> {{ $user->gender }}
                                    </p>
                                </div>
                            </div>

                            <a href="{{ url($segment . '/' . 'profile/edit') }}">
                                <button type="button" class="user-manage-btn">EDIT PROFILE</button>
                            </a>
                            <a href="{{ url($segment . '/' . 'change-password') }}">
                                <button type="button" class="user-manage-btn">Change Password</button>
                            </a>
                        </div>

                    </div>


                </div>

            </div>
        </div>
    </section>
@endsection
