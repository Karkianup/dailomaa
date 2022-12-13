<div class="btn-group form-control mt-2">
    <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
        aria-expanded="false">
        Sort By
    </button>
    <div class="dropdown-menu ">
        <a class="dropdown-item"
            href="{{ route('search-and-sort', $searchData) }}?sort_by=name-ascending">Name,
            A-Z</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item"
            href="{{ route('search-and-sort', $searchData) }}?sort_by=name-descending">Name,
            Z-A</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item"
            href="{{ route('search-and-sort', $searchData) }}?sort_by=price-ascending">Price, low to
            high</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item"
            href="{{ route('search-and-sort', $searchData) }}?sort_by=price-descending">Price, high to
            low</a>
    </div>
</div>
