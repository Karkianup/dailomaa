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
                Products
            </th>
            <th class="sorting_asc" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1"
                style="width: 100px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">
                Items
            </th>
            <th class="sorting" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 100px;"
                aria-label="Position: activate to sort column ascending">Total
            </th>
            <th class="sorting" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 200px;"
                aria-label="Position: activate to sort column ascending">Payment Status
            </th>
            <th class="sorting" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 200px;"
                aria-label="Position: activate to sort column ascending">Order Status
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
                {{-- <td>
                    <div class="img-container">
                        <img src="{{ asset($order->ordering_customer['image']) }}">
                    </div>
                </td> --}}
                <td>{{ $order->ordering_customer['name'] }}</td>
                <td>
                    @php $count = 0; @endphp
                    @foreach ($order->order_products as $products)
                    @php $count++; @endphp
                        <p class="text-primary">
                            {{$count}} {{ $products['product_name'] }}
                        </p>
                    @endforeach
                </td>
                <td>
                    {{ $order->order_details['total_quantity'] }}
                </td>
                <td>
                    Rs. {{ $order->order_details['total_amount'] }}
                </td>
                <td>
                    {{ $order->payment }}
                </td>

                <td>
                    <span class="{{ $order->my_order_status['status'] }}">
                        {{ $order->my_order_status['message'] }}
                    </span>
                </td>

                <td>{{ $order->order_details['ordered_date'] }}</td>
                <td class="text-right">
                    <a href="#" data-target="#modal-{{ $order->id }}" data-toggle="modal"
                        class="btn btn-link btn-warning btn-just-icon edit"><i class="fa fa-eye"></i>
                    </a>
                    <a href="{{ route($segment . '.' . 'order.edit', $order->id) }}"
                        class="btn btn-link btn-info btn-just-icon like"><i class="fa fa-edit"></i></a>
                    <a class="btn btn-link btn-danger btn-just-icon remove">
                        <form onsubmit="return confirm('Do you really want to delete?');"
                            action="{{ route($segment . '.' . 'order.destroy', $order->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit">
                                <i class="fa fa-trash"></i>
                            </button>
                        </form>
                    </a>
                </td>
                @include('Dashboard.Admin.Order.Partials.modal')
            </tr>

        @endforeach
    </tbody>
</table>
