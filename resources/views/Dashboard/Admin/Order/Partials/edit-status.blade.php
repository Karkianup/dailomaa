<div class="card">
    <div class="card-body">
        <div class="box-header with-border">
            <h3 class="box-title">Order Status</h3>
        </div>
        <div class="box-footer" style="display: block;">
            <select class="browser-default custom-select" name="status">
                <option value="1" {{ $order->status == 1 ? 'selected' : '' }}>Ordered</option>
                <option value="2" {{ $order->status == 2 ? 'selected' : '' }}>Cancelled</option>
                <option value="3" {{ $order->status == 3 ? 'selected' : '' }}>Delivered</option>
                <option value="4" {{ $order->status == 4 ? 'selected' : '' }}>Out For Delivery</option>
            </select>
        </div>
    </div>
</div>
