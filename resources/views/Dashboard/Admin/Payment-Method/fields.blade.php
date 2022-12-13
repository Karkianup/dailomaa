<div class="card-body ">
    <div>
        <label for="title"> Title *</label>
        <input type="text" class="form-control" value="{{ old('title', $paymentMethod->title) }}" name="title" id="title">
    </div>
    <div>
        <label for="title"> Url *</label>
        <input type="text" class="form-control" value="{{ old('url', $paymentMethod->url) }}" name="url" id="url">
    </div>

   
</div>
