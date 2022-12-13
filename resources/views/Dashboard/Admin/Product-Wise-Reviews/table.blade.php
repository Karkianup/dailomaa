<table id="datatables" class="table table-striped table-no-bordered table-hover dataTable dtr-inline" cellspacing="0"
    width="100%" style="width: 100%;" role="grid" aria-describedby="datatables_info">
    <thead>
        <tr role="row">
            {{-- <th class="text-center"></th> --}}
            <th class="sorting_asc" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1"
                style="width: 100px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">Image
            </th>
            <th class="sorting_asc" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1"
                style="width: 177px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">
                Customer
            </th>
            <th class="sorting_asc" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1"
                style="width: 300px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">
                Rating
            </th>
            <th class="sorting" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 114px;"
                aria-label="Date: activate to sort column ascending">Added At
            </th>
            <th class="sorting_asc" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1"
                style="width: 100px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">
                Approved
            </th>

            <th class="disabled-sorting text-right sorting" tabindex="0" aria-controls="datatables" rowspan="1"
                colspan="1" style="width: 208px;" aria-label="Actions: activate to sort column ascending">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($productReviews->reviews as $productReview)
            <tr role="row" class="odd">
                <td>
                    <div class="img-container">
                        <img src="{{ $productReview->user->image ? asset('Asset/Uploads/Users/', $productReview->user->image) : asset('Asset/Uploads/Static/user.png') }}"
                            alt="{{ $productReview->user->name }}">
                    </div>
                </td>
                <td>{{ $productReview->user->name }}</td>
                <td>{{ $productReview->rating }}</td>
                <td>{{ $productReview->created_at->format('Y/m/d') }}</td>
                <td>
                    @if ($productReview->status == 1)
                        <i class="fas fa-check text-success fa-2x" aria-hidden="true">
                        </i>
                    @else
                        <i class="fas fa-times text-danger fa-2x" aria-hidden="true">
                        </i>
                    @endif
                </td>
                <td class="text-right">
                    <a href="#" data-target="#modal-{{ $productReview->id }}" data-toggle="modal"
                        class="btn btn-link btn-warning btn-just-icon edit"><i class="fa fa-eye"></i>
                    </a>
                    <a href="{{ route($segment . '.' . 'product-wise-reviews.edit', $productReview->id) }}"
                        class="btn btn-link btn-info btn-just-icon like"><i class="fa fa-edit"></i></a>
                    <a class="btn btn-link btn-danger btn-just-icon remove">
                        <form onsubmit="return confirm('Do you really want to delete?');"
                            action="{{ route($segment . '.' . 'product-wise-reviews.destroy', $productReview->id) }}"
                            method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit">
                                <i class="fa fa-trash"></i>
                            </button>
                        </form>
                    </a>
                </td>
                @include('Dashboard.Admin.Product-Wise-Reviews.Partials.modal')
            </tr>
        @endforeach
    </tbody>
</table>
