<h4>Price</h4>
<div class="price-range clearfix">
    @if ($errors->any())
        <div class="alert alert-danger col-md-12">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ url('search/filter/price') }}" method="GET">
        <input type="hidden" name="product" value="{{ $searchData }}" readonly>
        <input type="number" min="10" class="c-price" required placeholder="Min" name="min"
            value="{{ old('min', $minPrice ?? '') }}" pattern="[0-9]*"
            data-spm-anchor-id="a2a0e.searchlistcategory.filter.i0.4a9bddef3TAie1">
        <div class="c-dash">-</div>
        <input type="number" min="10" class="c-price" required placeholder="Max" name="max"
            value="{{ old('min', $maxPrice ?? '') }}" pattern="[0-9]*"
            data-spm-anchor-id="a2a0e.searchlistcategory.filter.i1.4a9bddef3TAie1">
        <button type="submit" class="c-btn c-find c-btn-primary c-btn-icon-only"><i
                class="fa fa-angle-right"></i></button>
    </form>
</div>
<hr>
