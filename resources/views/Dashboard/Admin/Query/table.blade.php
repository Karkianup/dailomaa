<table id="datatables" class="table table-striped table-no-bordered table-hover dataTable dtr-inline" cellspacing="0"
    width="100%" style="width: 100%;" role="grid" aria-describedby="datatables_info">
    <thead>
        <tr role="row">
            {{-- <th class="text-center"></th> --}}
            <th class="sorting_asc" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 150px;"
                aria-sort="ascending" aria-label="Name: activate to sort column descending">Subject
            </th>
            <th class="sorting_asc" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1"
                style="width: 100px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">Sender
            </th>
            <th class="sorting_asc" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 80px;"
                aria-sort="ascending" aria-label="Name: activate to sort column descending">Sender Email
            </th>

            <th class="sorting" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 114px;"
                aria-label="Date: activate to sort column ascending">Sent At
            </th>
            <th class="disabled-sorting text-right sorting" tabindex="0" aria-controls="datatables" rowspan="1"
                colspan="1" style="width: 130px;" aria-label="Actions: activate to sort column ascending">Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse($contact as $data)
        <tr role="row" class="odd">
            <td>{{$data->subject}}</td>
            <td>
                {{$data->name}}
            </td>
            <td>
                {{$data->email}}
            </td>
            <td>{{$data->created_at}}</td>
            <td class="text-right">
                <a href="#" data-target="#modal-{{$data->id}}" data-toggle="modal"
                    class="btn btn-link btn-warning btn-just-icon edit"><i class="fa fa-eye"></i>
                </a>
                
                <a class="btn btn-link btn-danger btn-just-icon remove">
                    <form onsubmit="return confirm('Do you really want to delete?');"
                        action="{{route('query.destroy',$data->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit">
                            <i class="fa fa-trash"></i>
                        </button>
                    </form>
                </a>
            </td>

            @include('Dashboard.Admin.Query.Partials.modal')

        </tr>
        @empty
        <p>No Queries</p>
        @endforelse
    </tbody>
</table>