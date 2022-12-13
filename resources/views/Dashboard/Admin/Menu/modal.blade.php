<div class="modal fade bd-example-modal-lg" id="modal-{{ $menu->id }}" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Details of Menu<span class="member"></span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <div class="col-md-12">

                        <div>
                            <label for="menu_title"> Menu Title *</label>
                            <input id="menu_title" type="text" class="form-control" readonly
                                value="{{ $menu->menu_title }}">

                        </div>
                        <div>
                            <label for="status"> Status *</label>

                            <input id="status" type="text" class="form-control" readonly
                                value="{{ $menu->status == 1 ? 'Active' : 'Inactive' }}">

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
