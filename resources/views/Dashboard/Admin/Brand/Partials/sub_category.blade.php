<div class="card">
    <div class="card-header card-header-rose card-header-icon">
        <h4 class="card-title">Sub Category</h4>
    </div>
    <div class="card-body">
        <div class="box-footer" style="display: block;">
            <select class="browser-default custom-select" name="sub_category_id">
                <option selected value="">Select Sub Category</option>
                @foreach ($subCategories as $subCategory)
                    <option value="{{ $subCategory->id }}">{{ $subCategory->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>
