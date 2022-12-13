<table id="datatables" class="table table-striped table-no-bordered table-hover dataTable dtr-inline" cellspacing="0"
    width="100%" style="width: 100%;" role="grid" aria-describedby="datatables_info">
    <thead>
        <tr role="row">
            {{-- <th class="text-center"></th> --}}
            <th class="sorting_asc" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 50px;"
                aria-sort="ascending" aria-label="Name: activate to sort column descending">#
            </th>
            <th class="sorting_asc" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 80px;"
                aria-sort="ascending" aria-label="Name: activate to sort column descending">Order
            </th>
            <th class="sorting_asc" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1"
                style="width: 177px;" aria-sort="ascending" aria-label="Menus: activate to sort column descending">
                Menu Title
            </th>
            <th class="sorting_asc" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1"
                style="width: 177px;" aria-sort="ascending" aria-label="Menus: activate to sort column descending">
                Menu Items
            </th>
            <th class="sorting" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 230px;"
                aria-label="Position: activate to sort column ascending">Status
            </th>
            <th class="sorting" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 114px;"
                aria-label="Date: activate to sort column ascending">Added At
            </th>
            <th class="disabled-sorting text-right sorting" tabindex="0" aria-controls="datatables" rowspan="1"
                colspan="1" style="width: 208px;" aria-label="Actions: activate to sort column ascending">Actions</th>
        </tr>
    </thead>
    <tbody id="tablecontents">
        @foreach ($menuCategory->menus as $menu)
            <tr class="odd row1" role="odd" data-id="{{ $menu->id }}">
                <td>
                    <div style="color:rgb(124,77,255); padding-left: 10px; float: left; font-size: 20px; cursor: pointer;"
                        title="change display order">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                    </div>
                </td>
                <td>{{ $menu['order'] }}</td>
                <td tabindex="0" class="sorting_1">{{ $menu->menu_title }}</td>
                <td>
                    <a href="{{ route($segment . '-' . 'menu-wise-menu-items', $menu->id) }}">
                        <i class="fas fa-folder-open"></i>
                        <span>
                            @if ($menu->menu_items)
                                {{ $menu->menu_items->count() }}
                            @else
                                0
                            @endif
                        </span>
                    </a>
                </td>
                <td>
                    <span class="{{ $menu->active_status['status'] }}">
                        {{ $menu->active_status['message'] }}
                    </span>
                </td>
                <td>{{ $menu->created_at->format('Y/m/d') }}</td>
                <td class="text-right">
                    <a href="#" data-target="#modal-{{ $menu->id }}" data-toggle="modal"
                        class="btn btn-link btn-warning btn-just-icon edit"><i class="fa fa-eye"></i>
                    </a>
                    <a href="{{ route($segment . '.' . 'menu.edit', $menu->id) }}"
                        class="btn btn-link btn-info btn-just-icon like"><i class="fa fa-edit"></i></a>
                    <a class="btn btn-link btn-danger btn-just-icon remove">
                        <form onsubmit="return confirm('Do you really want to delete?');"
                            action="{{ route($segment . '.' . 'menu.destroy', $menu->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit">
                                <i class="fa fa-trash"></i>
                            </button>
                        </form>
                    </a>

                </td>
                @include('Dashboard.Admin.Menu.modal')

            </tr>
        @endforeach
    </tbody>
</table>

<script type="text/javascript">
    $('#tablecontents').sortable({
        items: "tr",
        //   cursor: 'move',
        opacity: 0.6,
        update: function() {
            sendOrderToServer();
        }
    });

    function sendOrderToServer() {
        let order = [];
        $('tr.row1').each(function(index) {
            order.push({
                id: $(this).attr('data-id'),
                position: index + 1
            });
        });
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "{{ url('admin/update-menu') }}",
            data: {
                order: order,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.status == "success") {
                    console.log(response);
                } else {
                    console.log(response);
                }
            }
        });
    }

</script>
