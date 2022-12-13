@extends('Dashboard.layouts.master')

@section('content')
<div class="container-fluid">
    <?php
    $segment = Request::segment(1);
    ?>
    <form role="form" action="{{url($segment . '/' . 'update-password')}}" method="POST" enctype="multipart/form-data">
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
                        <div class="card-icon">
                            <i class="material-icons">mail_outline</i>
                        </div>
                        <h4 class="card-title">Change Password</h4>
                    </div>
                    <div class="card-body ">
                        <div class="form-group bmd-form-group">
                            <label for="oldPassword" class="bmd-label-floating"> Old Password *</label>
                            <input type="password" class="form-control" name="oldPassword" id="oldPassword"
                                required="true" aria-required="true">
                            @error('oldPassword')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group bmd-form-group">
                            <label for="password" class="bmd-label-floating"> New Password *</label>
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required
                                autocomplete="off">

                            {{-- @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror --}}
                        </div>
                        <div class="form-group bmd-form-group">
                            <label for="confirmPassword" class="bmd-label-floating"> Confirm Password *</label>
                            <input id="password-confirm" type="password" class="form-control"
                                name="password_confirmation" required autocomplete="off">
                            {{-- @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror --}}
                        </div>

                    </div>

                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="box-header with-border">
                            <h3 class="box-title">Action</h3>
                        </div>
                        <div class="box-footer" style="display: block;">
                            <input class="btn btn-primary" type="submit" value="Update">
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </form>
</div>
@endsection