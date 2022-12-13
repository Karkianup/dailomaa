@extends('Frontend.layouts.master')
@section('content')
    <div class="nav-info mb-5">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <h3>Search Result:</h3>
                    <nav class="breadcrumbs">
                        <a> {{ $searchData }}</a>
                    </nav>
                </div>
                <!--aside-->
                <div class="col-md-4">
                    @include('Frontend.Product.Search-By-Price.Partials.sort-by')
                </div>
                <!--aside-->
            </div>
        </div>
    </div>
    <section class="main-body">
        <div class="container">
            <div class="row">
                @if ($products->isNotEmpty())
                    <div class="col-md-3 product-filter">
                        @include('Frontend.Product.Search-By-Price.Partials.browse-by-price')
                        @include('Frontend.Product.Search-By-Price.Partials.browse-by-category')
                    </div>
                @endif
                
                <div class="col-md-9">
                    <div class="row">
                        @forelse ($products as $product)
                            <div class="col-6 col-sm-6 col-md-4">
                                <div class="indi-prod">
                                    <div class="product-img">
                                        <a href="{{ route('product-details', $product->slug) }}">
                                            <img src="{{ asset('Asset/Uploads/Products/' . $product->main_image) }}">
                                        </a>
                                    </div>
                                    <div class="pro-detail">
                                        {{-- <span class="p-tag">{{ $product->name }}</span> --}}
                                        <span class="abt-pro">
                                            <a href="{{ route('product-details', $product->slug) }}">
                                                {{ $product->name }}
                                            </a>
                                        </span>
                                        <span class="p-rate">
                                            @if ($product->sale_price)
                                                <del>
                                                    NRS {{ $product->regular_price }}
                                                </del>
                                                NRS {{ $product->sale_price }}
                                            @else
                                                NRS {{ $product->regular_price }}

                                            @endif
                                        </span>
                                        <a href="{{ route('product-details', $product->slug) }}">
                                            <span class="p-view text-center">

                                                View Details

                                            </span>
                                        </a>
                                    </div>
                                </div>

                            </div>
                        @empty
                            <p>No Products</p>
                        @endforelse
                    </div>

                </div>
                <!--aside-->
            </div>
        </div>
    </section>
@endsection
