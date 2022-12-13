@extends('Dashboard.layouts.master')

@section('content')
    <div class="container-fluid">
        <?php $segment = Request::segment(1); ?>
        <form role="form" enctype="multipart/form-data" action="{{ route('admin.advertisement.store') }}" method="POST">
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
                    <div class="card ">
                        <div class="card-header card-header-rose card-header-icon">
                            <div class="card-icon">
                                <i class="fas fas fa-cube fa-2x"></i>
                            </div>
                            @include('Dashboard.Commons.breadcrum')
                            <div class="card-body ">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div>
                                            <label for="name"> Name *</label>
                                            <input type="text" class="form-control" name="title" id="name">
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>

                    <div class="card ">
                        <div class="card-header card-header-rose card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">contacts</i>
                            </div>
                            <h4 class="card-title">Image</h4>
                        </div>
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-md-4 col-sm-4">
                                    <div class="fileinput fileinput-new text-center" data-provides="fileinput">


                                        <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                        <div>
                                            <span class="btn btn-rose btn-round btn-file">
                                                <span class="fileinput-new">Select image</span>
                                                <span class="fileinput-exists">Change</span>
                                                <input type="file" name="url" kl_vkbd_parsed="true">
                                            </span>
                                            <a href="#pablo" class="btn btn-danger btn-round fileinput-exists"
                                                data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                                <h3>Link</h3>
                            <input type="url" name="link" class="form-control" required>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="box-header with-border">
                                <h3 class="box-title">Action</h3>
                            </div>
                            <div class="box-footer" style="display: block;">
                                <input class="btn btn-primary" type="submit">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">

                </div>
            </div>
        </form>
    </div>
@endsection
