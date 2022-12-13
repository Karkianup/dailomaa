<div class="twice-two">
    <input type="text" class="form-control" name="name" id="name" readonly value="{{ Auth::user()->name }}"
        required="">
    <input type="email" class="form-control" name="email" id="email" value="{{ Auth::user()->email }}" readonly
        required="">
</div>

