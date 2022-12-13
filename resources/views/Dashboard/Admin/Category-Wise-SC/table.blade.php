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
            <th class="sorting_asc" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1"
                style="width: 300px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">
                Category
            </th>
            <th class="sorting_asc" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1"
                style="width: 100px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">
                Brands
            </th>
            <th class="sorting" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 100px;"
                aria-label="Position: activate to sort column ascending">Featured
            </th>
            <th class="sorting" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 100px;"
                aria-label="Position: activate to sort column ascending">Status
            </th>

            <th class="sorting" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 114px;"
                aria-label="Date: activate to sort column ascending">Added At
            </th>
            <th class="sorting" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 150px;"
                aria-label="Date: activate to sort column ascending">Updated At
            </th>
            <th class="disabled-sorting text-right sorting" tabindex="0" aria-controls="datatables" rowspan="1"
                colspan="1" style="width: 208px;" aria-label="Actions: activate to sort column ascending">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($subCategories as $subCategory)
            <tr role="row" class="odd">
                <td>
                    <div class="img-container">
                        <img src="{{ asset($subCategory->sub_category_details['image']) }}"
                            alt="{{ $subCategory->name }}">
                    </div>
                </td>
                <td>{{ $subCategory->name }}</td>
                <td>{{ $subCategory->sub_category_details['category'] }}</td>
                <td>
                    <a href="{{ route($segment . '.' . 'sub-category-wise-brands.show', $subCategory->slug) }}">
                        <i class="fas fa-folder-open"></i>
                        {{ $subCategory->brands->count() }}
                    </a>
                </td>
                <td>
                    <i class="{{ $subCategory->featured_status['status'] }}">
                    </i>
                </td>
                <td>
                    <span class="{{ $subCategory->active_status['status'] }}">
                        {{ $subCategory->active_status['message'] }}
                    </span>
                </td>

                <td>{{ $subCategory->created_at->format('Y/m/d') }}</td>
                <td>{{ $subCategory->updated_at->format('Y/m/d') }}</td>
                <td class="text-right">
                    <a href="#" data-target="#modal-{{ $subCategory->id }}" data-toggle="modal"
                        class="btn btn-link btn-warning btn-just-icon edit"><i class="fa fa-eye"></i>
                    </a>
                    <a href="{{ route($segment . '.' . 'category-wise-sub-category.edit', $subCategory->id) }}"
                        class="btn btn-link btn-info btn-just-icon like"><i class="fa fa-edit"></i></a>
                    <a class="btn btn-link btn-danger btn-just-icon remove">
                        <form onsubmit="return confirm('Do you really want to delete?');"
                            action="{{ route($segment . '.' . 'category-wise-sub-category.destroy', $subCategory->id) }}"
                            method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit">
                                <i class="fa fa-trash"></i>
                            </button>
                        </form>
                    </a>
                </td>
                @include('Dashboard.Admin.Category-Wise-SC.Partials.modal')
            </tr>
        @endforeach
    </tbody>
</table>
