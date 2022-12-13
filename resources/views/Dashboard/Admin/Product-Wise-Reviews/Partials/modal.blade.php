<div class="modal fade bd-example-modal-lg" id="modal-{{ $productReview->id }}" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Details of Review<span class="member"></span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-4">
                            <img class="view-image"
                                src="{{ $productReview->user->image ? asset('Asset/Uploads/Users/', $productReview->user->image) : asset('Asset/Uploads/Static/user.png') }}"
                                alt="{{ $productReview->user->name }}">
                        </div>

                        <div class="col-md-8">

                            <div>
                                <label for="rating"> Rating *</label>
                                <input id="rating" type="text" class="form-control" readonly
                                    value="{{ $productReview->rating }}">

                            </div>
                            <div>
                                <label for="message"> Message *</label>
                                <input id="message" type="text" class="form-control" readonly
                                    value="{{ $productReview->message }}">

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
