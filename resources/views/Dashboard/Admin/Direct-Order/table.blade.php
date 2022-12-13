<table id="datatables" class="table table-striped table-no-bordered table-hover dataTable dtr-inline" cellspacing="0"
    width="100%" style="width: 100%;" role="grid" aria-describedby="datatables_info">
    <thead>
        <tr role="row">
            {{-- <th class="text-center"></th> --}}
            {{-- <th class="sorting_asc" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 90px;"
                aria-sort="ascending" aria-label="Name: activate to sort column descending">Image
            </th> --}}
            <th class="sorting_asc" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1"
                style="width: 130px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">
                Customer
            </th>
            <th class="sorting_asc" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1"
                style="width: 177px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">
                Contact
            </th>
            <th class="sorting_asc" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1"
                style="width: 100px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">
                Address
            </th>
           

            <th class="sorting" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 114px;"
                aria-label="Date: activate to sort column ascending">Ordered At
            </th>

            <th class="disabled-sorting text-right sorting" tabindex="0" aria-controls="datatables" rowspan="1"
                colspan="1" style="width: 208px;" aria-label="Actions: activate to sort column ascending">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($orders as $order)
            <tr role="row" class="odd">
                
                <td> {{ $order->order_details['name'] }}</td>
               
                <td>
                    {{ $order->order_details['contact_number'] }}
                </td>
                <td>
                    {{ $order->order_details['address'] }}
                </td>
               
                <td>{{ $order->order_details['ordered_date'] }}</td>
                <td class="text-right">
                    <a href="#" data-target="#modal-{{ $order->id }}" data-toggle="modal"
                        class="btn btn-link btn-warning btn-just-icon edit"><i class="fa fa-eye"></i>
                    </a>
                    <a class="btn btn-link btn-danger btn-just-icon remove">
                        <form onsubmit="return confirm('Do you really want to delete?');"
                            action="{{ route($segment . '.' . 'direct-order.destroy', $order->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit">
                                <i class="fa fa-trash"></i>
                            </button>
                        </form>
                    </a>
                </td>
                @include('Dashboard.Admin.Direct-Order.Partials.modal')
            </tr>

        @endforeach
    </tbody>
</table>
