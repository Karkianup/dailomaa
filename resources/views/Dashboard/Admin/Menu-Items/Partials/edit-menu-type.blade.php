<div class="card">
    <div class="card-header card-header-rose card-header-icon">
        <div class="card-icon">
            <i class="material-icons">merge_type</i>
        </div>
        <h4 class="card-title">
            Type
        </h4>
    </div>
    <div class="card-body">
        <div class="box-footer" style="display: block;">
            <select id="type-select" name="type" class="custom-select select-type">
                {{-- <option selected>Select Type</option> --}}
                <option value="none" {{ $menuItem->type == "none" ? 'selected' : '' }}>None</option>
                <option value="route" {{ $menuItem->type == "route" ? 'selected' : '' }}>Route</option>
                <option value="url" {{ $menuItem->type == "url" ? 'selected' : '' }}>URL</option>
                <option value="page" {{ $menuItem->type == "page" ? 'selected' : '' }}>Page</option>
                <option value="category" {{ $menuItem->type == "category" ? 'selected' : '' }}>
                    Category</option>
                <option value="sub-category" {{ $menuItem->type == "sub-category" ? 'selected' : '' }}>
                    Sub Category</option>
            </select>
        </div>
    </div>
</div>