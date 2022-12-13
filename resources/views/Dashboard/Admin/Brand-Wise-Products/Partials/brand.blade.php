<div class="card">
    <div class="card-header card-header-rose card-header-icon">
        <h4 class="card-title">Brand</h4>
    </div>
    <div class="card-body">
        <div class="box-footer" style="display: block;">
            <select class="browser-default custom-select" name="brand_id">
                <option selected value="">Select Brand</option>
                @foreach ($brands as $brand)
                    <option value="{{ $brand->id }}" {{$brand->id == $oldBrand['id'] ? 'selected' : ''}}>{{ $brand->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>
