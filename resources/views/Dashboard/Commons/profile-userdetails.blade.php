<div class="card">
    <div class="card-header card-header-icon card-header-rose">
        <div class="card-icon">
            <i class="material-icons">assignment</i>
        </div>
        <h4 class="card-title">Personal Details
        </h4>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group bmd-form-group">
                    <label class="bmd-label-floating">Name</label>
                    <input type="text" name="name" value="{{$profile->name}}" class="form-control">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group bmd-form-group">
                    <label class="bmd-label-floating">Email address</label>
                    <input type="email" name="email" value="{{$profile->email}}" class="form-control">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group bmd-form-group">
                    <label for="name" class="bmd-label-floating"> Address *</label>
                    <input type="name" class="form-control" value="{{old('address',$profile->address)}}" name="address"
                        id="address">
                </div>
                <div class="form-group bmd-form-group">
                    <label for="name" class="bmd-label-floating"> City *</label>
                    <input type="name" class="form-control" value="{{old('city',$profile->city)}}" name="city"
                        id="city">
                </div>

            </div>
            <div class="col-md-6">
                <div class="form-group bmd-form-group">
                    <label for="name" class="bmd-label-floating"> Country *</label>
                    <input type="name" class="form-control" value="{{old('country',$profile->country)}}" name="country"
                        id="country">
                </div>
                <div class="form-group bmd-form-group">
                    <label for="name" class="bmd-label-floating"> Contact *</label>
                    <input type="name" class="form-control" value="{{old('contact_no',$profile->contact_no)}}"
                        name="contact_no" id="contact_no">
                </div>

            </div>

        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                    <div class="fileinput-new thumbnail">
                        <img src="{{asset('Asset/Uploads/Static/avatar.jpg')}}" alt="...">
                    </div>

                    <div class="fileinput-preview fileinput-exists thumbnail"></div>
                    <div>
                        <span class="btn btn-rose btn-round btn-file">
                            <span class="fileinput-new">Change Image</span>
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