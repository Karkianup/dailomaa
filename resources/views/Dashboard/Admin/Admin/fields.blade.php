<div class="card-body ">
    <div>
        <label for="name"> Name *</label>
        <input type="name" class="form-control" value="{{ old('name', $admin->name) }}" name="name" id="name">
    </div>
    <div>
        <label for="email"> Email Address *</label>
        <input type="email" class="form-control" value="{{ old('email', $admin->email) }}" name="email" id="email">
    </div>
    <div>
        <label for="name"> Address *</label>
        <input type="name" class="form-control" value="{{ old('address', $admin->address) }}" name="address"
            id="address">
    </div>
    <div>
        <label for="name"> City *</label>
        <input type="name" class="form-control" value="{{ old('city', $admin->city) }}" name="city" id="city">
    </div>
    <div>
        <label for="name"> Country *</label>
        <input type="name" class="form-control" value="{{ old('country', $admin->country) }}" name="country"
            id="country">
    </div>
    <div>
        <label for="name"> Contact *</label>
        <input type="name" class="form-control" value="{{ old('contact_no', $admin->contact_no) }}" name="contact_no"
            id="contact_no">
    </div>

</div>
