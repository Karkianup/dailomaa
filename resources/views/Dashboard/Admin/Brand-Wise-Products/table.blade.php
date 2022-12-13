<table id="datatables" class="table table-striped table-no-bordered table-hover dataTable dtr-inline" cellspacing="0"
    width="100%" style="width: 100%;" role="grid" aria-describedby="datatables_info">
    <thead>
        <tr role="row">
            {{-- <th class="text-center"></th> --}}
            <th class="sorting_asc" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1"
                style="width: 100px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">Image
            </th>
            <th class="sorting_asc" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1"
                style="width: 177px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">Name
            </th>

            <th class="sorting" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 100px;"
                aria-label="Position: activate to sort column ascending">Featured
            </th>
            <th class="sorting" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 70px;"
                aria-label="Position: activate to sort column ascending">Status
            </th>
            <th class="sorting" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 150px;"
                aria-label="Date: activate to sort column ascending">Reviews
            </th>

            <th class="sorting" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 114px;"
                aria-label="Date: activate to sort column ascending">Added At
            </th>

            <th class="disabled-sorting text-right sorting" tabindex="0" aria-controls="datatables" rowspan="1"
                colspan="1" style="width: 208px;" aria-label="Actions: activate to sort column ascending">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $product)
            <tr role="row" class="odd">
                <td>
                    <div class="img-container">
                        <img src="{{ asset($product->product_details['main_image']) }}" alt="{{ $product->name }}">
                    </div>
                </td>
                <td>{{ $product->name }}</td>
                <td>
                    <i class="{{ $product->featured_status['status'] }}">
                    </i>
                </td>
                <td>
                    <span class="{{ $product->active_status['status'] }}">
                        {{ $product->active_status['message'] }}
                    </span>
                </td>

                <td>
                    <a href="{{ route($segment . '-' . 'product-wise-reviews', $product->id) }}">

                        <i class="fas fa-folder-open"></i>
                        <span>
                            {{ $product->reviews->count() }}
                        </span>
                    </a>
                </td>
                <td>{{ $product->created_at->format('Y/m/d') }}</td>
                <td class="text-right">
                    <a href="#" data-target="#modal-{{ $product->id }}" data-toggle="modal"
                        class="btn btn-link btn-warning btn-just-icon edit"><i class="fa fa-eye"></i>
                    </a>
                    <a href="{{ route($segment . '.' . 'brand-wise-products.edit', $product->id) }}"
                        class="btn btn-link btn-info btn-just-icon like"><i class="fa fa-edit"></i></a>
                    <a class="btn btn-link btn-danger btn-just-icon remove">
                        <form onsubmit="return confirm('Do you really want to delete?');"
                            action="{{ route($segment . '.' . 'brand-wise-products.destroy', $product->id) }}"
                            method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit">
                                <i class="fa fa-trash"></i>
                            </button>
                        </form>
                    </a>
                </td>
                @include('Dashboard.Admin.Brand-Wise-Products.Partials.modal')
            </tr>

        @endforeach
    </tbody>
</table>
