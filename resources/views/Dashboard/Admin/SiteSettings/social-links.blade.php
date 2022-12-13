<div class="card ">
    <div class="card-header card-header-rose card-header-icon">
        <div class="card-icon">
            <i class="material-icons">contacts</i>
        </div>
        <h4 class="card-title">Social Links</h4>
    </div>
    <div class="card-body ">
        <div class="form-group bmd-form-group">
            <label for="examplePassword" class="bmd-label-floating"> Facebook *</label>
            <input type="text" class="form-control" value="{{$site_setting['facebook']}}" name="facebook" id="facebook"
                required="true" aria-required="true" style="cursor: auto;">
        </div>
        <div class="form-group bmd-form-group">
            <label for="examplePassword" class="bmd-label-floating"> Instagram *</label>
            <input type="text" class="form-control" value="{{$site_setting['instagram']}}" name="instagram"
                id="instagram" required="true" aria-required="true" style="cursor: auto;">
        </div>
        <div class="form-group bmd-form-group">
            <label for="examplePassword" class="bmd-label-floating"> Twitter *</label>
            <input type="text" class="form-control" value="{{$site_setting['twitter']}}" name="twitter" id="twitter"
                required="true" aria-required="true" style="cursor: auto;">
        </div>
        <div class="form-group bmd-form-group">
            <label for="examplePassword" class="bmd-label-floating"> LinkedIn *</label>
            <input type="text" class="form-control" value="{{$site_setting['linkedin']}}" name="linkedin" id="linkedin"
                required="true" aria-required="true" style="cursor: auto;">
        </div>
        <div class="form-group bmd-form-group">
            <label for="examplePassword" class="bmd-label-floating"> Skype *</label>
            <input type="text" class="form-control" value="{{$site_setting['skype']}}" name="skype" id="skype"
                required="true" aria-required="true" style="cursor: auto;">
        </div>
    </div>
</div>