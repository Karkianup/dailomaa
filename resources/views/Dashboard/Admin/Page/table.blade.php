<table id="datatables" class="table table-striped table-no-bordered table-hover dataTable dtr-inline" cellspacing="0"
    width="100%" style="width: 100%;" role="grid" aria-describedby="datatables_info">

    <thead>
        <tr role="row">
            {{-- <th class="sorting_asc" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 30px;"
                aria-sort="ascending" aria-label="Name: activate to sort column descending">#
            </th> --}}
            {{-- <th class="text-center"></th> --}}
            <th class="sorting_asc" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 70px;"
                aria-sort="ascending" aria-label="Name: activate to sort column descending">Image
            </th>
            <th class="sorting_asc" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1"
                style="width: 177px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">
                Title
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
        @foreach($page as $pg)
        <tr class="odd row1" role="odd" data-id="{{$pg->id}}">
            <td>
                <div class="img-container">
                    <img class="image" src="{{asset($pg->page_image)}}" alt="">

                </div>
            </td>
            <td>{{$pg->title}}</td>
            <td>
                <span class="{{$pg->active_status['status']}}">
                    {{$pg->active_status['message']}}
                </span>
            </td>
            <td>{{$pg->created_at->format('Y/m/d')}}
            </td>
            <td class="text-right">
                <a href="#" data-target="#modal-{{$pg->id}}" data-toggle="modal"
                    class="btn btn-link btn-warning btn-just-icon edit">
                    <i class="fa fa-eye"></i>
                </a>

                <a href="{{route($segment.'.'.'page.edit',$pg->id)}}"
                    class="btn btn-link btn-info btn-just-icon like"><i class="fa fa-edit"></i></a>
                <a class="btn btn-link btn-danger btn-just-icon remove">
                    <form onsubmit="return confirm('Do you really want to delete?');"
                        action="{{route($segment.'.'.'page.destroy',$pg->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit">
                            <i class="fa fa-trash"></i>
                        </button>
                    </form>
                </a>
            </td>

            @include('Dashboard.Admin.Page.modal')


        </tr>
        @endforeach
    </tbody>
</table>