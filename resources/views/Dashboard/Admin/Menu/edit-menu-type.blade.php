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
                <option value="none" {{ $menu->type == "none" ? 'selected' : '' }}>None</option>
                <option value="route" {{ $menu->type == "route" ? 'selected' : '' }}>Route</option>
                <option value="url" {{ $menu->type == "url" ? 'selected' : '' }}>URL</option>
                <option value="page" {{ $menu->type == "page" ? 'selected' : '' }}>Page</option>
                <option value="category" {{ $menu->type == "category" ? 'selected' : '' }}>
                    Category</option>
                <option value="sub-category" {{ $menu->type == "sub-category" ? 'selected' : '' }}>
                    Sub Category</option>
            </select>
        </div>
    </div>
</div>