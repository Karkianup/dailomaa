<div class="modal fade bd-example-modal-lg" id="modal-{{ $order->id }}" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Details of Order<span class="member"></span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div>
                                <label for="name"> Customer </label>
                                <input type="text" class="form-control" readonly value=" {{ $order->order_details['name'] }}">

                            </div>
                            <div>
                                <label for="name"> Contact Number</label>
                                <input type="text" class="form-control" readonly
                                    value="{{ $order->order_details['contact_number'] }}">

                            </div>
                           
                            <div>
                                <label for="name"> Address</label>
                                <input type="text" class="form-control" readonly
                                    value="{{ $order->order_details['address'] }}">

                            </div>
                           
                            <div>
                                <label for="name"> Message </label>
                                <textarea class="form-control"  name="body" readonly cols="30" rows="10">{{ $order->order_details['body'] }}</textarea>

                            </div>

                        </div>
                    </div>

                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
