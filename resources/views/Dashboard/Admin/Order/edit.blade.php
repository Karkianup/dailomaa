@extends('Dashboard.layouts.master')

@section('content')
    <?php
    $segment2 = ucfirst(Request::segment(2));
    $segment3 = ucfirst(Request::segment(3));
    $segment4 = ucfirst(Request::segment(4));
    ?>
    <div class="container-fluid">
        <?php $segment = Request::segment(1); ?>
        <form role="form" action="{{ route($segment . '.' . 'order.update', $order->id) }}" method="POST"
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
                            <div class="card-icon">
                                <i class="fas fa-cube fa-2x"></i>
                            </div>
                            <h4 class="card-title">
                                {{ $breadcrum = $segment2 . '/' . $order->random_id }}
                            </h4>
                        </div>
                        @include('Dashboard.Admin.Order.fields')

                    </div>

                </div>
                <div class="col-md-4">
                    @include('Dashboard.Admin.Order.Partials.edit-status')
                    @include('Dashboard.Admin.Order.Partials.delivery_date')

                    @include('Dashboard.Commons.update-button-section')
                </div>
            </div>
        </form>

    </div>
@endsection
