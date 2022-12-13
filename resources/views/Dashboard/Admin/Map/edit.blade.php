@extends('Dashboard.layouts.master')

@section('content')
    @if (Session('message'))
        <div class="alert alert-success"> {{ session('message') }} </div>
    @endif
    <div class="container-fluid">
        <?php $segment = Request::segment(1); ?>
        <form role="form" enctype="multipart/form-data" action="{{ route('admin.map.update') }}" method="POST">
            @csrf
            @method('put')
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
                                            <label for="name"> Google Map link *</label>
                                            @if (!empty($map->link))
                                                <input type="text" class="form-control" name="link"
                                                    value="{{ $map->link }}">
                                            @else
                                                <input type="text" class="form-control" name="link"
                                                    placeholder="Enter google map link here">
                                            @endif

                                        </div>
                                    </div>
                                </div>
                            </div>
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
            </div>
        </form>
    </div>
@endsection
