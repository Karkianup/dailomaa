<div class="card">
    <div class="card-body">
        <div class="box-header with-border">
            <h3 class="box-title">Retailer</h3>
        </div>
        <div class="box-footer" style="display: block;">
            <select class="browser-default custom-select" name="retailer_id">
                @foreach ($retailers as $retailer)
                    <option value="{{ $retailer->id }}"
                        {{ $product->retailer_id == $retailer->id ? 'selected' : '' }}>{{ $retailer->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
</div>
