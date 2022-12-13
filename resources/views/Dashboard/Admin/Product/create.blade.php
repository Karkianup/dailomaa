@extends('Dashboard.layouts.master')

@section('content')
    <div class="container-fluid">
        <?php $segment = Request::segment(1); ?>
        <form role="form" action="{{ route($segment . '.' . 'product.store') }}" method="POST"
            enctype="multipart/form-data">
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
                        </div>
                        @include('Dashboard.Admin.Product.fields')
                    </div>
                    @include('Dashboard.Admin.Product.Partials.main_image-section')
                    @include('Dashboard.Admin.Product.Partials.image-section')
                </div>
                <div class="col-md-4">

                    @include('Dashboard.Commons.status')

                    @include('Dashboard.Admin.Product.Partials.brand')

                    {{-- @can(['is_admin', 'is_super_admin'])
                        @include('Dashboard.Admin.Product.Partials.retailer')
                    @endcan --}}

                    {{-- @if (Gate::check('is_admin') || Gate::check('is_super_admin')) --}}
                    @if($segment == 'admin')
                        @include('Dashboard.Admin.Product.Partials.retailer')
                    @endif


                    @include('Dashboard.Admin.Product.Partials.is_featured')

                    @include('Dashboard.Includes.Buttons.submit-button-section')

                </div>
            </div>
        </form>
    </div>
@endsection
