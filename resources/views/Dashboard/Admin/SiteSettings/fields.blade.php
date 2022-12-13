<div class="card-body ">
    <div>
        <label for="title"> Title *</label>
        <input type="title" class="form-control" value="{{ $site_setting['title'] }}" name="title" id="title"
            required="true" aria-required="true">
    </div>
    <div>
        <label for="email"> Email Address *</label>
        <input type="text" class="form-control" value="{{ $site_setting['email'] }}" name="email" id="email"
            required="true" aria-required="true">
    </div>

    <div>
        <label for="mob_no"> Mobile Number *</label>
        <input type="text" class="form-control" value="{{ $site_setting['mobile_no'] }}" name="mobile_no"
            id="mobile_no">
    </div>

    <div>
        <label for="address"> Address *</label>
        <input type="text" class="form-control" value="{{ $site_setting['address'] }}" name="address" id="address"
            aria-required="true" style="cursor: auto;">
    </div>
    <div>
        <label for="post_code"> Post Code *</label>
        <input type="text" class="form-control" value="{{ $site_setting['post_code'] }}" name="post_code"
            id="post_code" style="cursor: auto;">
    </div>
    <div>
        <label for="site_url"> Site Url *</label>
        <input type="text" class="form-control" value="{{ $site_setting['site_url'] }}" name="site_url" id="site_url"
            required="true" aria-required="true" style="cursor: auto;">
    </div>
    <div>
        <label for="google_maps"> Google Maps *</label>
        <input type="text" class="form-control" value="{{ $site_setting['google_maps'] }}" name="google_maps" id="google_maps"
            required="true" aria-required="true" style="cursor: auto;">
    </div>
    <div>
        <label for="site_url"> About *</label>
        <textarea class="form-control" name="about" id="about" rows="5" required="true"
            aria-required="true">{{ $site_setting['about'] }}</textarea>
    </div>
</div>
