<div class="card">
    <div class="card-header card-header-rose card-header-icon">
        <div class="card-icon">
            <i class="material-icons">rule</i>
        </div>
        <h4 class="card-title">Wholesaler</h4>
    </div>
    <div class="card-body">
        <div class="box-footer" style="display: block;">
            <select class="browser-default custom-select" name="is_wholesaler">
                <option value="1" {{$user->is_wholesaler == 1 ? 'selected' : ''}}>Yes</option>
                <option value="0" {{$user->is_wholesaler == 0 ? 'selected' : ''}}>No</option>
            </select>
        </div>
    </div>
</div>