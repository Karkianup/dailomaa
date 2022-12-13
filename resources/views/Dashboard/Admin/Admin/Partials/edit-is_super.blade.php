<div class="card">
    <div class="card-header card-header-rose card-header-icon">
        <div class="card-icon">
            <i class="material-icons">rule</i>
        </div>
        <h4 class="card-title">Super Admin</h4>
    </div>
    <div class="card-body">
        <div class="box-footer" style="display: block;">
            <select class="browser-default custom-select" name="is_super">
                <option value="1" {{$admin->is_super == 1 ? 'selected' : ''}}>Yes</option>
                <option value="0" {{$admin->is_super == 0 ? 'selected' : ''}}>No</option>
            </select>
        </div>
    </div>
</div>