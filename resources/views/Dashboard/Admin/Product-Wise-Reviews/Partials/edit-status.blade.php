<div class="card">
    <div class="card-body">
        <div class="box-header with-border">
            <h3 class="box-title">Status</h3>
        </div>
        <div class="box-footer" style="display: block;">
            <select class="browser-default custom-select" name="status">
                <option value="1" {{$productWiseReview->status == 1 ? 'selected' : ''}}>Approved</option>
                <option value="0" {{$productWiseReview->status == 0 ? 'selected' : ''}}>Not Approved</option>
            </select>
        </div>
    </div>
</div>