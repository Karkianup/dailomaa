<div class="card page selected-data">
    <div class="card-body">
        <div class="box-header with-border">
            <h3 class="box-title">Page</h3>
        </div>
        <div class="box-footer" style="display: block;">
            <select class="custom-select" id="" name="page_category">
                <option selected value="">Select Page</option>
                @forelse($pages as $page)
                <option value="{{$page->id}}">
                    {{$page->title}}
                </option>
                @empty
                <option disabled selected>No Page</option>
                @endforelse
            </select>
        </div>
    </div>
</div>