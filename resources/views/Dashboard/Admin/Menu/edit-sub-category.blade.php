<div class="card sub-category selected-data">
    <div class="card-body">
        <div class="box-header with-border">
            <h3 class="box-title">Sub Category</h3>
        </div>
        <div class="box-footer" style="display: block;">
            <select class="custom-select" id="" name="sub_category_id">
                <option selected value="">Select Sub Category</option>
                @forelse($subCategory as $sCategory)
                <option value="{{$sCategory->id}}" {{$sCategory->slug == $menu->url ? 'selected' : ''}}>
                    {{$sCategory->name}}
                </option>
                @empty
                <option disabled selected>No Sub Category</option>
                @endforelse
            </select>
        </div>
    </div>
</div>