<div class="twice-two">
    <input type="text" class="form-control" name="name" id="name" value="{{ old('name', $contact->name) }}"
        placeholder="Name" required="">
    <input type="email" class="form-control" name="email" id="email" value="{{ old('email', $contact->email) }}"
        placeholder="Email" required="">
</div>
