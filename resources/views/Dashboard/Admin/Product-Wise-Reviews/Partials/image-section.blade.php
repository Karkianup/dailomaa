<div class="card ">
    <div class="card-header card-header-rose card-header-icon">
        <div class="card-icon">
            <i class="material-icons">contacts</i>
        </div>
        <h4 class="card-title">Customer</h4>
    </div>
    <div class="card-body ">
        <div class="row">
            <div class="col-md-4 col-sm-4">
                <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                    @if ($productWiseReview->user->image)
                        <div class="fileinput-new thumbnail">
                            <img src="{{ asset($productWiseReview->user->image) }}"
                                alt="{{ $productWiseReview->user->name }}">
                        </div>
                    @else
                        <div class="fileinput-new thumbnail">
                            <img src="{{ asset('Asset/Uploads/Static/user.png') }}" alt="...">
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>

</div>
