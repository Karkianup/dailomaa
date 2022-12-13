<div class="card ">
    <div class="card-header card-header-rose card-header-icon">
        <div class="card-icon">
            <i class="material-icons">contacts</i>
        </div>
        <h4 class="card-title">Image</h4>
    </div>
    <div class="card-body ">
        <div class="row">
            <div class="col-md-4 col-sm-4">
                <div class="fileinput fileinput-new text-center" data-provides="fileinput">


                    @isset($category->image)
                        <div class="fileinput-new thumbnail">
                            <img src="{{ asset($category->category_details['image']) }}" alt="{{ $category->name }}">
                        </div>
                    @else
                        <div class="fileinput-new thumbnail">
                            <img src="{{ asset('Asset/Uploads/Static/avatar.jpg') }}" alt="...">
                        </div>
                        @endif

                        <div class="fileinput-preview fileinput-exists thumbnail"></div>
                        <div>
                            <span class="btn btn-rose btn-round btn-file">
                                <span class="fileinput-new">Select image</span>
                                <span class="fileinput-exists">Change</span>
                                <input type="file" name="image" kl_vkbd_parsed="true">
                            </span>
                            <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i
                                    class="fa fa-times"></i> Remove</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
