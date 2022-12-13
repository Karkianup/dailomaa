<div class="card-body ">
    <div class="row">
        <div class="col-md-12">
            <div>
                <label>Product</label>
                <input type="customer" class="form-control" readonly value="{{ $productWiseReview->product->name }}">
            </div>
            <div>
                <label>Rating</label>
                <input type="customer" class="form-control" readonly value="{{ $productWiseReview->rating }}">
            </div>
            <div>
                <label>Customer</label>
                <input type="customer" class="form-control" readonly value="{{ $productWiseReview->user->name }}">
            </div>
            <div>
                <label>Message</label>
                <textarea class="form-control" readonly cols="30"
                    rows="10">{{ $productWiseReview->message }}</textarea>
            </div>

        </div>
    </div>

</div>
