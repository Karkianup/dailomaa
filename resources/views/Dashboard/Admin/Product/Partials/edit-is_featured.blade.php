<div class="card">
    <div class="card-body">
        <div class="box-header with-border">
            <h3 class="box-title">Featured</h3>
        </div>
        <div class="box-footer" style="display: block;">
            <select class="browser-default custom-select" name="is_featured">
                <option value="1" {{$product->is_featured == 1 ? 'selected' : ''}}>Yes</option>
                <option value="0" {{$product->is_featured == 0 ? 'selected' : ''}}>No</option>
            </select>
        </div>
    </div>
</div>