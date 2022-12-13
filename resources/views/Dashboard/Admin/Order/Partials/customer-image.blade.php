<div class="card ">
    <div class="card-header card-header-rose card-header-icon">
        <div class="card-icon">
            <i class="material-icons">contacts</i>
        </div>
        <h4 class="card-title">Customer</h4>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6 col-sm-4">
                <div class="fileinput fileinput-new text-center" data-provides="fileinput">


                    @isset($order->user->image)
                        <div class="fileinput-new thumbnail">
                            <img src="{{ asset($order->ordering_customer['image'])}}"
                                alt="{{ $order->ordering_customer['name'] }}">
                        </div>
                    @else
                        <div class="fileinput-new thumbnail">
                            <img src="{{ asset('Asset/Uploads/Static/avatar.jpg') }}" alt="...">
                        </div>
                        @endif

                        <div class="fileinput-preview fileinput-exists thumbnail"></div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="">
                        <label for="product">Name</label>
                        <input type="text" class="form-control" value="{{ $order->ordering_customer['name'] }}" readonly id="name">
                        <input type="hidden" class="form-control" name="user_id" value="{{ $order->ordering_customer['random_id'] }}" readonly id="user_id">
                    </div>
                    <div class="">
                        <label for="quantity">Address</label>
                        <input type="text" class="form-control" value="{{ $order->ordering_customer['address'] }}" readonly id="address">
                    </div>
                    <div class="">
                        <label for="quantity">Contact Number</label>
                        <input type="text" class="form-control" value="{{ $order->ordering_customer['contact_no'] }}" readonly id="contact_no">
                    </div>
                    <div class="">
                        <label for="quantity">Email</label>
                        <input type="text" class="form-control" value="{{ $order->ordering_customer['email'] }}" readonly id="email">
                    </div>

                </div>

            </div>
        </div>

    </div>
