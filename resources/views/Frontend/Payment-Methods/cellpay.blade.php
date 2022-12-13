<div id="cellpayPaymentModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">CellPay</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                {{-- <form method="POST" action="{{ route('checkout.payment.cellpay.process') }}">
                    @csrf
                    <button class="btn btn-primary" type="submit">
                        Rs. {{ \Cart::getTotal() }} Pay with CellPay
                        @foreach ($cartCollection as $cartData)
                            <input type="hidden" name="product_id[]" value="{{ $cartData->id }}">
                        @endforeach
                    </button>

                </form> --}}
                <button type="button" class="btn btn-primary"
                    onclick="window.location='{{ route('checkout.payment.cellpay.process') }}'">
                    Rs. {{ \Cart::getTotal() }} Pay with CellPay
                </button>
            </div>
        </div>
    </div>
</div>
