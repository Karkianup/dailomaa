@extends('Dashboard.layouts.master')

@section('content')
<div class="container-fluid">
    <?php
        $segment = Request::segment(1);
        ?>
    <form role="form" action="{{route($segment. '.' .'menu.update',$menu->id)}}" method="POST"
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
            <div class="col-md-3">
                @include('Dashboard.Admin.Menu.edit-menu-category')
            </div>
            <div class="col-md-3">
                @include('Dashboard.Admin.Menu.edit-menu-type')
            </div>
            <div class="col-md-3">
                @include('Dashboard.Admin.Menu.edit-status')
            </div>
            <div class="col-md-3">
                @include('Dashboard.Admin.Menu.edit-mega-menu')
            </div>
            <div class="col-md-8">
                @include('Dashboard.Admin.Menu.fields')
            </div>
            <div class="col-md-4">
                @include('Dashboard.Admin.Menu.edit-category')
                @include('Dashboard.Admin.Menu.edit-sub-category')
                @include('Dashboard.Admin.Menu.edit-page')
                @include('Dashboard.Includes.Buttons.submit-button-section')
            </div>
        </div>
    </form>

</div>
@endsection