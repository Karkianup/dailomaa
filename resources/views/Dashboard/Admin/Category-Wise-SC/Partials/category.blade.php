<div class="card">
    <div class="card-header card-header-rose card-header-icon">
        <h4 class="card-title">Category</h4>
    </div>
    <div class="card-body">
        <div class="box-footer" style="display: block;">
            <select class="browser-default custom-select" name="category_id">
                <option selected value="">Select Category</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ $category->id == $newCategory['id'] ? 'selected' : '' }}>
                        {{ $category->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>
