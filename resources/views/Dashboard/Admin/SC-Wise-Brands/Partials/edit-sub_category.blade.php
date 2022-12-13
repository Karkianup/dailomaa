<div class="card">
    <div class="card-body">
        <div class="box-header with-border">
            <h3 class="box-title">Sub Category</h3>
        </div>
        <div class="box-footer" style="display: block;">
            <select class="browser-default custom-select" name="sub_category_id">
                @foreach ($subCategories as $subCategory)
                    <option value="{{ $subCategory->id }}"
                        {{ $brand->sub_category_id == $subCategory->id ? 'selected' : '' }}>{{ $subCategory->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
</div>
