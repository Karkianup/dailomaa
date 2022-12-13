@extends('Dashboard.layouts.master')

@section('content')
<div class="container-fluid">
    <?php
    $segment = Request::segment(1);
    ?>
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
        <div class="col-md-4">
            <div class="card ">
                <div class="card-header card-header-rose card-header-text">
                    <div class="card-icon">
                        <i class="material-icons">today</i>
                    </div>
                    <h4 class="card-title">Cache Route</h4>
                </div>
                <div class="card-body ">
                    <a href="{{route($segment . '-' . 'route-cache')}}">
                        <button class="btn btn-primary">
                            Cache
                        </button>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card ">
                <div class="card-header card-header-rose card-header-text">
                    <div class="card-icon">
                        <i class="material-icons">today</i>
                    </div>
                    <h4 class="card-title">Clear Route Cache</h4>
                </div>
                <div class="card-body ">
                    <a href="{{route($segment . '-' . 'route-clear')}}">
                        <button class="btn btn-primary">
                            Clear
                        </button>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card ">
                <div class="card-header card-header-rose card-header-text">
                    <div class="card-icon">
                        <i class="material-icons">today</i>
                    </div>
                    <h4 class="card-title">Cache View</h4>
                </div>
                <div class="card-body ">
                    <a href="{{route($segment . '-' . 'view-cache')}}">
                        <button class="btn btn-primary">
                            Cache
                        </button>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card ">
                <div class="card-header card-header-rose card-header-text">
                    <div class="card-icon">
                        <i class="material-icons">today</i>
                    </div>
                    <h4 class="card-title">Clear View Cache</h4>
                </div>
                <div class="card-body ">
                    <a href="{{route($segment . '-' . 'view-clear')}}">
                        <button class="btn btn-primary">
                            Clear
                        </button>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card ">
                <div class="card-header card-header-rose card-header-text">
                    <div class="card-icon">
                        <i class="material-icons">today</i>
                    </div>
                    <h4 class="card-title">Cache Config</h4>
                </div>
                <div class="card-body ">
                    <a href="{{route($segment . '-' . 'config-cache')}}">
                        <button class="btn btn-primary">
                            Cache
                        </button>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card ">
                <div class="card-header card-header-rose card-header-text">
                    <div class="card-icon">
                        <i class="material-icons">today</i>
                    </div>
                    <h4 class="card-title">Clear Config</h4>
                </div>
                <div class="card-body ">
                    <a href="{{route($segment . '-' . 'config-clear')}}">
                        <button class="btn btn-primary">
                            Clear
                        </button>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card ">
                <div class="card-header card-header-rose card-header-text">
                    <div class="card-icon">
                        <i class="material-icons">today</i>
                    </div>
                    <h4 class="card-title">Clear Cache</h4>
                </div>
                <div class="card-body ">
                    <a href="{{route($segment . '-' . 'cache-clear')}}">
                        <button class="btn btn-primary">
                            Clear
                        </button>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card ">
                <div class="card-header card-header-rose card-header-text">
                    <div class="card-icon">
                        <i class="material-icons">today</i>
                    </div>
                    <h4 class="card-title">Clear Clockwork</h4>
                </div>
                <div class="card-body ">
                    <a href="{{route($segment . '-' . 'clear-clockwork')}}">
                        <button class="btn btn-primary">
                            Clean
                        </button>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card ">
                <div class="card-header card-header-rose card-header-text">
                    <div class="card-icon">
                        <i class="material-icons">today</i>
                    </div>
                    <h4 class="card-title">Optimize All</h4>
                </div>
                <div class="card-body ">
                    <a href="{{route($segment . '-' . 'optimize')}}">
                        <button class="btn btn-primary">
                            Optimize
                        </button>
                    </a>
                </div>
            </div>
        </div>


    </div>
</div>
@endsection