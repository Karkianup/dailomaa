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
                        <div class="card-icon">
                            <i class="fas fas fa-cubes fa-2x"></i>
                        </div>
                        <h4 class="card-title">advertisements</h4>
                    </div>
                    <div class="card-body">
                        <div class="toolbar">
                            <!--        Here you can write extra buttons/actions for the toolbar              -->
                            @if($advertisementCount < 8)
                                <button onclick='window.location.href="{{ route('admin.advertisement2.create') }}"'>
                                    Create
                                </button>
                            @else
                                <div class="alert alert-info text-center">Advertisement cannot be added more than 8 times</div>
                            @endif
                        </div>
                        <div class="material-datatables">
                            <div id="datatables_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="datatables"
                                            class="table table-striped table-no-bordered table-hover dataTable dtr-inline"
                                            cellspacing="0" width="100%" style="width: 100%;" role="grid"
                                            aria-describedby="datatables_info">
                                            <thead>
                                                <tr role="row">
                                                    {{-- <th class="text-center"></th> --}}
                                                    <th class="sorting_asc" tabindex="0" aria-controls="datatables"
                                                        rowspan="1" colspan="1" style="width: 100px;"
                                                        aria-sort="ascending"
                                                        aria-label="Name: activate to sort column descending">Image
                                                    </th>
                                                    <th class="sorting_asc" tabindex="0" aria-controls="datatables"
                                                        rowspan="1" colspan="1" style="width: 177px;"
                                                        aria-sort="ascending"
                                                        aria-label="Name: activate to sort column descending">Title
                                                    </th>
                                                    <th class="sorting_asc" tabindex="0" aria-controls="datatables"
                                                        rowspan="1" colspan="1" style="width: 177px;"
                                                        aria-sort="ascending"
                                                        aria-label="Name: activate to sort column descending">Link
                                                    </th>
                                                    <th class="disabled-sorting text-right sorting" tabindex="0"
                                                        aria-controls="datatables" rowspan="1" colspan="1"
                                                        style="width: 208px;"
                                                        aria-label="Actions: activate to sort column ascending">Actions
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($advertisements as $advertisement)
                                                    @if (!empty($advertisement->id))
                                                        <tr role="row" class="odd">
                                                            <td>
                                                                <div class="img-container">
                                                                    <img src="{{ asset('Asset/Uploads/advertisements2/' . $advertisement->url) }}"
                                                                        alt="{{ $advertisement->name }}">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                {{ $advertisement->title }}
                                                            </td>
                                                            <td>
                                                                {{ $advertisement->link ?? '-' }}
                                                            </td>
                                                            <td class="text-right">
                                                                <a href="{{ route('admin.advertisement2.edit', $advertisement->id) }}"
                                                                    class="btn btn-link btn-info btn-just-icon like"><i
                                                                        class="fa fa-edit"></i></a>

                                                                <a href="{{ route('admin.advertisement2.destroy', $advertisement->id) }}"
                                                                    class="btn btn-link btn-danger btn-just-icon remove">
                                                                    <i class="fa fa-trash"></i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            </tbody>
                                        </table>

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
