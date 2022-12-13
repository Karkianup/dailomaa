<div class="card">
    <div class="card-body">
        <div class="box-header with-border">
            <h3 class="box-title">Category</h3>
        </div>
        <div class="box-footer" style="display: block;">
            <select class="browser-default custom-select" name="category_id">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ $brand->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
</div>
