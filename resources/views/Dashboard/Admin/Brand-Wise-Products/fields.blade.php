<div class="card-body ">
    <div class="row">
        <div class="col-md-12">
            <div>
                <label for="name"> Name *</label>
                <input type="text" class="form-control" value="{{ old('name', $product->name) }}" name="name"
                    id="name">
            </div>
            <div>
                <label for="name"> SKU Code *</label>
                <input type="text" class="form-control" value="{{ old('sku_code', $product->sku_code) }}"
                    name="sku_code" id="sku_code">
            </div>
            <div>
                <label for="name"> Regular Price *</label>
                <input type="number" class="form-control" min="0"
                    value="{{ old('regular_price', $product->regular_price) }}" name="regular_price"
                    id="regular_price">
            </div>
            <div>
                <label for="name"> Sale Price *</label>
                <input type="number" class="form-control" min="0"
                    value="{{ old('sale_price', $product->sale_price) }}" name="sale_price" id="sale_price">
            </div>
            <div>
                <label for="name"> Wholesaler Price *</label>
                <input type="number" class="form-control" min="0"
                    value="{{ old('wholesaler_price', $product->wholesaler_price) }}" name="wholesaler_price"
                    id="wholesaler_price">
            </div>
            <div>
                <label for="name"> Allowed Quantity *</label>
                <input type="number" class="form-control" min="0"
                    value="{{ old('allowed_quantity', $product->allowed_quantity) }}" name="allowed_quantity"
                    id="wholesaler_price">
            </div>
            <div>
                <label for="name"> Total *</label>
                <input type="number" class="form-control" min="0" value="{{ old('total', $product->total) }}"
                    name="total" id="wholesaler_price">
            </div>
            <div>
                <label for="name">Meta Description *</label>
                <textarea class="form-control" id="meta_description" rows="10"
                    name="meta_description">{{ old('meta_description', $product->meta_description) }}</textarea>
            </div>
            <div>
                <label for="name"> Content *</label>
                <textarea class="form-control" id="description"
                    name="description">{{ old('description', $product->description) }}</textarea>

                @if (Auth::guard('admin')->check())
                    <script type="text/javascript">
                        CKEDITOR.replace('description', {
                            filebrowserUploadMethod: 'form',
                            filebrowserUploadUrl: "{{ route('admin-ckeditor-product-image.upload', ['_token' => csrf_token()]) }}",
                            filebrowserBrowseUrl: '{{ asset('Asset/Uploads/Products/') }}',
                        });

                    </script>

                @elseif(Auth::guard('retailer')->check())
                    <script type="text/javascript">
                        CKEDITOR.replace('description', {
                            filebrowserUploadMethod: 'form',
                            filebrowserUploadUrl: "{{ route('retailer-ckeditor-product-image.upload', ['_token' => csrf_token()]) }}",
                            filebrowserBrowseUrl: '{{ asset('Asset/Uploads/Products/') }}',
                        });

                    </script>

                @endif
            </div>

        </div>
    </div>

</div>
