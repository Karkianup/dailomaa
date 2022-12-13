@extends('Frontend.layouts.master')
@section('content')
    <?php $segment = Request::segment(1); ?>
    <div class="nav-info">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <nav class="breadcrumbs">
                        <a href="">home</a>
                        <span class="divider">/</span>
                        Edit Profile
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
                    <h2 class="pb-3">Edit Profile</h2>
                    <div class=" mb-5">

                        <div class="bg-gray user-profile up-manage">
                            <h5>Personal Profile</h5>
                            <form role="form" action="{{ url($segment . '/' . 'profile/update') }}"
                                method="POST" enctype="multipart/form-data">
                                @method('put')
                                @csrf
                                @if ($errors->any())
                                    <div class="alert alert-danger col-md-12">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <p>
                                            <span> Full Name</span> <br>
                                            <input class="form-control" type="text" name="name" value="{{ $user->name }}">
                                        </p>
                                    </div>
                                    <div class="col-md-4">
                                        <p>
                                            <span>Email Address</span> <br>
                                            <input class="form-control" type="text" name="email"
                                                value="{{ $user->email }}">
                                        </p>

                                    </div>
                                    <div class="col-md-4">
                                        <p>
                                            <span> Mobile</span>
                                            <br>
                                            <input class="form-control" type="text" name="contact_no"
                                                value="{{ $user->contact_no }}">
                                        </p>
                                    </div>
                                    <div class="col-md-4">
                                        <p>
                                            <span> Birthday</span> <br>
                                            <input class="form-control" type="date" name="dob" value="{{ $user->dob }}">
                                        </p>
                                    </div>
                                    <div class="col-md-4">
                                        <p>
                                            <span> Gender</span> <br>
                                            <select name="gender" class="form-control">
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                            </select>
                                        </p>
                                    </div>

                                </div>

                                <button type="submit" class="user-manage-btn">UPDATE PROFILE</button>
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
