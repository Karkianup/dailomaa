<table id="datatables" class="table table-striped table-no-bordered table-hover dataTable dtr-inline" cellspacing="0"
    width="100%" style="width: 100%;" role="grid" aria-describedby="datatables_info">
    <thead>
        <tr role="row">
            {{-- <th class="text-center"></th> --}}
            <th class="sorting_asc" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1"
                style="width: 177px;" aria-sort="ascending"
                aria-label="Menu Category: activate to sort column descending">
                Menu Category
            </th>
            <th class="sorting_asc" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1"
                style="width: 177px;" aria-sort="ascending" aria-label="Menus: activate to sort column descending">
                Menus
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
    <tbody>
        @foreach($menuCategory as $category)
        <tr role="row" class="odd">
            <td tabindex="0" class="sorting_1">{{$category->menu_category_name}}</td>
            <td>
                <a href="{{route($segment . '-' .'menu-category-wise-menus',$category->id)}}">

                    <i class="fas fa-folder-open"></i>
                    <span>
                        {{$category->menus->count()}}
                    </span>
                </a>
            </td>
            <td>
                <span class="{{$category->active_status['status']}}">
                    {{$category->active_status['message']}}
                </span>
            </td>
            <td>{{$category->created_at->format('Y/m/d')}}</td>
            <td class="text-right">
                <a href="#" data-target="#modal-{{$category->id}}" data-toggle="modal"
                    class="btn btn-link btn-warning btn-just-icon edit"><i class="fa fa-eye"></i>
                </a>
                <a href="{{route($segment. '.' . 'menu-category.edit',$category->id)}}"
                    class="btn btn-link btn-info btn-just-icon like"><i class="fa fa-edit"></i></a>
                <a class="btn btn-link btn-danger btn-just-icon remove">
                    <form onsubmit="return confirm('Do you really want to delete?');"
                        action="{{route($segment. '.' . 'menu-category.destroy',$category->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit">
                            <i class="fa fa-trash"></i>
                        </button>
                    </form>
                </a>

            </td>
            @include('Dashboard.Admin.Menu-Category.modal')

        </tr>
        @endforeach
    </tbody>
</table>