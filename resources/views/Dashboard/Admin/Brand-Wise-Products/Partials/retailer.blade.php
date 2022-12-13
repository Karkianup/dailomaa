<div class="card">
    <div class="card-header card-header-rose card-header-icon">
        <h4 class="card-title">Retailer</h4>
    </div>
    <div class="card-body">
        <div class="box-footer" style="display: block;">
            <select class="browser-default custom-select" name="retailer_id">
                <option selected value="">Select Retailer</option>
                @foreach ($retailers as $retailer)
                    <option value="{{ $retailer->id }}">{{ $retailer->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>
