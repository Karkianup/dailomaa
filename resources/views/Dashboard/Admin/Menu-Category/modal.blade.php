<div class="modal fade bd-example-modal-lg" id="modal-{{ $category->id }}" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Details of Menu Category<span class="member"></span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <div class="col-md-12">

                        <div>
                            <label for="menu_category_name"> Menu Categgory *</label>
                            <input id="menu_category_name" type="text" class="form-control" readonly
                                value="{{ $category->menu_category_name }}">

                        </div>
                        <div>
                            <label for="status"> Status *</label>

                            <input id="status" type="text" class="form-control" readonly
                                value="{{ $category->status == 1 ? 'Active' : 'Inactive' }}">

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
