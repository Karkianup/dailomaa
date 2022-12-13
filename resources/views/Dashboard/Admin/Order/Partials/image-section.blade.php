<div class="card ">
    <div class="card-body ">
        <div class="row">
            <div class="col-md-6 col-sm-4">
                <div class="fileinput fileinput-new text-center" data-provides="fileinput">


                    @foreach ($order->order_products as $products)
                        <div class="fileinput-new thumbnail">
                            <img src="{{ asset($products['product_image']) }}">
                        </div>
                    @endforeach


                    <div class="fileinput-preview fileinput-exists thumbnail"></div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="">
                    <label for="product">Products</label>
                    @php $count = 0; @endphp
                    @foreach ($order->order_products as $products)
                        @php $count++; @endphp
                        <input type="text" class="form-control"
                            value="{{ $products['product_name'] }} x {{ $products['quantity'] }}" readonly
                            id="name">
                        <input type="hidden" class="form-control" name="product_id"
                            value="{{ $products['product_id'] }}" readonly id="product_id">
                    @endforeach
                </div>
                <div class="">
                    <label for="quantity">Items</label>
                    <input type="text" class="form-control" value=" {{ $order->order_details['total_quantity'] }}"
                        readonly id="name">
                </div>

                <div class="">
                    <label for="quantity">Total Price</label>
                    <input type="text" class="form-control" value="Rs. {{ $order->order_details['total_amount'] }}"
                        readonly id="name">
                </div>
                <div class="">
                    <label for="quantity">Ordered Date</label>
                    <input type="text" class="form-control" value="{{ $order->order_details['ordered_date'] }}"
                        readonly id="name">
                </div>

            </div>

        </div>
    </div>

</div>
