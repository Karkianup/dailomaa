<div class="card ">
    <div class="card-header card-header-rose card-header-icon">
        <div class="card-icon">
            <i class="material-icons">contacts</i>
        </div>
        <h4 class="card-title">Password</h4>
    </div>
    <div class="card-body ">
        <div class="form-group bmd-form-group">
            <label for="password" class="bmd-label-floating"> Password *</label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                name="password" autocomplete="new-password">

            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group bmd-form-group">
            <label for="confirmPassword" class="bmd-label-floating"> Confirm Password *</label>
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                autocomplete="new-password">
        </div>

    </div>
</div>