@extends('Dashboard.layouts.master')

@section('content')
<div class="container-fluid">
    <?php
        $segment = Request::segment(1);
        ?>
    <form role="form" action="{{route($segment.'.'.'payment-method.update',$paymentMethod->id)}}" method="POST"
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
        @if ($message = Session::get('error'))
        <div class="alert alert-danger alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
        @endif
        <div class="row">
            <div class="col-md-8">
                <div class="card ">
                    <div class="card-header card-header-rose card-header-icon">
                        @include('Dashboard.Admin.Payment-Method.card-icon')

                        @include('Dashboard.Commons.breadcrum')
                    </div>
                    @include('Dashboard.Admin.Payment-Method.fields')
                </div>
                @include('Dashboard.Admin.Payment-Method.image-section')
            </div>
            <div class="col-md-4">
                @include('Dashboard.Admin.Payment-Method.edit-status')
                @include('Dashboard.Commons.update-button-section')

            </div>
        </div>
    </form>

</div>
@endsection