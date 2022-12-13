@extends('Dashboard.layouts.master')

@section('content')
    <div class="container-fluid">
        <?php $segment = Request::segment(1); ?>
        <form role="form" action="{{ route($segment . '.' . 'category-wise-sub-category.store') }}" method="POST"
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
                        @include('Dashboard.Admin.Category-Wise-SC.fields')
                    </div>
                    @include('Dashboard.Admin.Category-Wise-SC.Partials.image-section')
                </div>
                <div class="col-md-4">

                    @include('Dashboard.Commons.status')

                    @include('Dashboard.Admin.Category-Wise-SC.Partials.category')
                    @include('Dashboard.Admin.Category-Wise-SC.Partials.is_featured')


                    @include('Dashboard.Includes.Buttons.submit-button-section')

                </div>
            </div>
        </form>
    </div>
@endsection
