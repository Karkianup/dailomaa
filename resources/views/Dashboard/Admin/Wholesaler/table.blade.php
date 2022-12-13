<table id="datatables" class="table table-striped table-no-bordered table-hover dataTable dtr-inline" cellspacing="0"
    width="100%" style="width: 100%;" role="grid" aria-describedby="datatables_info">
    <thead>
        <tr role="row">
            {{-- <th class="text-center"></th> --}}
            <th class="sorting_asc" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1"
                style="width: 177px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">Image
            </th>
            <th class="sorting_asc" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1"
                style="width: 177px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">Name
            </th>
            <th class="sorting" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 261px;"
                aria-label="Position: activate to sort column ascending">Email
            </th>

            <th class="sorting" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 114px;"
                aria-label="Date: activate to sort column ascending">Registered At
            </th>
            <th class="disabled-sorting text-right sorting" tabindex="0" aria-controls="datatables" rowspan="1"
                colspan="1" style="width: 208px;" aria-label="Actions: activate to sort column ascending">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
            <tr role="row" class="odd">
                <td>
                    <div class="img-container">
                        <img src="{{ !empty($user->image) ? asset('Asset/Uploads/Users/' . $user->image) : url('images/Static/profile.png') }}"
                            alt="">
                    </div>
                </td>
                <td tabindex="0" class="sorting_1">{{ $user->name }}</td>
                <td>{{ $user->email }}</td>

                <td>{{ $user->created_at->format('Y/m/d') }}</td>
                <td class="text-right">
                    <a href="#" data-target="#modal-{{ $user->id }}" data-toggle="modal"
                        class="btn btn-link btn-warning btn-just-icon edit"><i class="fa fa-eye"></i>
                    </a>
                    <a href="{{ route('wholesaler.edit', $user->id) }}"
                        class="btn btn-link btn-info btn-just-icon like"><i class="fa fa-edit"></i></a>
                    <a class="btn btn-link btn-danger btn-just-icon remove">
                        <form onsubmit="return confirm('Do you really want to delete?');"
                            action="{{ route('wholesaler.destroy', $user->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit">
                                <i class="fa fa-trash"></i>
                            </button>
                        </form>
                    </a>
                </td>
                @include('Dashboard.Admin.Wholesaler.modal')
            </tr>
        @endforeach
    </tbody>
</table>
