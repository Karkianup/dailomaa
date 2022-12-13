<div class="modal fade bd-example-modal-lg" id="modal-{{ $brand->id }}" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Details of Brand<span class="member"></span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <img class="view-image" src="{{ asset('Asset/Uploads/Brands/' . $brand->image) }}"
                                alt="{{ $brand->name }}">
                        </div>

                        <div class="col-md-8">
                            <div>
                                <label for="name" class="bmd-label-floating"> Name *</label>
                                <input id="{{ $brand->id }}" type="text" class="form-control" readonly
                                    value="{{ $brand->name }}">

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
