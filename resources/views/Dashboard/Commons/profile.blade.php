@extends('Dashboard.layouts.master')

@section('content')
<div class="container-fluid">
    <?php
        $segment = Request::segment(1);
        ?>
    <form role="form" action="{{route($segment . '_' . 'profile.profile.update',$profile->id)}}" method="POST"
        enctype="multipart/form-data">
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
        <div class="row">
            <div class="col-md-8">
                @include('Dashboard.Commons.profile-userdetails')
            </div>
            <div class="col-md-4">
                <div class="card card-profile">
                    @include('Dashboard.Commons.profile-userimage')
                    <div class="card-body">
                        <h4 class="card-title">{{$profile->name}}</h4>
                    </div>
                </div>
                @include('Dashboard.Includes.Buttons.update-button-section')
            </div>
        </div>
    </form>

</div>
@endsection