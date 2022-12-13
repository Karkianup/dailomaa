<div class="card">
    <div class="card-body">
        <div class="box-header with-border">
            <h3 class="box-title">Status</h3>
        </div>
        <div class="box-footer" style="display: block;">
            <select class="browser-default custom-select" name="status">
                <option value="1" {{$page->status == 1 ? 'selected' : ''}}>Active</option>
                <option value="0" {{$page->status == 0 ? 'selected' : ''}}>InActive</option>
            </select>
        </div>
    </div>
</div>