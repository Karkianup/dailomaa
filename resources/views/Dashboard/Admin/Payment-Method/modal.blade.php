<div class="modal fade bd-example-modal-lg" id="modal-{{ $pm->id }}" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Details of Payment Method<span class="member"></span>
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
                                <label for="title"> Title</label>
                                <input id="title" type="text" class="form-control" readonly value="{{ $pm->title }}">

                            </div>

                            <div>
                                <label for="url"> Url</label>
                                <textarea class="form-control" id="url" readonly
                                    name="url">{{ strip_tags($pm->url) }}</textarea>

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
