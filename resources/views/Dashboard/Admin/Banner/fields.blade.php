<div class="card-body ">
    <div class="form-group bmd-form-group">
        <label for="title"> Title *</label>
        <input type="text" class="form-control" value="{{$banner->title }}" name="title" id="title">
    </div>

    <div class="form-group bmd-form-group">
        <label for="url"> Url *</label>
        <input type="text" class="form-control" value="{{$banner->url }}" name="url" id="url">
    </div>



    <div class="form-group bmd-form-group">
        <label for="title"> Description *</label>
        <textarea rows="10" class="form-control" name="description"
            id="description">{{  $banner->description }}</textarea>
    </div>


</div>
