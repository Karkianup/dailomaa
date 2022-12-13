<div class="card">
    <div class="card-header card-header-rose card-header-icon">
        <div class="card-icon">
            <i class="material-icons">rule</i>
        </div>
        <h4 class="card-title">Status</h4>
    </div>
    <div class="card-body">
        <div class="box-footer" style="display: block;">
            <select class="browser-default custom-select" name="status">
                <option value="1" {{$menuItem->status == 1 ? 'selected' : ''}}>Active</option>
                <option value="0" {{$menuItem->status == 0 ? 'selected' : ''}}>InActive</option>
            </select>
        </div>
    </div>
</div>