<div class="card">
    <div class="card-body">
        <div class="box-header with-border">
            <h3 class="box-title">Brand</h3>
        </div>
        <div class="box-footer" style="display: block;">
            <select class="browser-default custom-select" name="brand_id">
                @foreach ($brands as $brand)
                    <option value="{{ $brand->id }}"
                        {{ $product->brand_id == $brand->id ? 'selected' : '' }}>{{ $brand->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
</div>
