@extends('Dashboard.layouts.master')

@section('content')
<div class="container-fluid">
    <?php
    $segment = Request::segment(1);
    ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-primary card-header-icon">
                    @include('Dashboard.Admin.Payment-Method.card-icon')
                    @include('Dashboard.Commons.breadcrum')
                </div>
                <div class="card-body">
                    <div class="toolbar">
                        <!--        Here you can write extra buttons/actions for the toolbar              -->
                        <button>
                            <a href="{{route($segment.'.'.'payment-method.create')}}">
                                Create
                            </a>
                        </button>
                    </div>
                    <div class="material-datatables">
                        <div id="datatables_wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <div class="row">
                                <div class="col-sm-12">
                                    @include('Dashboard.Admin.Payment-Method.table')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end content-->
            </div>
            <!--  end card  -->
        </div>
        <!-- end col-md-12 -->
    </div>
    <!-- end row -->
</div>

@endsection