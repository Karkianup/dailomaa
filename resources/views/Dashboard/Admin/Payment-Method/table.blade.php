<table id="datatables" class="table table-striped table-no-bordered table-hover dataTable dtr-inline" cellspacing="0"
    width="100%" style="width: 100%;" role="grid" aria-describedby="datatables_info">

    <thead>
        <tr role="row">
            {{-- <th class="sorting_asc" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 30px;"
                aria-sort="ascending" aria-label="Name: activate to sort column descending">#
            </th> --}}
            {{-- <th class="text-center"></th> --}}
            
            <th class="sorting_asc" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1"
                style="width: 177px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">
                Title
            </th>
            <th class="sorting_asc" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1"
                style="width: 177px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">
                URL
            </th>

            <th class="sorting" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 110px;"
                aria-label="Position: activate to sort column ascending">Status
            </th>

            <th class="sorting" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 114px;"
                aria-label="Date: activate to sort column ascending">Added At
            </th>
            <th class="disabled-sorting text-right sorting" tabindex="0" aria-controls="datatables" rowspan="1"
                colspan="1" style="width: 170px;" aria-label="Actions: activate to sort column ascending">Actions</th>
        </tr>
    </thead>
    <tbody id="tablecontents">
        @foreach($paymentMethod as $pm)
        <tr class="odd row1" role="odd" data-id="{{$pm->id}}">
           
            <td>{{$pm->title}}</td>
            <td>{{$pm->url}}</td>
            <td>
                <span class="{{$pm->active_status['status']}}">
                    {{$pm->active_status['message']}}
                </span>
            </td>
            <td>{{$pm->created_at->format('Y/m/d')}}
            </td>
            <td class="text-right">
                <a href="#" data-target="#modal-{{$pm->id}}" data-toggle="modal"
                    class="btn btn-link btn-warning btn-just-icon edit">
                    <i class="fa fa-eye"></i>
                </a>

                <a href="{{route($segment.'.'.'payment-method.edit',$pm->id)}}"
                    class="btn btn-link btn-info btn-just-icon like"><i class="fa fa-edit"></i></a>
                <a class="btn btn-link btn-danger btn-just-icon remove">
                    <form onsubmit="return confirm('Do you really want to delete?');"
                        action="{{route($segment.'.'.'payment-method.destroy',$pm->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit">
                            <i class="fa fa-trash"></i>
                        </button>
                    </form>
                </a>
            </td>

            @include('Dashboard.Admin.Payment-Method.modal')


        </tr>
        @endforeach
    </tbody>
</table>