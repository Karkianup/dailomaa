<div class="card ">
    <div class="card-header card-header-rose card-header-icon">
        <div class="card-icon">
            <i class="material-icons">contacts</i>
        </div>
        <h4 class="card-title">Image</h4>
    </div>
    <div class="card-body ">
        <div class="row">
            <div class="col-md-12 col-sm-4">
                @if($product->image)
                    <div class="user-image mb-3 text-center">
                        <div class="displayImage">
                            @foreach (json_decode($product->image, true) as $image)
                                <img src="{{ asset('Asset/Uploads/Products/' . $image) }}"
                                    alt="{{ $product->product_details['name'] }}" width="100%">
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
            <div class="col-md-12 col-sm-4">
                <div class="user-image mb-3 text-center">
                    <div class="imgPreview"> </div>
                </div>

                <div class="custom-file">
                    <input type="file" name="image[]" class="custom-file-input" id="images" multiple="multiple">
                    <label class="custom-file-label" for="images">Choose image</label>
                </div>
            </div>
        </div>
    </div>

</div>
