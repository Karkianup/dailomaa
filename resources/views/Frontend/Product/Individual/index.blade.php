@extends('Frontend.layouts.master')
@section('content')
  @if (Session::has('loginForm'))
        <script>
            var modal = document.getElementById("id01").style.display = 'block';

            // When the user clicks anywhere outside of the modal, close it
            if (event.target == modal) {
                modal.style.display = "none";
            }
        </script>
    @endif
    <div class="nav-info mb-5">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <h3></h3>
                    <nav class="breadcrumbs">
                        <a href="{{ route('home') }}">home</a>
                        <span class="divider">/</span>
                        <a href="#">{{ $product->brand->sub_category->name }}</a>
                        <span class="divider">/</span>
                        <a href="#">{{ $product->brand->name }}</a>
                        <span class="divider">/</span>
                        {{ $product->name }}
                    </nav>
                </div>

            </div>
        </div>
    </div>
    <!-- main  -->
    <section class="item-body">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <div class="flexslider">
                        <ul class="slides">
                            <li data-thumb="{{ asset('Asset/Uploads/Products/' . $product->main_image) }}">
                                <img src="{{ asset('Asset/Uploads/Products/' . $product->main_image) }}"
                                    data-imagezoom="true" class="img-fluid" alt=" " />
                            </li>

                            @if ($product->image)
                                @foreach (json_decode($product->image, true) as $image)
                                    <li data-thumb="{{ asset('Asset/Uploads/Products/' . $image) }}">
                                        <img src="{{ asset('Asset/Uploads/Products/' . $image) }}" data-imagezoom="true"
                                            class="img-fluid" alt="{{ $product->product_details['name'] }}">
                                    </li>
                                @endforeach
                            @endif

                        </ul>
                    </div>

                </div>
                <div class="col-md-7">
                    <div class="product-summary">
                        <h1 class="product-title"> {{ $product->name }}</h1>
                        <div class="is-divider small"></div>
                        <div class="stars-user-rated">
                            <span class="fa fa-star ustar"> </span>
                            <span class="fa fa-star ustar"> </span>
                            <span class="fa fa-star ustar"> </span>
                        </div>
                        <div class="price-wrapper">
                            <p class="price">

                                @can('is_wholesaler')
                                    @if ($product->sale_price)
                                        <del>
                                            <span class="amount">
                                                <span class="Price-currencySymbol">रु</span>&nbsp;{{ $product->regular_price }}
                                            </span>
                                        </del>
                                        <ins>
                                            <span class="amount">
                                                <span
                                                    class="Price-currencySymbol">रु</span>&nbsp;<span style="color: #f30404;">{{ $product->wholesaler_price }}</span>
                                            </span>
                                        </ins>
                                    @else
                                        <ins>
                                            <span class="amount">
                                                <span
                                                    class="Price-currencySymbol">रु</span>&nbsp;<span style="color: #f30404;">{{ $product->wholesaler_price }}</span>
                                            </span>
                                        </ins>
                                    @endif
                                @else
                                    @if ($product->sale_price)
                                        <del>
                                            <span class="amount">
                                                <span class="Price-currencySymbol">रु</span>&nbsp;{{ $product->regular_price }}
                                            </span>
                                        </del>
                                        <ins>
                                            <span class="amount">
                                                <span class="Price-currencySymbol">रु</span>&nbsp;<span style="color: #f30404;">{{ $product->sale_price }}</span>
                                            </span>
                                        </ins>
                                    @else
                                        <ins>
                                            <span class="amount">
                                                <span class="Price-currencySymbol">रु</span>&nbsp;<span style="color: #f30404;">{{ $product->regular_price }}</span>
                                            </span>
                                        </ins>
                                    @endif
                                @endcan
                            </p>
                            <p>Delivery in 2-5 Business Days</p>
                            <p>Price Inclusive of all taxes</p>
                            @if ($errors->any())
                                <div class="alert alert-danger col-md-12">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form class="cart mt-3" role="form" action="{{ route('product-page-cart.store') }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="value-button" id="decrease" onclick="decreaseValue()" value="Decrease Value">-
                                </div>
                                <input type="number" min="1" max="{{ $product->allowed_quantity }}" id="number"
                                    name="quantity" value="{{ $product->allowed_quantity }}" />
                                <input type="hidden" id="id" name="id" value="{{ $product->id }}" />

                                <div class="value-button" id="increase" onclick="increaseValue()" value="Increase Value">+
                                </div>
                                <button type="submit" class="AddtoCartbtn button alt">Add to Cart</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <!-- main  -->

    <section class="item-desc">
        <div class="container">
            <div class="responsive_tabs">
                <div id="horizontalTab" style="display: block; width: 100%; margin: 0px;">
                    <ul class="resp-tabs-list">
                        <li class="resp-tab-item resp-tab-active" aria-controls="tab_item-0" role="tab">Description</li>
                        <li class="resp-tab-item " aria-controls="tab_item-1" role="tab">Reviews</li>
                        <li class="resp-tab-item" aria-controls="tab_item-2" role="tab">Additional Information</li>
                    </ul>
                    <div class="resp-tabs-container">
                        <!--/tab_one-->
                        <div class="tab1 resp-tab-content resp-tab-content-active resp-accordion-closed"
                            aria-labelledby="tab_item-0" style="display: none;">
                            <div class="single_page">
                                <p>{!! $product->description !!}</p>
                            </div>
                        </div>
                        <!--//tab_one-->
                        <div class="tab2 resp-tab-content" aria-labelledby="tab_item-1">
                            <div class="single_page">
                                <div class="bootstrap-tab-text-grids">
                                    @include('Frontend.Product.Individual.Reviews.show') <br>
                                    {{--  @foreach ($product->reviews as $review)
                                        {{ $review->id }}
                                    @endforeach  --}}
                                    @if (Auth::user())
                                        @include('Frontend.Product.Individual.Reviews.create')
                                    @else
                                        Click here to <a onclick="modal()"><u>login</u></a>
                                        <script>
                                            function modal() {
                                                var modal = document.getElementById("id01").style.display = 'block';

                                                // When the user clicks anywhere outside of the modal, close it
                                                if (event.target == modal) {
                                                    modal.style.display = "none";
                                                }
                                            }
                                        </script>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="tab3 resp-tab-content" aria-labelledby="tab_item-2">
                            <div class="single_page">
                                <p>{!! $product->additional_information !!}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('Frontend.Product.Individual.similar-products')
    @if ($errors->any())
        <script>
            var modal = document.getElementById("id01").style.display = 'block';
        </script>
    @endif
@endsection
